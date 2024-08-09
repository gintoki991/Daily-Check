<div>
    <form wire:submit.prevent="submit">
        <label for="siteSelect">現場を選択:</label>
        <select id="siteSelect" wire:model="selectedSite">
            <option value="">選択してください</option>
            @foreach($sites as $site)
            <option value="{{ $site->id }}">{{ $site->name }}</option>
            @endforeach
        </select>
        @error('selectedSite') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <div class="p-2 w-1/2">
            <!-- 日付を選択 -->
            <label for="plan_date" class="text-sm text-gray-800">日付を選択</label>
            <input type="date" id="plan_date" wire:model="selectedDate"><br>
            @error('selectedDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

            <label for="employeeSelect">現場に入る予定の従業員を選択:</label>
            <div id="employeeSelect">
                @foreach($employees as $employee)
                <div>
                    <input type="checkbox" wire:model="selectedEmployees" value="{{ $employee->id }}" @if(in_array($employee->id, $selectedEmployees)) checked @endif>
                    {{ $employee->name }}
                </div>
                @endforeach
            </div>
            @error('selectedEmployees') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">登録</button>
        </div>
    </form>

    <!-- ポップアップメッセージ -->
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-show="show" @click="show = false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <p class="text-lg text-green-600 font-semibold">{{ session('message') }}</p>
            <button @click="show = false" class="mt-4 inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                閉じる
            </button>
        </div>
    </div>
    @endif

    <!-- エラーメッセージのポップアップ表示 -->
    @if (session()->has('error'))
    <div x-data="{ show: true }" x-show="show" @click="show = false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <p class="text-lg text-red-600 font-semibold">{{ session('error') }}</p>
            <button @click="show = false" class="mt-4 inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                閉じる
            </button>
        </div>
    </div>
    @endif
</div>
