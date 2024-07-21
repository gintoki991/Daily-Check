<div>
    <form wire:submit.prevent="submit">
        <label for="siteSelect">現場を選択:</label>
        <select id="siteSelect" wire:model="selectedSite">
            <option value="">選択してください</option>
            @foreach($sites as $site)
            <option value="{{ $site->id }}">{{ $site->name }}</option>
            @endforeach
        </select>

        <!-- 日付を選択 -->
        <div class="p-2 w-1/2">
            <label for="plan_date" class="text-sm text-gray-800">日付を選択</label>
            <input type="date" id="plan_date" wire:model="selectedDate"><br>

            <label for="employeeSelect">現場に入る予定の従業員を選択:</label>
            <div id="employeeSelect">
                @foreach($employees as $employee)
                <div>
                    <input type="checkbox" wire:model="selectedEmployees" value="{{ $employee->id }}">{{ $employee->name }}
                </div>
                @endforeach
            </div>

            <button type="submit">登録</button>
        </div>
    </form>

    @if (session()->has('message'))
    <div>{{ session('message') }}</div>
    @endif
</div>
