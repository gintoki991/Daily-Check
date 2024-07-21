<div class="text-gray-700 py-8 flex flex-wrap md:flex-nowrap">
    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
        <span class="font-semibold title-font">ログインユーザー名</span>
        <span class="mt-1 text-gray-500 text-sm">{{ $userName }}</span>
        <span class="mt-1 text-gray-500 text-sm">{{ $currentDate }}</span>
    </div>
    <div class="md:flex-grow">
        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">現　場　名: {{ $currentSiteName }}</h2>
        <h1 class="text-2xl font-medium text-gray-900 title-font mb-2">連絡事項：</h1>
        <p class="leading-relaxed">
            @foreach($announcements as $announcement)
            {{ $announcement }}<br>
            @endforeach
        </p>
        <h1 class="text-2xl font-medium text-gray-900 title-font mb-2">メンバー（予定）：</h1>
        <p class="leading-relaxed">
            @foreach($scheduledUsers as $user)
            {{ $user }}<br>
            @endforeach
        </p>
    </div>
</div>
