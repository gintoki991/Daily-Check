<div class="max-w-lg mx-auto bg-white rounded-lg p-6 sm:px-8 sm:py-8 w-full">
  <div class="caption-top text-center text-lg font-semibold mb-4">
    現場を登録する
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
    <div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        追加
      </button>
    </div>
  </form>
</div>
