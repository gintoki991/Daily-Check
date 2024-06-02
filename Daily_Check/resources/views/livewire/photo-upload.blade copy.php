<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label for="siteSelect" class="block text-gray-700 text-sm font-bold mb-2">現場を選択:</label>
            <select id="siteSelect" wire:model="site_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">選択してください</option>
                @foreach($sites as $site)
                <option value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="partSelect" class="block text-gray-700 text-sm font-bold mb-2">部位を選択:</label>
            <select id="partSelect" wire:model="part" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">選択してください</option>
                <option value="屋根">屋根</option>
                <option value="外壁">外壁</option>
                <option value="軒天">軒天</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">写真:</label>
            <input type="file" id="photo" wire:model="photo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        @error('photo') <span class="error">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            アップロード
        </button>
    </form>
</div>
