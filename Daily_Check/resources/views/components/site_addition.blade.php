<div>
  <form action="{{ route('site.store') }}" method="POST">
    @csrf
    <label for="site_name">現場名</label>
    <input id="site_name" type="text" name="site_name"><br>

    <button type="submit">追加</button>
  </form>
</div>
