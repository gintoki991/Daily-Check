<div class="container max-w-full mx-auto px-0 py-2">
    <div class="caption-top text-white text-center text-lg font-semibold mb-4">
        写真を検索
    </div>
    <div class="mb-4">
        <label for="siteSelect" class="block text-white text-sm font-bold mb-2">現場を選択</label>
        <div class="flex flex-wrap gap-4">
            @foreach($sites as $site)
            <button wire:click="$set('site_id', {{ $site->id }})" class="flex-1 px-4 py-2 inline-flex items-center gap-x-2 text-lg font-medium rounded-lg border border-transparent {{ $site_id == $site->id ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20">
                {{ $site->name }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-white text-sm font-bold mb-2">部位を選択</label>
        <div class="flex flex-wrap gap-4">
            <button wire:click="$set('part', '屋根')" class="flex-1 px-4 py-2 inline-flex items-center justify-center gap-x-2 text-lg font-medium rounded-lg border border-transparent text-center {{ $part == '屋根' ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer">
                屋根
            </button>
            <button wire:click="$set('part', '外壁')" class="flex-1 px-4 py-2 inline-flex items-center justify-center gap-x-2 text-lg font-medium rounded-lg border border-transparent text-center {{ $part == '外壁' ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer">
                外壁
            </button>
            <button wire:click="$set('part', '軒天')" class="flex-1 px-4 py-2 inline-flex items-center justify-center gap-x-2 text-lg font-medium rounded-lg border border-transparent text-center {{ $part == '軒天' ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer">
                軒天
            </button>
        </div>
    </div>

    <div class="block text-white text-sm mb-2">
        <p>選択された現場: {{ $name }}</p>
        <p>選択された部位: {{ $part }}</p>
    </div>

    @if ($site_id && $part)
    <div class="mt-2">
        @if ($photos->count())
        <div class="grid grid-cols-1 item-center justify-center gap-4">
            @foreach ($photos as $photo)
            <div class="bg-white border rounded p-4 overflow-hidden">
                <h3 class="text-lg text-steelblue text-sm font-semibold">部位：{{ $photo->part }}</h3>
                <img src="{{ Storage::url($photo->path) }}" alt="Photo" class="cursor-pointer max-w-full h-auto">
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $photos->links() }}
        </div>
        @else
        <p class="text-center text-white text-sm">この現場には写真がありません</p>
        @endif
    </div>
    @endif
</div>
