<x-admin-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-yellow-500 text-center leading-tight">
      {{ __('書類管理') }}
    </h2>
  </x-slot>

  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-steelblue bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
    <section class="max-w-7xl mx-auto p-4 lg:p-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

        <!-- 一週間の予定（現場），当日の詳細情報 -->
        <div>
          @livewire('documentUpload')
          @livewire('document-list-management')
        </div>

      </div>
    </section>
  </div>

</x-admin-layout>
