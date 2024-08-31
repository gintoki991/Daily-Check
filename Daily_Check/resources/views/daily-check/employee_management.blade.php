<x-admin-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-yellow-500 text-center leading-tight">
      {{ __('従業員管理') }}
    </h2>
  </x-slot>

  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-steelblue dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <section class="max-w-7xl mx-auto p-4 p-6 lg:p-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
        <!-- 従業員一覧表表示 -->
        <div class="scale-100 p-2 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
          @livewire('employee-list')
        </div>

        <div class="w-full bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
          <!-- 従業員登録 -->
          @livewire('employee-registration')
        </div>
      </div>
    </section>
  </div>

</x-admin-layout>
