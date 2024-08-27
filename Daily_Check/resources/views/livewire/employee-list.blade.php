<div class="w-full p-2 overflow-x-auto container mx-auto px-4 py-8 bg-white rounded-md max-w-4xl">
    <table class="w-full border-collapse border border-slate-400">
        <caption class="caption-top text-lg font-semibold mb-4">
            従業員一覧
        </caption>
        <thead>
            <tr>
                <th class="border border-slate-300 px-4 py-2"></th>
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
                <td class="border border-slate-300 px-4 py-2"><button wire:click="cancelEdit" class="text-blue-500">キャンセル</button></td>
                <td class="border border-slate-300 px-4 py-2"><input type="text" wire:model="editBelongTo" class="w-full px-2 py-1 border rounded"></td>
                <td class="border border-slate-300 px-4 py-2"><input type="text" wire:model="editName" class="w-full px-2 py-1 border rounded"></td>
                <td class="border border-slate-300 px-4 py-2"><input type="email" wire:model="editEmail" class="w-full px-2 py-1 border rounded"></td>
                <td class="border border-slate-300 px-4 py-2"><button wire:click="save" class="text-green-500">保存</button></td>
                @else
                <td class="border border-slate-300 px-4 py-2"><button wire:click="confirmDelete({{ $employee->id }})" class="text-red-500">削除</button></td>
                <td class="border border-slate-300 px-4 py-2">{{ $employee->belong_to }}</td>
                <td class="border border-slate-300 px-4 py-2">{{ $employee->name }}</td>
                <td class="border border-slate-300 px-4 py-2">{{ $employee->email }}</td>
                <td class="border border-slate-300 px-4 py-2"><button wire:click="edit({{ $employee->id }})" class="text-blue-500">編集</button></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
