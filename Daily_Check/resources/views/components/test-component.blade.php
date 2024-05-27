<div>

  <form action="{{ route('test.store') }}" method="POST">
    @csrf

    <label for="belong_to" class="text-sm text-gray-800">現場を選択</label>
    <div class="mt-1">
      <select id="belong_to" name="belong_to" class="border rounded p-2">
        <option value="">所属を選択してください</option>
        <option value="2">〇〇会社</option>
        <option value="3">所属会社選択肢が表示されます</option>
      </select>
      @error('belong_to')
      <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
      @enderror
    </div>

    <label for="name" class="text-sm text-gray-800 mt-4">名前</label>
    <div class="mt-1">
      <input id="name" type="text" name="name" class="border rounded p-2">
      @error('name')
      <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="mt-4 bg-blue-500 text-white rounded px-4 py-2">アップロード</button>
  </form>

</div>
