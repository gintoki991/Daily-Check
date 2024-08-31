<div class="w-full p-2 overflow-x-auto container mx-auto px-0 py-2 bg-white rounded-md max-w-4xl">
    <div class="text-center text-lg font-semibold mb-4">
        ” {{ $currentDate }} ” {{ $userName }}さんの予定
    </div>

    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <!-- <thead class="bg-gray-50">
            <tr>
                <th class="w-1/3 px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">項目</th>
                <th class="w-2/3 px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">内容</th>
            </tr>
        </thead> -->
        <tbody class="divide-y divide-gray-200">
            <tr>
                <td class="w-1/3 px-3 py-1 text-sm font-medium text-gray-800">現場名</td>
                <td class="w-2/3 px-3 py-1 text-sm text-gray-800">{{ $currentSiteName }}</td>
            </tr>
            <tr>
                <td class="w-1/3 px-3 py-1 text-sm font-medium text-gray-800">連絡事項</td>
                <td class="w-2/3 px-3 py-1 text-sm text-gray-800">
                    <ul class="list-disc pl-3">
                        @forelse($announcements as $announcement)
                        <li>{{ $announcement['date'] }}: {{ $announcement['comment'] }}</li>
                        @empty
                        <li>連絡事項はありません。</li>
                        @endforelse
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="w-1/3 px-3 py-1 text-sm font-medium text-gray-800">メンバー（予定）</td>
                <td class="w-2/3 px-3 py-1 text-sm text-gray-800">
                    <ul class="list-disc pl-3">
                        @forelse($scheduledUsers as $user)
                        <li>{{ $user }}</li>
                        @empty
                        <li>予定されているユーザーはいません。</li>
                        @endforelse
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
</div>
