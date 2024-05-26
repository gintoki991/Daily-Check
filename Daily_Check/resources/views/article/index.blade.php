<html>

<head>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  @livewireStyles
</head>

<body>

  <div class="p-5">
    <h1 class="text-3xl mb-4">
      livewire のCRUDサンプル
    </h1>
    <div class="grid grid-cols-2 gap-7">
      <div>
        <livewire:article-list />
      </div>
      <div>
        <button type="button" class="bg-gray-300 text-gray-700 rounded p-2 mb-5" onClick="Livewire.emitTo('article-input', 'create')">+ 追加する</button>
        <livewire:article-input />
      </div>
    </div>
  </div>

  @livewireScripts
</body>

</html>
