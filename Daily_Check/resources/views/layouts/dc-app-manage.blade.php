<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Daily-Check')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/flatpickr.js'])
  @livewireStyles
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100">
    <!-- Page Heading -->
    @if (isset($header))
    <header class="bg-steelblue shadow">
      <div class="max-w-7xl mx-auto py-1 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
    @endif

    <!-- Page Footing -->
    <!-- <x-footer /> -->

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>

    <!-- ナビゲーションバーのコンポーネントを呼び出す -->
    <livewire:layout.dc-navigation-manage />

  </div>

  @livewireScripts
</body>

</html>
