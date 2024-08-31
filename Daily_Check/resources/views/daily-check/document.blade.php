<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-customGreen text-center leading-tight">
      {{ __('書類') }}
    </h2>
  </x-slot>

  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-steelblue bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
    <section class="max-w-7xl mx-auto p-4 lg:p-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-2 lg:gap-8">

        <!-- 一週間の予定（現場），当日の詳細情報 -->
        <div class="py-2">
          @livewire('documentUpload')
        </div>
        <div class="text-center scale-100 px-2 from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex flex-col justify-between motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
          @livewire('document-list')
        </div>

      </div>
    </section>
  </div>

</x-app-layout>
