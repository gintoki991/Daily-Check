<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white text-center leading-tight">
      {{ __('書類閲覧画面') }}
    </h2>
  </x-slot>

  <div class="w-full relative bg-steelblue overflow-hidden flex flex-col items-start justify-start pt-[0.562rem] pb-[1.437rem] pr-[0.062rem] pl-[0rem] box-border gap-[8.125rem] leading-[normal] tracking-[normal]">
    <section class="self-stretch flex items-center flex items-center justify-center min-h-screen text-center text-[1rem] text-black font-alice">
      <div class="self-stretch flex flex-col items-center justify-start gap-[0.812rem] max-w-full">

        <!-- 一週間の予定（現場），当日の詳細情報 -->
        <div class="py-4">
          @livewire('documentUpload')
          @livewire('document-list')
        </div>

      </div>
    </section>
  </div>

</x-app-layout>
