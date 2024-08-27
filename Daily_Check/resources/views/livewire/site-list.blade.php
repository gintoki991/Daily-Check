<div class="w-full p-2 overflow-x-auto container mx-auto px-4 py-4 bg-white rounded-md max-w-4xl">
    <table class="w-full border-collapse border border-slate-400">
        <caption class="caption-top text-lg font-semibold mb-4">
            現場一覧
        </caption>
        <thead>
            <tr>
                <th class="border border-slate-300 px-4 py-2">No.</th>
                <th class="border border-slate-300 px-4 py-2">現場名</th>
                <th class="border border-slate-300 px-4 py-2">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sites as $site)
            <tr>
                <td class="border border-slate-300 px-4 py-2">{{ $site->id }}</td>
                <td class="border border-slate-300 px-4 py-2">
                    @if($editingSite && $editingSite->id === $site->id)
                    <input type="text" wire:model="editName" class="w-full px-2 py-1 border rounded">
                    @else
                    {{ $site->name }}
                    @endif
                </td>
                <td class="border border-slate-300 px-4 py-2">
                    @if($editingSite && $editingSite->id === $site->id)
                    <button wire:click="save" class="text-green-500">保存</button>
                    <button wire:click="cancelEdit" class="text-blue-500">キャンセル</button>
                    @else
                    <button wire:click="edit({{ $site->id }})" class="text-blue-500">編集</button>
                    @endif
                    <button onclick="confirmDelete({{ $site->id }})" class="text-red-500">削除</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 削除確認ダイアログ -->
    <div x-data="{ open: @entangle('confirmingSiteDeletion') }" x-show="open" class="fixed inset-0 z-10 flex items-center justify-center overflow-y-auto">
        <div class="fixed inset-0 bg-gray-500 opacity-75" aria-hidden="true"></div>

        <div class="bg-white rounded-lg shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:my-8">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            削除確認
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                本当にこの現場を削除しますか？
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" wire:click="delete" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    はい
                </button>
                <button type="button" wire:click="cancelDelete" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                    いいえ
                </button>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            @this.confirmDelete(id);
        }
    </script>
</div>
