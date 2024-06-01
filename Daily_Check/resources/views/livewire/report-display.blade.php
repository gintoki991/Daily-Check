<div>
    <div class="flex justify-center my-4">
        <input type="text" id="report_display_date" wire:model="selectedDate">
    </div>

    <div class="flex justify-center space-x-4">
        @foreach($sites as $site)
        <button wire:click="selectSite({{ $site->id }})" class="px-4 py-2 border rounded">
            {{ $site->name }}
        </button>
        @endforeach
    </div>

    <div class="mt-4">
        @if(!empty($reports))
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">開始時間</th>
                    <th class="py-2">終了時間</th>
                    <th class="py-2">担当者</th>
                    <th class="py-2">実際に入ったか</th>
                    <th class="py-2">コメント</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td class="py-2">{{ $report->start_time }}</td>
                    <td class="py-2">{{ $report->end_time }}</td>
                    <td class="py-2">{{ $report->personInCharge->name }}</td>
                    <td class="py-2">{{ $report->is_actual ? 'はい' : 'いいえ' }}</td>
                    <td class="py-2">{{ $report->comment }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center">該当する日報がありません。</p>
        @endif
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        flatpickr("#report_display_date", {
            "locale": "ja",
            onChange: function(selectedDates, dateStr, instance) {
                Livewire.emit('dateChanged', dateStr);
            }
        });
    });
</script>
