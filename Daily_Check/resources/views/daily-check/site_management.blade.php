<x-admin-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-yellow-500 text-center leading-tight">
      {{ __('現場管理') }}
    </h2>
  </x-slot>

  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-steelblue selection:bg-red-500 selection:text-white">
    <section class="max-w-7xl mx-auto p-4 p-6 lg:p-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

        <!-- 現場一覧表表示（No.，現場名，詳細表示ボタン，ダウンロードボタン，削除ボタン），現場の追加登録（現場名，追加ボタン） -->
        <div class="scale-100 p-2 bg-white rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
          <livewire:site-list />
        </div>
        <div class="scale-100 p-6 bg-white rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
          <x-site_addition />
        </div>

      </div>
    </section>
  </div>

</x-admin-layout>
