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
