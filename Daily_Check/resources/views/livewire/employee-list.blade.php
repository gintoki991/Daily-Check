<div class="w-full p-2 overflow-x-auto container mx-auto px-4 py-8 bg-white rounded-md max-w-4xl">
    <table class="w-full border-collapse border border-slate-400">
        <caption class="caption-top text-xl font-semibold mb-4">
            従業員一覧
        </caption>
        <thead>
            <tr>
                <!-- <th class="border border-slate-300 px-4 py-2"></th> -->
                <th class="border border-slate-300 px-4 py-2">所属</th>
                <th class="border border-slate-300 px-4 py-2">名前</th>
                <th class="border border-slate-300 px-4 py-2">メールアドレス</th>
                <th class="border border-slate-300 px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                @if($editingEmployee && $editingEmployee->id === $employee->id)
                <td class="border border-slate-300 px-4 py-2"><input type="text" wire:model="editBelongTo" class="w-full px-2 py-1 border rounded"></td>
                <td class="border border-slate-300 px-4 py-2"><input type="text" wire:model="editName" class="w-full px-2 py-1 border rounded"></td>
                <td class="border border-slate-300 px-4 py-2"><input type="email" wire:model="editEmail" class="w-full px-2 py-1 border rounded"></td>
                <!-- <td class="border border-slate-300 px-4 py-2"></td> -->
                <td class="border border-slate-300 px-4 py-2">
                    <div class="flex justify-end space-x-2">
                        <!-- キャンセルボタン -->
                        <button wire:click="cancelEdit" class="py-2 px-3 inline-flex items-center text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 cursor-pointer">
                            キャンセル
                        </button>
                        <!-- 保存ボタン -->
                        <button wire:click="save" class="py-2 px-3 inline-flex items-center text-sm font-semibold rounded-lg bg-teal-500 text-white hover:bg-teal-600 cursor-pointer">
                            保存
                        </button>
                    </div>
                </td>
                @else
                <!-- <td class="border border-slate-300 px-4 py-2"></td> -->
                <td class="border border-slate-300 px-4 py-2">{{ $employee->belong_to }}</td>
                <td class="border border-slate-300 px-4 py-2">{{ $employee->name }}</td>
                <td class="border border-slate-300 px-4 py-2">{{ $employee->email }}</td>
                <td class="border border-slate-300 px-4 py-2">
                    <div class="flex justify-end space-x-2">
                        <!-- 編集ボタン（濃いグレー） -->
                        <button wire:click="edit({{ $employee->id }})" class="py-2 px-3 inline-flex items-center text-lg font-semibold rounded-lg bg-gray-900 text-gray-100 hover:bg-gray-700 cursor-pointer">
                            編集
                        </button>
                        <!-- 削除ボタン（赤） -->
                        <button wire:click="confirmDelete({{ $employee->id }})" class="py-2 px-3 inline-flex items-center text-lg font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 cursor-pointer">
                            削除
                        </button>
                    </div>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 削除確認ダイアログ -->
    <div x-data="{ open: @entangle('confirmingEmployeeDeletion') }" x-show="open" class="fixed inset-0 z-10 flex items-center justify-center overflow-y-auto">
        <div class="fixed inset-0 bg-gray-500 opacity-75" aria-hidden="true"></div>

        <div class="bg-white rounded-lg shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:my-8">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                本当に削除しますか？
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse flex items-center justify-center">
                <!-- 「はい」ボタン（赤） -->
                <button type="button" wire:click="delete" class="py-2 px-3 mx-2 mb-2 inline-flex items-center gap-x-2 text-lg font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
                    はい
                </button>
                <!-- 「いいえ」ボタン　-->
                <button type="button" wire:click="cancelDelete" class="py-2 px-3 mx-2 mb-2 inline-flex items-center gap-x-2 text-lg font-semibold rounded-lg border border-transparent bg-gray-900 text-black hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 sm:mt-0 sm:w-auto sm:text-sm cursor-pointer">
                    いいえ
                </button>
            </div>
        </div>
    </div>
</div>
