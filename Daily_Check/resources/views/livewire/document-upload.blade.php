<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 sm:px-8 sm:py-8">
  <div class="caption-top text-center text-lg font-semibold mb-4">
    書類をアップロードする
  </div>
  <form wire:submit.prevent="save" class="grid grid-cols-6 gap-4">

    <!-- 書類名 -->
    <div class="col-span-6">
      <label for="name" class="block text-left text-gray-700 text-sm font-bold mb-2">書類名</label>
      <input type="text" id="name" wire:model="name" placeholder="書類名を入力してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- 現場名 -->
    <div class="col-span-6">
      <label for="site" class="block text-left text-gray-700 text-sm font-bold mb-2">現場名</label>
      <select id="site" wire:model="site_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="">現場を選択してください</option>
        @foreach($sites as $site)
        <option value="{{ $site->id }}">{{ $site->name }}</option>
        @endforeach
      </select>
      @error('site_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- PDFファイル選択 -->
    <div class="col-span-6">
      <label for="pdf" class="block text-left text-gray-700 text-sm font-bold mb-2">PDFファイルを選択</label>
      <input type="file" id="pdf" wire:model="pdf" class="shadow appearance-none border rounded w-full py-2 px-0 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      @error('pdf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      @if ($pdf)
      <div class="mt-2 text-gray-500 text-sm">{{ $pdf->getClientOriginalName() }}</div>
      @else
      <div class="mt-2 text-gray-500 text-sm">選択されていません</div>
      @endif
    </div>

    <!-- 保存ボタン -->
    <div class="col-span-6">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
        保存
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
