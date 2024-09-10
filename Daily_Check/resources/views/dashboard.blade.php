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
                    <h2 class="font-semibold text-xl text-customGreen leading-tight">
                        {{ __('Daily-Check') }}
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
            <div class="bg-customGreen text-gray-600 body-font">
                <div class="container mx-auto flex flex-wrap p-5 flex-row items-center">
                    <div class="basis-2/5 flex items-center">
                        <span class="ml-3 text-steelblue text-xl">ダッシュボード</span>
                    </div>
                    <div class="basis-2/4 flex justify-end px-4">
                        <a href="{{ route('manager.page') }}" class="no-underline py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-yellow-500 hover:bg-yellow-100 focus:outline-none focus:bg-yellow-100 hover:text-yellow-800 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-yellow-800/30 dark:hover:text-yellow-400 dark:focus:bg-yellow-800/30 dark:focus:text-yellow-400">
                            管理画面
                        </a>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <!-- Navigation Buttons -->
                    <div class="flex flex-col items-center space-y-4 sm:-my-px sm:ms-10 sm:flex-row sm:space-y-0 sm:space-x-8 mb-4 py-6">
                        <!-- Button for Home -->
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate class="no-underline">
                            <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-medium rounded-lg border border-transparent bg-customGreen text-gray-900 hover:bg-teal-600 hover:text-white focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                                {{ __('ホーム') }}
                            </button>
                        </x-nav-link>
                        <x-nav-link :href="route('photoList')" :active="request()->routeIs('photo')" wire:navigate class="no-underline">
                            <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-medium rounded-lg border border-transparent bg-customGreen text-gray-900 hover:bg-teal-600 hover:text-white focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                                {{ __('写真') }}
                            </button>
                        </x-nav-link>
                        <x-nav-link :href="route('documentList')" :active="request()->routeIs('document')" wire:navigate class="no-underline">
                            <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-medium rounded-lg border border-transparent bg-customGreen text-gray-900 hover:bg-teal-600 hover:text-white focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                                {{ __('書類') }}
                            </button>
                        </x-nav-link>
                        <x-nav-link :href="route('ReportCreating')" :active="request()->routeIs('ReportCreating')" wire:navigate class="no-underline">
                            <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-medium rounded-lg border border-transparent bg-customGreen text-gray-900 hover:bg-teal-600 hover:text-white focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                                {{ __('日報作成') }}
                            </button>
                        </x-nav-link>
                        <x-nav-link :href="route('ReportDisplay')" :active="request()->routeIs('ReportDisplay')" wire:navigate class="no-underline">
                            <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-medium rounded-lg border border-transparent bg-customGreen text-gray-900 hover:bg-teal-600 hover:text-white focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                                {{ __('日報閲覧') }}
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
