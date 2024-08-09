<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;
use App\Models\User;
use App\Models\Scheduled;
use App\Models\ScheduledUser;
use Illuminate\Support\Facades\DB;

class ScheduleRegistration extends Component
{
    public $sites;
    public $employees;
    public $selectedDate;
    public $selectedSite;
    public $selectedEmployees = [];

    protected $updatesQueryString = ['selectedSite', 'selectedDate'];

    public function mount()
    {
        $this->sites = Site::all();
        $this->employees = User::all();
        $this->selectedDate = request()->query('selectedDate', now()->format('Y-m-d'));
        $this->selectedSite = request()->query('selectedSite', $this->selectedSite);

        $this->checkExistingSchedules();
    }

    public function updated($propertyName)
    {
        // 現場または日付が更新されたときに、既存のスケジュールをチェック
        if (in_array($propertyName, ['selectedSite', 'selectedDate'])) {
            $this->checkExistingSchedules();
        }
    }

    // 既存のスケジュールを確認し、該当する従業員を自動で選択
    public function checkExistingSchedules()
    {
        if ($this->selectedDate && $this->selectedSite) {
            $existingScheduled = Scheduled::where('date', $this->selectedDate)
                ->where('site_id', $this->selectedSite)
                ->first();

            if ($existingScheduled) {
                $this->selectedEmployees = ScheduledUser::where('scheduled_id', $existingScheduled->id)
                    ->where('is_scheduled', true)
                    ->pluck('user_id')
                    ->toArray();
            }
        }
    }

    public function submit()
    {
        $this->validate([
            'selectedDate' => 'required|date',
            'selectedSite' => 'required|exists:sites,id',
            'selectedEmployees' => 'required|array',
            'selectedEmployees.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            // `scheduleds` テーブルにデータを保存
            $scheduled = Scheduled::updateOrCreate(
                [
                    'date' => $this->selectedDate,
                    'site_id' => $this->selectedSite,
                ],
                []
            );

            // `scheduled_user` テーブルに is_scheduled を保存
            foreach ($this->selectedEmployees as $employeeId) {
                ScheduledUser::updateOrCreate(
                    [
                        'scheduled_id' => $scheduled->id,
                        'user_id' => $employeeId,
                        'site_id' => $this->selectedSite,
                    ],
                    [
                        'is_scheduled' => true,
                    ]
                );
            }

            DB::commit();
            session()->flash('message', '登録が成功しました！');
            $this->dispatch('refreshComponent'); // コンポーネントのリフレッシュ

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'データの保存に失敗しました: ' . $e->getMessage());
            $this->dispatch('refreshComponent'); // コンポーネントのリフレッシュ
        }
    }

    public function render()
    {
        return view('livewire.schedule-registration', [
            'sites' => $this->sites,
            'employees' => $this->employees,
        ])->layout('daily-check.workers_arrangement');
    }
}
