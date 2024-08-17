<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\DailyReport;
use App\Models\Site;
use App\Models\Scheduled;
use App\Models\Actual;
use App\Models\ScheduledUser;
use App\Models\ScheduledUserRole;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ReportCreating extends Component
{
    use WithFileUploads;

    public $date;
    public $start_time;
    public $end_time;
    public $sites;
    public $person_in_charge;
    public $comment;
    public $selectedEmployees = [];
    public $part;
    public $selectedSite;
    public $scheduled_id;
    public $scheduledUser_id;
    public $employees;

    protected $rules = [
        'date' => 'required|date|after_or_equal:2023-01-01',
        'start_time' => 'required',
        'end_time' => 'required',
        'selectedSite' => 'required|integer|exists:sites,id',
        'person_in_charge' => 'required|integer|exists:users,id',
        'comment' => 'nullable|string|max:255',
        'selectedEmployees' => 'array',
        'selectedEmployees.*' => 'integer|exists:users,id',
    ];

    public function mount()
    {
        $this->employees = User::all();
        $this->sites = Site::all();
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            Log::info('バリデーション開始');
            $validated = $this->validate();
            Log::info('バリデーション成功: ', $validated);

            // 日付を正しい形式に変換
            $formattedDate = Carbon::parse($this->date)->format('Y-m-d');

            // Scheduledテーブルにデータを保存または取得
            $scheduled = Scheduled::firstOrCreate(['date' => $formattedDate]);
            $this->scheduled_id = $scheduled->id;

            Log::info('Scheduled ID: ', ['scheduled_id' => $this->scheduled_id]);

            // DailyReportテーブルにデータを保存
            $report = DailyReport::create([
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'site_id' => $this->selectedSite,
                'scheduled_id' => $this->scheduled_id,
                'person_in_charge' => $this->person_in_charge,
                'comment' => $this->comment,
            ]);

            Log::info('DailyReport created: ', $report->toArray());

            // selectedEmployeesの処理
            DB::enableQueryLog(); // SQLクエリのログ出力を有効化
            // クエリが実行された後にログを取得
            $queries = DB::getQueryLog();
            Log::info('SQL Query Log:', ['queries' => $queries]);

            foreach ($this->selectedEmployees as $employeeId) {
                try {
                    Log::info("Checking for existing ScheduledUser for employeeId: $employeeId");

                    $scheduledUser = ScheduledUser::firstOrCreate(
                        [
                            'scheduled_id' => $this->scheduled_id,
                            'user_id' => $employeeId,
                            'site_id' => $this->selectedSite,
                        ]
                    );

                    $this->scheduledUser_id = $scheduledUser->id;

                    if ($this->scheduledUser_id === null) {
                        throw new \Exception('ScheduledUser ID is null after creation.');
                    }

                    Log::info('ScheduledUser ID: ', ['scheduledUser_id' => $this->scheduledUser_id]);

                    // 3. ScheduledUserRoleの作成（IDの取得と使用）
                    Log::info('Creating ScheduledUserRole for ScheduledUser ID:', ['scheduled_user_id' => $scheduledUser->id]);
                    ScheduledUserRole::create([
                        'scheduled_user_id' => $scheduledUser->id,
                        'is_actual' => true,
                        'is_scheduled' => false,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error processing employeeId: ' . $employeeId, ['error' => $e->getMessage()]);
                }
        }

            DB::commit();
            session()->flash('success', '日報が正常に提出されました。');
            $this->reset(['date', 'start_time', 'end_time', 'person_in_charge', 'comment', 'selectedEmployees', 'part', 'selectedSite', 'scheduled_id']);
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('バリデーションエラー: ' . json_encode($e->errors()));
            session()->flash('error', 'バリデーションエラーが発生しました。');
            $this->resetErrorBag();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('データの保存に失敗しました: ' . $e->getMessage());
            session()->flash('error', 'データの保存に失敗しました: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.report-creating', [
            'employees' => $this->employees,
            'sites' => $this->sites,
        ])->layout('daily-check.report_creating');
    }
}
