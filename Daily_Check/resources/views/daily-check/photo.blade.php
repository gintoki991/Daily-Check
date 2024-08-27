<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white text-center leading-tight">
      {{ __('写真閲覧画面') }}
    </h2>
  </x-slot>

  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-steelblue bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <section class="max-w-7xl mx-auto p-4 lg:p-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

        <!-- 一週間の予定（現場），当日の詳細情報 -->
        <div>
          @livewire('photo-upload')
        </div>
        <div class="scale-100 p-6 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex flex-col justify-between motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
          @livewire('photo-list')
        </div>

      </div>
    </section>
  </div>

</x-app-layout>
