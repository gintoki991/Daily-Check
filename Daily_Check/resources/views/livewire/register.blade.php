<div>
    <form wire:submit.prevent="register">
        <label for="belong_to">所属</label>
        <input id="belong_to" type="text" wire:model="belong_to"><br>

        <label for="name">名前</label>
        <input id="name" type="text" wire:model="name"><br>

        <label for="email">メールアドレス</label>
        <input id="email" type="email" wire:model="email"><br>

        <label for="password">パスワード</label>
        <input id="password" type=password" wire:model="password"><br>

        <button type="submit">アップロード</button>
    </form>
</div>
