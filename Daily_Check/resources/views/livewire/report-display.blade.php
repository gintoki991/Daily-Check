<div>
    <div class="flex justify-center my-4">
        <input type="date" wire:model="selectedDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="flex justify-center space-x-4">
        @foreach($sites as $site)
        <button wire:click="selectSite({{ $site->id }})" class="px-4 py-2 border rounded {{ $selectedSite == $site->id ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
            {{ $site->name }}
        </button>
        @endforeach
    </div>

    <div class="mt-4">
        @if(!empty($reports))
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">開始時間</th>
                    <th class="py-2">終了時間</th>
                    <th class="py-2">担当者</th>
                    <th class="py-2">実際に入った人</th>
                    <th class="py-2">コメント</th>
                    <th class="py-2">操作</th> <!-- 編集ボタン用の新しい列 -->
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td class="py-2">{{ $report->start_time }}</td>
                    <td class="py-2">{{ $report->end_time }}</td>
                    <td class="py-2">{{ $report->personInCharge->name }}</td>
                    <td class="py-2">
                        @foreach($report->actualUsers as $user)
                        {{ $user->name }}<br>
                        @endforeach
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
        <p class="text-center">該当する日報がありません。</p>
        @endif
    </div>
</div>
