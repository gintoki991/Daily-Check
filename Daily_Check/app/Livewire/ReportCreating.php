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
use App\Models\DailyReportUser;
use Illuminate\Validation\ValidationException;

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

            // Scheduledテーブルにデータを保存
            $scheduled = Scheduled::firstOrCreate(
                [
                    'date' => $this->date,
                    'site_id' => $this->selectedSite
                ],
                [
                    'user_id' => $this->person_in_charge
                ]
            );
            $this->scheduled_id = $scheduled->id;

            // DailyReportテーブルにデータを保存
            $report = DailyReport::create([
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'site_id' => $this->selectedSite,
                'scheduled_id' => $this->scheduled_id,
                'person_in_charge' => $this->person_in_charge,
                'comment' => $this->comment,
                'date' => $this->date,
            ]);

            foreach ($this->selectedEmployees as $employeeId) {
                DailyReportUser::create([
                    'daily_report_id' => $report->id,
                    'user_id' => $employeeId,
                    'site_id' => $this->selectedSite,
                    'is_actual' => true, // 修正部分
                ]);

                Actual::create([
                    'scheduled_id' => $this->scheduled_id,
                    'user_id' => $employeeId,
                    'site_id' => $this->selectedSite,
                ]);
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
