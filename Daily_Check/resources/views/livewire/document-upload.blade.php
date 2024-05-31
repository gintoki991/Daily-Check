<div>
  <form wire:submit.prevent="save">
    @csrf
    <label for="name">書類名</label>
    <input id="name" type="text" wire:model="name"><br>
    <label for="site_id">現場</label>
    <input id="site_id" type="text" wire:model="site_id"><br>
    <button type="submit">アップロード</button>
  </form>
</div>
