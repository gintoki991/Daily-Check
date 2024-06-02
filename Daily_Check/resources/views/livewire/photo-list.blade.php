<div>
    <div class="mb-4">
        <label for="siteSelect" class="block text-gray-700 text-sm font-bold mb-2">現場を選択:</label>
        <select id="siteSelect" wire:model="site_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">選択してください</option>
            @foreach($sites as $site)
            <option value="{{ $site->id }}">{{ $site->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">部位を選択:</label>
        <div>
            <button wire:click="$set('part', '屋根')" class="btn-part">屋根</button>
            <button wire:click="$set('part', '外壁')" class="btn-part">外壁</button>
            <button wire:click="$set('part', '軒天')" class="btn-part">軒天</button>
        </div>
    </div>

    <div>
        <p>選択された現場ID: {{ $site_id }}</p>
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

<!-- <script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('update-content', () => {
            Livewire.emit('render');
        });
    });
</script> -->
