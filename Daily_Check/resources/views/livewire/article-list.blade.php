<div>

    <table class="w-full text-sm mb-5">
        <thead>
            <tr>
                <th class="border p-2">タイトル</th>
                <th class="border p-2">本文</th>
                <th class="border p-2">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td class="border px-2 py-1">{{ $article->title }}</td>
                <td class="border px-2 py-1">{{ $article->content }}</td>
                <td class="border px-2 py-1 text-right">
                    <button type="button" class="bg-yellow-500 text-yellow-50 rounded p-2 text-xs" wire:click="$emitTo('article-input', 'edit', {{ $article->id }})">
                        変更
                    </button>
                    <button type="button" class="bg-red-600 text-red-50 rounded p-2 text-xs" onClick="onDelete('{{ $article->id }}')">
                        削除
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $articles->links() }}

    <script>
        function onDelete(id) {

            if (confirm('削除します。よろしいですか？')) {

                Livewire.emitTo('article-list', 'destroy', id);

            }

        }
    </script>

</div>
