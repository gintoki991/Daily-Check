<div class="w-full p-2 overflow-x-auto container mx-auto px-0 py-1 bg-white rounded-md max-w-4xl">
    <div class="text-center text-lg font-semibold mb-2">
        一週間の予定
    </div>

    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead>
            <tr>
                <th class="whitespace-nowrap px-4 py-2 font-medium font-semibold text-gray-900">日付</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium font-semibold text-gray-900">現場</th>
                <!-- <th class="px-4 py-2"></th> -->
            </tr>
        </thead>
        <tbody class="text-center divide-y divide-gray-200">
            @foreach($weeklySchedule as $date => $sites) <!-- $date は既に正しいフォーマット -->
            @foreach($sites as $site)
            <tr>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $date }}</td> <!-- そのまま表示 -->
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $site }}</td>
                <!-- <td class="whitespace-nowrap px-4 py-2">
                    <a href="#" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                        詳細
                    </a>
                </td> -->
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
