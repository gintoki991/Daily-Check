<div>
    <div class="mb-4">
        <label for="siteSelect" class="block text-gray-700 text-sm font-bold mb-2">現場を選択:</label>
        <div class="flex space-x-4">
            @foreach($sites as $site)
            <button wire:click="$set('site_id', {{ $site->id }})" class="px-4 py-2 border rounded {{ $site_id == $site->id ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                {{ $site->name }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">部位を選択:</label>
        <div class="flex space-x-4">
            <button wire:click="$set('part', '屋根')" class="px-4 py-2 border rounded {{ $part == '屋根' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">屋根</button>
            <button wire:click="$set('part', '外壁')" class="px-4 py-2 border rounded {{ $part == '外壁' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">外壁</button>
            <button wire:click="$set('part', '軒天')" class="px-4 py-2 border rounded {{ $part == '軒天' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">軒天</button>
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
                <div class="flex items-center justify-between">
                    <button wire:click="confirmDeletion({{ $photo->id }})" class="mr-2 p-2 bg-red-500 text-white rounded">
                        削除
                    </button>
                    @if ($editingPhotoId === $photo->id)
                    <select wire:model="newPhotoTitle" class="p-2 border rounded">
                        @foreach($partOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    <button wire:click="updatePhoto" class="ml-2 p-2 bg-green-500 text-white rounded">保存</button>
                    @else
                    <h3 class="text-lg font-semibold cursor-pointer" wire:click="editPhoto({{ $photo->id }})">
                        {{ $photo->part }}
                    </h3>
                    @endif
                </div>
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

    <!-- 確認モーダル -->
    @if($confirmingPhotoDeletion)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-lg font-semibold mb-4">本当に削除しますか？</h2>
            <div class="flex justify-end">
                <button wire:click="deletePhoto" class="px-4 py-2 bg-red-500 text-white rounded mr-2">はい</button>
                <button wire:click="$set('confirmingPhotoDeletion', false)" class="px-4 py-2 bg-gray-300 text-black rounded">いいえ</button>
            </div>
        </div>
    </div>
    @endif
</div>
