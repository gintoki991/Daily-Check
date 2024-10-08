<div>
    <div class="flex justify-center my-4 px-4">
        <input type="date" wire:model="selectedDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
    </div>

    <div class="flex justify-center space-x-4 px-4">
        @foreach($sites as $site)
        <button wire:click="selectSite({{ $site->id }})" class="px-4 py-2 inline-flex items-center gap-x-2 text-lg font-medium rounded-lg border border-transparent {{ $selectedSite == $site->id ? 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700' : 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200' }} cursor-pointer">
            {{ $site->name }}
        </button>
        @endforeach
    </div>

    <div class="border rounded-xl shadow-sm p-4">
        @if(!empty($reports))
        <table class="min-w-full bg-white border rounded">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-2">作業時間</th>
                    <th class="py-2">担当者</th>
                    <th class="py-2">作業者</th>
                    <th class="py-2">コメント</th>
                    <th class="py-2">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td class="py-2">
                        <div>
                            {{ \Carbon\Carbon::parse($report->start_time)->format('H:i') }}<br>~<br>{{ \Carbon\Carbon::parse($report->end_time)->format('H:i') }}
                        </div>
                    </td>
                    <td class="py-2">{{ $report->personInCharge->name }}</td>
                    <td class="py-2">
                        @if($report->dailyReportUserRoles->isNotEmpty())
                        @foreach($report->dailyReportUserRoles as $role)
                        @if($role->scheduledUser->scheduled_id == $report->scheduled_id)
                        {{ $role->scheduledUser->user->name }}<br>
                        @endif
                        @endforeach
                        @else
                        <span>データなし</span>
                        @endif
                    </td>
                    <td class="py-2">{{ $report->comment }}</td>
                    <td class="py-2">
                        <a href="{{ route('ReportEditing', ['reportId' => $report->id]) }}" class="text-blue-500 hover:text-blue-700">編集</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-white text-center">該当する日報がありません</p>
        @endif
    </div>
</div>
