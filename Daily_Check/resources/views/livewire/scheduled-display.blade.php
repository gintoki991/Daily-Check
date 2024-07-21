<div>
    <div class="flex justify-center my-4">
        <input type="date" id="schedule_date" wire:model="selectedDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="flex justify-center space-x-4">
        @foreach($sites as $site)
        <button wire:click="selectSite({{ $site->id }})" class="px-4 py-2 border rounded {{ $selectedSite == $site->id ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
            {{ $site->name }}
        </button>
        @endforeach
    </div>

    <div class="mt-4">
        <h1>入る予定の人</h1>
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
