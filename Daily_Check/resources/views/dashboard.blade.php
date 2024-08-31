<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-customGreen leading-tight">
            {{ __('ダッシュボード') }}
        </h2>
    </x-slot>
    <!-- Page Footing -->
    <x-footer />

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="px-6 text-gray-900">
                    {{ __("ログイン中!") }}
                </div>
                <!-- Navigation Links -->
                <div class="flex flex-col items-center space-y-4 sm:-my-px sm:ms-10">
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
    </div>
</x-app-layout>
