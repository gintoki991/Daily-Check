<div>
    <h1>従業員一覧</h1>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <table>
        <thead>
            <tr>
                <th></th>
                <th>所属</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                @if($editingEmployee && $editingEmployee->id === $employee->id)
                <td><button wire:click="cancelEdit">キャンセル</button></td>
                <td><input type="text" wire:model="editBelongTo"></td>
                <td><input type="text" wire:model="editName"></td>
                <td><input type="email" wire:model="editEmail"></td>
                <td><button wire:click="save">保存</button></td>
                @else
                <td><button wire:click="confirmDelete({{ $employee->id }})">削除</button></td>
                <td>{{ $employee->belong_to }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td><button wire:click="edit({{ $employee->id }})">編集</button></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($confirmingEmployeeDeletion)
    <div class="confirmation-dialog">
        <p>本当に削除しますか？</p>
        <button wire:click="delete">はい</button>
        <button wire:click="cancelDelete">いいえ</button>
    </div>
    @endif
</div>
