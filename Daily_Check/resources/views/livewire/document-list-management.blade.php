<div>
    <div class="mb-4 mt-4">
        <label for="siteSelect" class="block text-gray-700 text-sm text-white font-bold mb-2">現場を選択</label>
        <div class="flex flex-wrap gap-4">
            @foreach($sites as $site)
            <button wire:click="$set('site_id', '{{ $site->id }}')" class="flex-1 px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ $site_id == $site->id ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20">
                {{ $site->name }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="text-sm text-white">
        <p>選択された現場ID: {{ $site_id }}</p>
    </div>

    @if ($site_id)
    <div class="mt-4">
        @if ($documents->count())
        <div class="grid grid-cols-1 gap-4">
            @foreach ($documents as $document)
            <div class="border rounded p-4 overflow-hidden">
                <div class="flex items-center justify-between">
                    <span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">
                        <button
                            wire:click="confirmDeletion({{ $document->id }})"
                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 focus:outline-none cursor-pointer focus:bg-red-600 disabled:opacity-50 disabled:pointer-events-none">
                            削 除
                        </button>

                        @if ($editingDocumentId === $document->id)
                        <input type="text" wire:model="newDocumentTitle" class="p-2 border rounded-md w-[300%]" />

                        <button
                            wire:click="updateDocument"
                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 cursor-pointer focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none">
                            保存
                        </button>
                        @else
                        <button
                            wire:click="editDocument({{ $document->id }})"
                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gray-200 text-gray-700 hover:bg-gray-300 cursor-pointer focus:outline-none focus:bg-gray-300">
                            書類名を編集
                        </button>
                        @endif
                    </span>
                </div>
                <iframe src="{{ Storage::url($document->pdf_path) }}" width="100%" height="500px" class="mt-4"></iframe>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $documents->links() }}
        </div>
        @else
        <p class="text-white text-center">この現場には書類がありません。</p>
        @endif
    </div>
    @endif

    <!-- 確認モーダル -->
    @if($confirmingDocumentDeletion)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white p-6 rounded shadow-lg">
            <div class="text-sm font-medium mb-4">本当に削除しますか？</div>
            <div class="flex justify-end">
                <button wire:click="deleteDocument" class="px-4 py-2 bg-red-500 text-white font-semibold rounded mr-2">はい</button>
                <button wire:click="$set('confirmingDocumentDeletion', false)" class="px-4 py-2 bg-gray-300 text-black rounded">いいえ</button>
            </div>
        </div>
    </div>
    @endif
</div>
