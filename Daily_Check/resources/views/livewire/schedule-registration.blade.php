<div>
    <form wire:submit.prevent="submit">
        <label for="siteSelect">現場を選択:</label>
        <select id="siteSelect" wire:model="selectedSite">
            <option value="">選択してください</option>
            @foreach($sites as $site)
            <option value="{{ $site->id }}">{{ $site->name }}</option>
            @endforeach
        </select>

        <label for="employeeSelect">従業員を選択:</label>
        <div id="employeeSelect">
            @foreach($employees as $employee)
            <div>
                <input type="checkbox" wire:model="selectedEmployees" value="{{ $employee->id }}">{{ $employee->name }}
            </div>
            @endforeach
        </div>

        <button type="submit">登録</button>
    </form>

    @if (session()->has('message'))
    <div>{{ session('message') }}</div>
    @endif
</div>
