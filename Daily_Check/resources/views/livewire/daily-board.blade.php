<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="border rounded-lg overflow-hidden dark:border-neutral-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-700">
                        <tr>
                            <th scope="col" class="w-1/3 px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">項目</th>
                            <th scope="col" class="w-2/3 px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">内容</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        <!-- ログインユーザー名と日付 -->
                        <tr>
                            <td class="w-1/3 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">ユーザー名</td>
                            <td class="w-2/3 px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $userName }} - {{ $currentDate }}</td>
                        </tr>

                        <!-- 現場名 -->
                        <tr>
                            <td class="w-1/3 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">現場名</td>
                            <td class="w-2/3 px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $currentSiteName }}</td>
                        </tr>

                        <!-- 連絡事項 -->
                        <tr>
                            <td class="w-1/3 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">連絡事項</td>
                            <td class="w-2/3 px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                <ul class="list-disc pl-5">
                                    @forelse($announcements as $announcement)
                                    @if(is_array($announcement))
                                    <li>{{ $announcement['date'] ?? '日付不明' }} - {{ $announcement['comment'] ?? 'コメントなし' }}</li>
                                    @else
                                    <li>{{ $announcement }}</li>
                                    @endif
                                    @empty
                                    <li>連絡事項はありません。</li>
                                    @endforelse
                                </ul>
                            </td>
                        </tr>

                        <!-- メンバー（予定） -->
                        <tr>
                            <td class="w-1/3 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">メンバー（予定）</td>
                            <td class="w-2/3 px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                <ul class="list-disc pl-5">
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
        </div>
    </div>
</div>
