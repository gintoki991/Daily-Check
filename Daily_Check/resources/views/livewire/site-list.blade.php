<div>
    <h1>現場一覧</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>現場名</th>
                <th>詳細</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sites as $site)
            <tr>
                <td>{{ $site->id }}</td>
                <td>
                    @if($editingSite && $editingSite->id === $site->id)
                    <input type="text" wire:model="editName">
                    @else
                    {{ $site->name }}
                    @endif
                </td>
                <td></td>
                <td>
                    @if($editingSite && $editingSite->id === $site->id)
                    <button wire:click="save">保存</button>
                    <button wire:click="cancelEdit">キャンセル</button>
                    @else
                    <button wire:click="edit({{ $site->id }})">編集</button>
                    @endif
                    <button onclick="confirmDelete({{ $site->id }})">削除</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 削除確認ダイアログ -->
    <div x-data="{ open: @entangle('confirmingSiteDeletion') }" x-show="open" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
    </div>

    <script>
        function confirmDelete(id) {
            @this.confirmDelete(id);
        }
    </script>
</div>
