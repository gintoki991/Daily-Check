<div>

  <form action="{{ route('test.store') }}" method="POST">
    @csrf
    <label for="belong_to">所属</label>
    <input id="belong_to" type="text" name="belong_to"><br>

    <label for="name">名前</label>
    <input id="name" type="text" name="name"><br>

    <button type="submit">アップロード</button>
  </form>
</div>
