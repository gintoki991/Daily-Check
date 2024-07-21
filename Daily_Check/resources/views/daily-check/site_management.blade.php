<x-admin-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white text-center leading-tight">
      {{ __('現場（一覧）管理画面 site_list_management') }}
    </h2>
  </x-slot>

  <div class="w-full relative bg-steelblue overflow-hidden flex flex-col items-start justify-start pt-[0.562rem] pb-[1.437rem] pr-[0.062rem] pl-[0rem] box-border gap-[8.125rem] leading-[normal] tracking-[normal]">
    <section class="self-stretch flex items-center flex items-center justify-center min-h-screen text-center text-[1rem] text-black font-alice">
      <div class="self-stretch flex flex-col items-center justify-start gap-[0.812rem] max-w-full">

        <!-- 現場一覧表表示（No.，現場名，詳細表示ボタン，ダウンロードボタン，削除ボタン），現場の追加登録（現場名，追加ボタン） -->
        <div>
          <livewire:site-list />
          <x-site_addition />
        </div>

      </div>
    </section>
  </div>

</x-admin-layout>
