<div class="container max-w-full mx-auto px-4 py-8">
    <div class="mb-4">
        <label for="siteSelect" class="block text-gray-700 text-sm font-bold mb-2">現場を選択:</label>
        <div class="flex flex-wrap gap-4">
            @foreach($sites as $site)
            <button wire:click="$set('site_id', {{ $site->id }})" class="flex-1 px-4 py-2 border rounded {{ $site_id == $site->id ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                {{ $site->name }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">部位を選択:</label>
        <div class="flex flex-wrap gap-4">
            <button wire:click="$set('part', '屋根')" class="flex-1 px-4 py-2 border rounded {{ $part == '屋根' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">屋根</button>
            <button wire:click="$set('part', '外壁')" class="flex-1 px-4 py-2 border rounded {{ $part == '外壁' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">外壁</button>
            <button wire:click="$set('part', '軒天')" class="flex-1 px-4 py-2 border rounded {{ $part == '軒天' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">軒天</button>
        </div>
    </div>

    <div>
        <p>選択された現場: {{ $name }}</p>
        <p>選択された部位: {{ $part }}</p>
    </div>

    @if ($site_id && $part)
    <div class="mt-4">
        @if ($photos->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($photos as $photo)
            <div class="border rounded p-4">
                <h3 class="text-lg font-semibold">{{ $photo->part }}</h3>
                <img src="{{ Storage::url($photo->path) }}" alt="Photo">
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $photos->links() }}
        </div>
        @else
        <p class="text-center">この現場には写真がありません。</p>
        @endif
    </div>
    @endif
</div>
