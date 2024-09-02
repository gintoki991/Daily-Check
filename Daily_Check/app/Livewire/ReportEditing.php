<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\DailyReport;
use App\Models\Site;
use App\Models\Scheduled;
use App\Models\DailyReportUser;
use Illuminate\Validation\ValidationException;

class ReportEditing extends Component
{
    public $reportId;
    public $date;
    public $start_time;
    public $end_time;
    public $sites;
    public $person_in_charge;
    public $comment;
    public $selectedEmployees = [];
    public $employees;
    public $selectedSite;
    public $scheduled_id;

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

    public function mount($reportId)
    {
        $this->reportId = $reportId;
        $this->employees = User::all();
        $this->sites = Site::all();

        try {
            $report = DailyReport::with(['actualUsers', 'scheduled', 'personInCharge'])->findOrFail($reportId);
            Log::info('DailyReport found with reportId: ' . $reportId);
            $this->start_time = $report->start_time;
            $this->end_time = $report->end_time;
            $this->selectedSite = $report->site_id;
            $this->date = $report->date; // 日付を個別に読み込み
            $this->person_in_charge = $report->person_in_charge;
            $this->comment = $report->comment;
            $this->selectedEmployees = $report->actualUsers->pluck('id')->toArray();
            $this->scheduled_id = $report->scheduled_id;
        } catch (\Exception $e) {
            Log::error('Error in ReportEditing mount: ' . $e->getMessage());
        }
    }

    public function update()
{
    DB::beginTransaction();
    try {
        $validated = $this->validate();

        // 更新処理
        $report = DailyReport::findOrFail($this->reportId);
        $report->update([
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'site_id' => $this->selectedSite,
            'person_in_charge' => $this->person_in_charge,
            'comment' => $this->comment,
            'date' => $this->date, // 新しい日付を更新
        ]);

        // 既存のDailyReportUserを削除
        DailyReportUser::where('daily_report_id', $report->id)->delete();

        // 新しいDailyReportUserを作成
        foreach ($this->selectedEmployees as $employeeId) {
            DailyReportUser::create([
                'daily_report_id' => $report->id,
                'user_id' => $employeeId,
                'site_id' => $this->selectedSite,
                'is_actual' => true,
            ]);
        }

        DB::commit();

        session()->flash('success', '日報が正常に更新されました。');
        return redirect()->route('report-display', ['date' => $this->date, 'site_id' => $this->selectedSite]);
    } catch (ValidationException $e) {
        DB::rollBack();
        session()->flash('error', 'バリデーションエラーが発生しました。');
    } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('error', 'データの更新に失敗しました: ' . $e->getMessage());
    }
}

    public function render()
    {
        return view('livewire.report-editing', [
            'employees' => $this->employees,
            'sites' => $this->sites,
        ])->layout('daily-check.report_editing');
    }
}
