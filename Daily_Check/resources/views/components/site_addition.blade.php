<div class="max-w-lg mx-auto bg-white rounded-lg p-6 sm:px-8 sm:py-8 w-full">
  <div class="caption-top text-center text-lg font-semibold mb-4">
    現場を登録
  </div>

  <form action="{{ route('site.store') }}" method="POST">
    @csrf

    <!-- 現場名 -->
    <div class="mb-4">
      <label for="site_name" class="block text-left text-gray-700 text-sm font-bold mb-2">現場名</label>
      <input id="site_name" type="text" name="site_name" value="{{ old('site_name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('site_name') border-red-500 @enderror">
      @error('site_name')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <!-- 追加ボタン -->
    <div class="flex justify-center">
      <button type="submit" class="w-2/3 py-2 px-8 inline-flex justify-center items-center gap-x-2 font-semibold text-lg font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
        追 加
      </button>
    </div>
  </form>
</div>
