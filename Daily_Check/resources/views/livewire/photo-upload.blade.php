<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 sm:px-8 sm:py-8">
    <form wire:submit.prevent="save" class="grid grid-cols-6 gap-4">

        <!-- 現場選択 -->
        <div class="col-span-6">
            <label for="siteSelect" class="block text-gray-700 text-sm font-bold mb-2">現場を選択:</label>
            <select id="siteSelect" wire:model="site_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">選択してください</option>
                @foreach($sites as $site)
                <option value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- 部位選択 -->
        <div class="col-span-6">
            <label for="partSelect" class="block text-gray-700 text-sm font-bold mb-2">部位を選択:</label>
            <select id="partSelect" wire:model="part" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">選択してください</option>
                <option value="屋根">屋根</option>
                <option value="外壁">外壁</option>
                <option value="軒天">軒天</option>
            </select>
        </div>

        <!-- 日付選択 -->
        <div class="col-span-5">
            <label for="photo_date" class="block text-gray-700 text-sm font-bold mb-2">日付を選択:</label>
            <div class="relative">
                <input type="date" id="photo_date" wire:model="photo_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <!-- カスタムカレンダーアイコン -->
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10 12l-6-6h12z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 写真アップロード -->
        <div class="col-span-6">
            <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">写真:</label>
            <input type="file" id="photo" wire:model="photo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- アップロードボタン -->
        <div class="col-span-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                アップロード
            </button>
        </div>

    </form>

    @if (session()->has('message'))
    <!-- ポップアップメッセージ -->
    <div x-data="{ show: true }" x-show="show" @click="show = false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <p class="text-lg text-green-600 font-semibold">{{ session('message') }}</p>
            <button @click="show = false" class="mt-4 inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                閉じる
            </button>
        </div>
    </div>
    @endif
</div>
