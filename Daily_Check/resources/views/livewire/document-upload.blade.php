<div>
  <form wire:submit.prevent="save">
    <div class="mb-4">
      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">書類名:</label>
      <input type="text" id="name" wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="site" class="block text-gray-700 text-sm font-bold mb-2">現場を選択:</label>
      <select id="site" wire:model="site_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="">選択してください</option>
        @foreach($sites as $site)
        <option value="{{ $site->id }}">{{ $site->name }}</option>
        @endforeach
      </select>
      @error('site_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="pdf" class="block text-gray-700 text-sm font-bold mb-2">PDFファイル:</label>
      <input type="file" id="pdf" wire:model="pdf" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      @error('pdf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">保存</button>
  </form>

  @if (session()->has('message'))
  <div class="mt-4 bg-green-500 text-white text-center py-2 px-4 rounded">
    {{ session('message') }}
  </div>
  @endif
</div>
