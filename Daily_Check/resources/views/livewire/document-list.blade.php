<div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm text-white font-bold mb-2">現場を選択</label>
        <div class="flex flex-wrap gap-4">
            @foreach($sites as $site)
            <button wire:click="$set('site_id', '{{ $site->id }}')" class="flex-1 px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ $site_id == $site->id ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20">
                {{ $site->name }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="text-white">
        <p>選択された現場ID: {{ $site_id }}</p>
    </div>

    @if ($site_id)
    <div class="mt-4">
        @if ($documents->count())
        <div class="grid grid-cols-1 gap-4">
            @foreach ($documents as $document)
            <div class="border rounded p-4">
                <h3 class="text-lg text-white font-semibold">{{ $document->name }}</h3>
                <iframe src="{{ Storage::url($document->pdf_path) }}" width="100%" height="500px"></iframe>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $documents->links() }}
        </div>
        @else
        <p class="text-white text-center">この現場には書類がありません</p>
        @endif
    </div>
    @endif
</div>
