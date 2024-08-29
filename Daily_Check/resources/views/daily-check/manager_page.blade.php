<x-admin-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-yellow-500 text-left leading-tight">
      {{ __('管理者画面') }}
    </h2>
  </x-slot>

  <div class="w-full relative bg-steelblue overflow-hidden flex flex-col items-start justify-start pt-[0.562rem] pb-[1.437rem] pr-[0.062rem] pl-[0rem] box-border gap-[8.125rem] leading-[normal] tracking-[normal]">
    <section class="self-stretch flex items-center flex items-center justify-center min-h-screen text-center text-[1rem] text-black font-alice">
      <div class="self-stretch flex flex-col items-center justify-start gap-[0.812rem] max-w-full">

        <!-- ナビゲーションボタン -->
        <div class="flex flex-col items-center space-y-4 sm:-my-px sm:ms-10 sm:flex-row sm:space-y-0 sm:space-x-8">
          <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate class="no-underline">
            <button type="button" class="w-full max-w-xs py-3 px-4 inline-flex justify-center items-center text-sm font-medium rounded-lg border border-transparent bg-customGreen text-gray-900 hover:bg-teal-600 hover:text-white focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
              {{ __('ホーム') }}
            </button>
          </x-nav-link>
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

</x-admin-layout>
