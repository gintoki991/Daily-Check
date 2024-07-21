<div>
    <h1>従業員一覧</h1>
    <table>
        <thead>
            <tr>
                <th>所属</th>
                <th>名前</th>
                <th>メールアドレス</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->belong_to }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
