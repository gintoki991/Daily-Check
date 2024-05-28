<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\DailyReport;
use App\Models\Site;
use App\Models\Photo;
use App\Models\Scheduled;
use Illuminate\Validation\ValidationException;

class ReportCreating extends Component
{
    use WithFileUploads;

    public $year;
    public $month;
    public $day;
    public $start_time;
    public $end_time;
    public $sites;
    public $person_in_charge;
    public $comment;
    public $user_ids = [];
    public $photos = [];
    public $part;
    public $site_id;
    public $scheduled_id;
    public $users;

    protected $rules = [
        'year' => 'required|integer|min:2023|max:2100',
        'month' => 'required|integer|min:1|max:12',
        'day' => 'required|integer|min:1|max:31',
        'start_time' => 'required',
        'end_time' => 'required',
        'site_id' => 'required|integer|exists:sites,id',
        'person_in_charge' => 'required|string',
        'comment' => 'nullable|string|max:255',
        'user_ids' => 'array',
        'user_ids.*' => 'integer|exists:users,id',
    ];

    // 子コンポーネントからデータを受け取る
    protected $listeners = [
        'date-changed' => 'updateDate',
        'start-time-changed' => 'updateStartTime',
        'end-time-changed' => 'updateEndTime',
        'photosUpdated' => 'setPhotos',
        'partUpdated' => 'setPart',
        'siteIdUpdated' => 'setSiteId',
        'scheduledIdUpdated' => 'setScheduledId',
    ];

    public function mount()
    {
        $this->users = User::all();
        $this->sites = Site::all();
    }

    public function updateDate($year, $month, $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        Log::info("Date updated to: $year-$month-$day");
    }

    public function updateStartTime($hour, $minute)
    {
        Log::info("Received start-time-changed event with hour: $hour, minute: $minute");
        $this->start_time = sprintf('%02d:%02d:00', $hour, $minute);
        Log::info("Start time updated to: $this->start_time");
    }

    public function updateEndTime($hour, $minute)
    {
        Log::info("Received end-time-changed event with hour: $hour, minute: $minute");
        $this->end_time = sprintf('%02d:%02d:00', $hour, $minute);
        Log::info("End time updated to: $this->end_time");
    }

    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    public function setPart($part)
    {
        $this->part = $part;
    }

    public function setSiteId($site_id)
    {
        $this->site_id = $site_id;
    }

    public function setScheduledId($scheduled_id)
    {
        $this->scheduled_id = $scheduled_id;
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
                    'year' => $this->year,
                    'month' => $this->month,
                    'day' => $this->day,
                    'site_id' => $this->site_id
                ],
                [
                    'user_id' => null
                ]
            );
            $this->scheduled_id = $scheduled->id;

            // DailyReportテーブルにデータを保存
            $report = DailyReport::create([
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'site_id' => $this->site_id,
                'scheduled_id' => $this->scheduled_id,
                'person_in_charge' => $this->person_in_charge,
                'comment' => $this->comment,
            ]);

            foreach ($this->photos as $photo) {
                $path = $photo->store('photos', 'public');
                $report->photos()->create([
                    'path' => $path,
                    'part' => $this->part,
                    'site_id' => $this->site_id,
                    'scheduled_id' => $this->scheduled_id
                ]);
            }

            foreach ($this->user_ids as $user_id) {
                $report->users()->attach($user_id, [
                    'site_id' => $this->site_id,
                    'is_scheduled' => true,
                    'is_actual' => false,
                ]);
            }

            DB::commit();
            session()->flash('success', '日報が正常に提出されました。');
            $this->reset(['year', 'month', 'day', 'start_time', 'end_time', 'person_in_charge', 'comment', 'user_ids', 'photos', 'part', 'site_id', 'scheduled_id']);
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
            'users' => $this->users,
        ])->layout('daily-check.report-creating');
    }
}
