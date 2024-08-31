<div>
    <div class="mb-4">
        <label for="siteSelect" class="block text-gray-700 text-sm text-white font-bold mb-2 mt-4">現場を選択</label>
        <div class="flex flex-wrap gap-4">
            @foreach($sites as $site)
            <button wire:click="$set('site_id', {{ $site->id }})" class="flex-1 px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ $site_id == $site->id ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20">
                {{ $site->name }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm text-white font-bold mb-2">部位を選択</label>
        <div class="flex flex-wrap gap-4">
            <button wire:click="$set('part', '屋根')" class="flex-1 px-4 py-2 inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-center {{ $part == '屋根' ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20">
                屋根
            </button>
            <button wire:click="$set('part', '外壁')" class="flex-1 px-4 py-2 inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-center {{ $part == '外壁' ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20">
                外壁
            </button>
            <button wire:click="$set('part', '軒天')" class="flex-1 px-4 py-2 inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-center {{ $part == '軒天' ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20">
                軒天
            </button>
        </div>
    </div>

    <div class="text-sm text-white">
        <p>選択された現場ID: {{ $site_id }}</p>
        <p>選択された部位: {{ $part }}</p>
    </div>

    @if ($site_id && $part)
    <div class="mt-4">
        @if ($photos->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($photos as $photo)
            <div class="bg-white border rounded p-4 overflow-hidden">
                <div class="flex items-center justify-between">
                    <span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">
                        <button
                            wire:click="confirmDeletion({{ $photo->id }})"
                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold font-medium rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 focus:outline-none cursor-pointer focus:bg-red-600 disabled:opacity-50 disabled:pointer-events-none">
                            削除
                        </button>

                        @if ($editingPhotoId === $photo->id)
                        <select wire:model="newPhotoTitle" class="p-2 border cursor-pointer rounded-md w-[300%]">
                            @foreach($partOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                        <button
                            wire:click="updatePhoto"
                            class="py-3 px-4 inline-flex items-center gap-x-2 text-lg font-semibold font-medium rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 cursor-pointer focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none">
                            保存
                        </button>
                        @else
                        <button
                            wire:click="editPhoto({{ $photo->id }})"
                            class="py-3 px-4 inline-flex items-center gap-x-2 text-lg font-medium rounded-lg border border-transparent bg-gray-200 text-gray-700 hover:bg-gray-300 cursor-pointer focus:outline-none focus:bg-gray-300">
                            部位を編集
                        </button>
                        @endif
                    </span>
                </div>
                <img src="{{ Storage::url($photo->path) }}" alt="Photo" class="cursor-pointer max-w-full h-auto mt-4">
            </div>

            @endforeach
        </div>
        <div class="mt-4">
            {{ $photos->links() }}
        </div>
        @else
        <p class="text-white text-center">この現場には写真がありません</p>
        @endif
    </div>
    @endif

    <!-- 確認モーダル -->
    @if($confirmingPhotoDeletion)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white p-6 rounded shadow-lg">
            <div class="text-sm font-medium mb-4">本当に削除しますか？</div>
            <div class="flex justify-end">
                <button wire:click="deletePhoto" class="px-4 py-2 bg-red-500 text-white font-semibold rounded mr-2">はい</button>
                <button wire:click="$set('confirmingPhotoDeletion', false)" class="px-4 py-2 bg-gray-300 text-black rounded">いいえ</button>
            </div>
        </div>
    </div>
    @endif
</div>
