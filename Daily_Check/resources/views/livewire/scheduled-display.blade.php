<div class="w-full p-2 overflow-x-auto container mx-auto px-0 py-2 bg-white rounded-md max-w-4xl">
    <div class="text-center text-lg font-semibold mb-4">
        現場に入る予定の人を確認する
    </div>

    <div class="flex justify-center my-4">
        <input type="date" id="schedule_date" wire:model="selectedDate" class="shadow appearance-none border rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
    </div>

    <div class="flex justify-left overflow-x-auto space-x-4">
        @foreach($sites as $site)
        <button wire:click="selectSite({{ $site->id }})" class="px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ $selectedSite == $site->id ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20">
            {{ $site->name }}
        </button>
        @endforeach
    </div>

    <div class="mt-4">
        <div class="font-semibold px-4">入る予定の人</div>
        @if(!empty($scheduledUsers) && $scheduledUsers->isNotEmpty())
        <ol>
            @foreach($scheduledUsers as $user)
            <li class="mt-1">{{ $user->name }}</li>
            @endforeach
        </ol>
        @else
        <p class="text-center">該当する予定の人はいません。</p>
        @endif
    </div>
</div>
