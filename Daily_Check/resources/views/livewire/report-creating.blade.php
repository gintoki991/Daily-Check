<div>
    {{-- 日報作成画面 --}}
    <section class="text-white body-font relative">
        <div class="container px-0 py-2 mx-auto">
            <div class="caption-top text-center text-lg font-semibold mb-4">
                日報を作成
            </div>

            <form wire:submit.prevent="store" class="grid grid-cols-1 gap-4 text-left">
                <!-- 日付を選択 -->
                <div>
                    <label for="report_create_date" class="block text-sm font-medium text-gray-700">日付を選択</label>
                    <input type="date" id="report_create_date" wire:model="date" class="mt-1 w-5/6 rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                    @error('date') <!-- バリデーションエラーメッセージの表示 -->
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 開始時間を選択 -->
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700">開始時間</label>
                    <input type="time" id="start_time" wire:model="start_time" class="mt-1 w-5/6 rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                    @error('start_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 終了時間を選択 -->
                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700">終了時間</label>
                    <input type="time" id="end_time" wire:model="end_time" class="mt-1 w-5/6 rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                    @error('end_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 現場を選択 -->
                <div>
                    <label for="selectedSite" class="block text-sm font-medium text-gray-700">現場を選択</label>
                    <select id="selectedSite" wire:model="selectedSite" class="mt-1 block w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                        <option value="">選択してください</option>
                        @foreach($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedSite')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 現場責任者 -->
                <div>
                    <label for="person_in_charge" class="block text-sm font-medium text-gray-700">現場責任者</label>
                    <select id="person_in_charge" wire:model="person_in_charge" class="mt-1 block w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                        <option value="">選択してください</option>
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    @error('person_in_charge')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 実際に現場に入った人チェックボックス -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">現場に入った人をチェック</label>
                    <div class="mt-2 space-y-2">
                        @foreach($employees as $employee)
                        <label class="flex items-center text-gray-700 cursor-pointer">
                            <input type="checkbox" wire:model="selectedEmployees" value="{{ $employee->id }}" class="mr-2 w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 cursor-pointer">
                            <span>{{ $employee->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('selectedEmployees')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- コメント入力欄 -->
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700">コメント</label>
                    <textarea id="comment" wire:model="comment" class="mt-2 w-5/6 rounded-lg border-gray-200 bg-white shadow-sm sm:text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none cursor-pointer" rows="4" placeholder="連絡事項を入力してください"></textarea>
                    @error('comment')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 送信ボタン -->
                <div class="flex justify-center">
                    <button type="submit" class="w-2/3 py-2 px-8 inline-flex justify-center items-center gap-x-2 font-semibold text-lg font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                        提　出
                    </button>
                </div>
            </form>

            <!-- 重複エラーメッセージ -->
            @if (session()->has('error'))
            <div class="mt-4 text-center text-white font-semibold">
                {{ session('error') }}
            </div>
            @endif
        </div>
    </section>

    <!-- ポップアップメッセージ -->
    @if (session()->has('success'))
    <div x-data="{ show: true }" x-show="show" @click="show = false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <p class="text-lg text-green-600 font-semibold">{{ session('success') }}</p>
            <div class="mt-4 flex justify-center">
                <button @click="show = false" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    閉じる
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
