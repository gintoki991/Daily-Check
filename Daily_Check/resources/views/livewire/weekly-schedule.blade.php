<div class="overflow-x-auto">
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <caption class="font-semibold text-white caption-top px-4 py-2">
            今週の予定
        </caption>
        <thead class="">
            <tr>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">日付</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">現場</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($weeklySchedule as $date => $sites)
            @foreach($sites as $site)
            <tr>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ \Carbon\Carbon::parse($date)->format('Y年m月d日（l）') }}</td>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $site }}</td>
                <td class="whitespace-nowrap px-4 py-2">
                    <a href="#" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
