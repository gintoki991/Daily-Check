<div>
    <h1>従業員一覧</h1>
    <table>
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>所属</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->belong_to }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
