<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Daily-Check</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/flatpickr.js'])
  @livewireStyles
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100 overflow-x-hidden">

    <!-- Page Heading -->
    <header class="bg-customBlue shadow">
      <div class="mx-auto py-1 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <h2 class="font-semibold text-xl text-yellow-500 leading-tight">
            {{ __('管理者ページ') }}
          </h2>

          <!-- Settings Dropdown -->
          <div class="sm:flex sm:items-center ms-6">
            <!-- Dropdown Code -->
            <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                  <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                  <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </button>
              </x-slot>

              <x-slot name="content">
                <x-dropdown-link :href="route('profile')" wire:navigate>
                  {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="w-full text-start">
                    <x-dropdown-link>
                      {{ __('Log Out') }}
                    </x-dropdown-link>
                  </button>
                </form>
              </x-slot>
            </x-dropdown>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <main>
      <div class="p-6 text-gray-900">
        {{ __("管理者のみ使用してください！") }}
      </div>

      <div class="flex justify-center w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden sm:rounded-lg mx-8">
          <!-- Navigation Buttons -->
          <div class="flex flex-col items-center space-y-4 sm:-my-px sm:ms-10 sm:flex-row sm:space-y-0 sm:space-x-8 mb-4 py-2">
            <!-- Button for Home -->
            <x-nav-link :href="route('site.management')" :active="request()->routeIs('dashboard')" wire:navigate class="no-underline">
              <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                {{ __('現場管理') }}
              </button>
            </x-nav-link>
            <x-nav-link :href="route('employee.management')" :active="request()->routeIs('ReportCreating')" wire:navigate class="no-underline">
              <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                {{ __('従業員管理') }}
              </button>
            </x-nav-link>
            <x-nav-link :href="route('workers.arrangement')" :active="request()->routeIs('dashboard')" wire:navigate class="no-underline">
              <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                {{ __('スケジュール') }}
              </button>
            </x-nav-link>
            <x-nav-link :href="route('photoListManagement')" :active="request()->routeIs('photoListManagement')" wire:navigate class="no-underline">
              <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                {{ __('写真管理') }}
              </button>
            </x-nav-link>
            <x-nav-link :href="route('documentListManagement')" :active="request()->routeIs('documentListManagement')" wire:navigate class="no-underline">
              <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                {{ __('書類管理') }}
              </button>
            </x-nav-link>
          </div>
          <div class="flex justify-center w-full mt-6">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="no-underline">
              <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-medium rounded-lg border border-transparent bg-gray-500 text-gray-900 hover:bg-customGreen hover:text-gray-600 focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                {{ __('ダッシュボードに戻る') }}
              </button>
            </x-nav-link>
          </div>
        </div>
      </div>
    </main>

  </div>

  @livewireScripts
</body>

</html>
