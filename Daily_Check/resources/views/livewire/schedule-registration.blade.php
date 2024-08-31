<div class="w-full p-2 overflow-x-auto container mx-auto px-0 py-2 bg-white rounded-md max-w-4xl">
    <div class="caption-top text-center text-lg font-semibold mb-4">
        従業員の予定を登録
    </div>

    <form wire:submit.prevent="submit" class="grid grid-cols-1">
        <!-- 現場を選択 -->
        <div class="flex items-center justify-center my-2">
            <label for="siteSelect" class="text-gray-700 text-sm font-bold mr-2 text-left w-1/3">現場選択</label>
            <select id="siteSelect" wire:model="selectedSite" class="shadow appearance-none border rounded w-full md:w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
                <option value="">選択してください</option>
                @foreach($sites as $site)
                <option value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>
            @error('selectedSite') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- 日付を選択 -->
        <div class="flex items-center justify-center my-2">
            <label for="plan_date" class="text-gray-700 text-sm font-bold mr-2 text-left w-1/3">日付選択</label>
            <input type="date" id="plan_date" wire:model="selectedDate" class="shadow appearance-none border rounded w-full md:w-2/3 py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
            @error('selectedDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- 従業員を選択 -->
        <div class="flex flex-col items-center justify-center my-4">
            <label for="employeeSelect" class="text-gray-700 text-sm font-bold text-left w-full">従業員を選択</label>
            <div id="employeeSelect" class="grid sm:grid-cols-2 w-full">
                @foreach($employees as $employee)
                <label for="employee-{{ $employee->id }}" class="flex px-2 py-1 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-800 focus:outline-none focus:bg-blue-100 focus:text-blue-800 cursor-pointer">
                    <input type="checkbox" wire:model="selectedEmployees" value="{{ $employee->id }}" class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 hover:border-gray-500 cursor-pointer" id="employee-{{ $employee->id }}" @if(in_array($employee->id, $selectedEmployees)) checked @endif>
                    <span class="text-sm ms-3">{{ $employee->name }}</span>
                </label>
                @endforeach
            </div>
            @error('selectedEmployees') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- 登録ボタン -->
        <div class="flex justify-center">
            <button type="submit" class="w-2/3 py-2 px-8 inline-flex justify-center items-center gap-x-2 font-semibold text-xl font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                登　録
            </button>
        </div>
    </form>

    <!-- ポップアップメッセージ -->
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-show="show" @click="show = false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg p-6 shadow-lg text-center">
            <p class="text-lg text-green-600 font-semibold">{{ session('message') }}</p>
            <button @click="show = false" class="mt-4 inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                閉じる
            </button>
        </div>
    </div>
    @endif

    <!-- エラーメッセージのポップアップ表示 -->
    @if (session()->has('error') && !session('validation_errors'))
    <div x-data="{ show: true }" x-show="show" @click="show = false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg p-6 shadow-lg text-center">
            <p class="text-lg text-red-600 font-semibold">{{ session('error') }}</p>
            <button @click="show = false" class="mt-4 inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                閉じる
            </button>
        </div>
    </div>
    @endif
</div>
