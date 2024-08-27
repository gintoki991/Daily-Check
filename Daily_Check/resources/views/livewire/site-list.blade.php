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
                    <!-- 保存ボタン -->
                    <button wire:click="save" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 cursor-pointer">
                        保存
                    </button>

                    <!-- キャンセルボタン -->
                    <button wire:click="cancelEdit" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">
                        キャンセル
                    </button>
                    @else
                    <!-- 編集ボタン（濃いグレー） -->
                    <button wire:click="edit({{ $site->id }})" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-900 text-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 cursor-pointer">
                        編集
                    </button>
                    @endif

                    <!-- 削除ボタン（赤） -->
                    <button wire:click="confirmDelete({{ $site->id }})" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 cursor-pointer">
                        削除
                    </button>
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
                        <h3 class="text-lg leading-6 font-medium text-center text-gray-900" id="modal-title">
                            削除確認
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                本当に削除しますか？
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <!-- 「はい」ボタン（赤） -->
                <button type="button" wire:click="delete" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
                    はい
                </button>

                <!-- 「いいえ」ボタン（緑） -->
                <button type="button" wire:click="cancelDelete" class="py-2 px-3 mt-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm cursor-pointer">
                    いいえ
                </button>
            </div>
        </div>
    </div>
</div>
