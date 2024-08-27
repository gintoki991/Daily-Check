<div class="max-w-lg mx-auto bg-white rounded-lg p-10 sm:px-8 sm:py-8 w-full">
    <div class="caption-top text-center text-lg font-semibold mb-4">
        従業員を新規登録する
    </div>

    <form wire:submit.prevent="employeeStore" class="grid grid-cols-6 gap-4">
        <!-- 所属 -->
        <div class="col-span-6">
            <label for="belong_to" class="block text-left text-gray-700 text-sm font-bold mb-2">所属</label>
            <input id="belong_to" type="text" wire:model="belong_to" placeholder="所属を入力してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('belong_to') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- 名前 -->
        <div class="col-span-6">
            <label for="name" class="block text-left text-gray-700 text-sm font-bold mb-2">名前</label>
            <input id="name" type="text" wire:model="name" placeholder="名前を入力してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- メールアドレス -->
        <div class="col-span-6">
            <label for="email" class="block text-left text-gray-700 text-sm font-bold mb-2">メールアドレス</label>
            <input id="email" type="email" wire:model="email" placeholder="メールアドレスを入力してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- パスワード -->
        <div class="col-span-6">
            <label for="password" class="block text-left text-gray-700 text-sm font-bold mb-2">パスワード</label>
            <input id="password" type="password" wire:model="password" placeholder="パスワードを入力してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- 登録ボタン -->
        <div class="col-span-6">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                登録
            </button>
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
</div>
