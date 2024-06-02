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
                <h3 class="text-lg font-semibold">{{ $document->name }}</h3>
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
</div>
