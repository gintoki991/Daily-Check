<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-customGreen text-center leading-tight">
      {{ __('日報作成') }}
    </h2>
  </x-slot>

  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-steelblue bg-center dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <section class="max-w-7xl mx-auto p-4 lg:p-6 w-5/6">
      <div class="w-full py-2 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex flex-col justify-between transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        @livewire('report-creating')
      </div>
    </section>
  </div>
</x-app-layout>
