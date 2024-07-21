<div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">現場を選択:</label>
        <div class="flex space-x-4">
            @foreach($sites as $site)
            <button wire:click="$set('site_id', '{{ $site->id }}')" class="px-4 py-2 border rounded {{ $site_id == $site->id ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                {{ $site->name }}
            </button>
            @endforeach
        </div>
    </div>

    <div>
        <p>選択された現場ID: {{ $site_id }}</p>
    </div>

    @if ($site_id)
    <div class="mt-4">
        @if ($documents->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($documents as $document)
            <div class="border rounded p-4">
                <div class="flex items-center justify-between">
                    <button wire:click="confirmDeletion({{ $document->id }})" class="mr-2 p-2 bg-red-500 text-white rounded">
                        削除
                    </button>
                    @if ($editingDocumentId === $document->id)
                    <input type="text" wire:model="newDocumentTitle" class="p-2 border rounded" />
                    <button wire:click="updateDocument" class="ml-2 p-2 bg-green-500 text-white rounded">保存</button>
                    @else
                    <h3 class="text-lg font-semibold cursor-pointer" wire:click="editDocument({{ $document->id }})">
                        {{ $document->name }}
                    </h3>
                    @endif
                </div>
                <iframe src="{{ Storage::url($document->pdf_path) }}" width="100%" height="500px"></iframe>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $documents->links() }}
        </div>
        @else
        <p class="text-center">この現場には書類がありません。</p>
        @endif
    </div>
    @endif

    <!-- 確認モーダル -->
    @if($confirmingDocumentDeletion)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-lg font-semibold mb-4">本当に削除しますか？</h2>
            <div class="flex justify-end">
                <button wire:click="deleteDocument" class="px-4 py-2 bg-red-500 text-white rounded mr-2">はい</button>
                <button wire:click="$set('confirmingDocumentDeletion', false)" class="px-4 py-2 bg-gray-300 text-black rounded">いいえ</button>
            </div>
        </div>
    </div>
    @endif
</div>
