<div>
    <h1>現場一覧</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>現場名</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sites as $site)
            <tr>
                <td>{{ $site->id }}</td>
                <td>{{ $site->name }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
