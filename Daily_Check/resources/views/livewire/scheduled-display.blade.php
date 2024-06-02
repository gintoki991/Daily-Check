<div>
    <div class="flex justify-center my-4">
        <input type="text" id="schedule_date" wire:model="selectedDate">
    </div>

    <div class="flex justify-center space-x-4">
        @foreach($sites as $site)
        <button wire:click="selectSite({{ $site->id }})" class="px-4 py-2 border rounded">
            {{ $site->name }}
        </button>
        @endforeach
    </div>

    <div class="mt-4">
        @if(!empty($scheduledUsers))
        <ul>
            @foreach($scheduledUsers as $user)
            <li>{{ $user->name }}</li>
            @endforeach
        </ul>
        @else
        <p class="text-center">該当する予定の人がいません。</p>
        @endif
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        flatpickr("#schedule_date", {
            "locale": "ja",
            onChange: function(selectedDates, dateStr, instance) {
                Livewire.emit('dateChanged', dateStr);
            }
        });
    });
</script>
