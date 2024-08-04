<div class="max-w-md mx-auto p-4">
  <form wire:submit.prevent="save" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 space-y-4">
    <!-- 書類名 -->
    <div>
      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">書類名</label>
      <input type="text" id="name" wire:model="name" placeholder="書類名を入力してください" class="w-full rounded-lg border-gray-200 p-3 text-sm focus:outline-none focus:ring focus:border-blue-500 hover:border-blue-500 hover:bg-gray-100">
      @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- 現場名 -->
    <div>
      <label for="site" class="block text-gray-700 text-sm font-bold mb-2">現場名</label>
      <select id="site" wire:model="site_id" class="w-full rounded-lg border-gray-200 p-3 text-sm focus:outline-none focus:ring focus:border-blue-500 hover:border-blue-500 hover:bg-gray-100">
        <option value="">現場を選択してください</option>
        @foreach($sites as $site)
        <option value="{{ $site->id }}">{{ $site->name }}</option>
        @endforeach
      </select>
      @error('site_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- PDFファイル選択 -->
    <div class="mb-4 md:mb-6">
      <div class="text-center">
        <input type="file" id="pdf" wire:model="pdf" class="hidden">
        <button type="button" onclick="document.getElementById('pdf').click()" class="cursor-pointer block w-full rounded-lg border border-gray-200 p-3 text-sm text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500 hover:border-blue-500 hover:bg-gray-100">
          PDFファイルを選択
        </button>
        @if ($pdf)
        <div class="mt-2 text-gray-500 text-sm">{{ $pdf->getClientOriginalName() }}</div>
        @else
        <div class="mt-2 text-gray-500 text-sm">選択されていません</div>
        @endif
        @error('pdf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>
    </div>

    <!-- 保存ボタン -->
    <div class="text-center">
      <button type="submit" class="inline-block w-full rounded-lg bg-blue-500 hover:bg-blue-700 px-5 py-3 text-sm text-white">
        保存
      </button>
    </div>
  </form>

  @if (session()->has('message'))
  <div class="mt-4 bg-green-500 text-white text-center py-2 px-4 rounded">
    {{ session('message') }}
  </div>
  @endif
</div>
