<x-admin-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white text-center leading-tight">
      {{ __('人員配置計画画面') }}
    </h2>
  </x-slot>

  <div class="w-full relative bg-steelblue overflow-hidden flex flex-col items-start justify-start pt-[0.562rem] pb-[1.437rem] pr-[0.062rem] pl-[0rem] box-border gap-[8.125rem] leading-[normal] tracking-[normal]">
    <section class="self-stretch flex items-center flex items-center justify-center min-h-screen text-center text-[1rem] text-black font-alice">
      <div class="self-stretch flex flex-col items-center justify-start gap-[0.812rem] max-w-full">

        <!-- カレンダー，人員配置（現場，日付） -->
        <div>
          日付
          <input type="text" id="plan_date" name="plan_date">
          開始時間
          <input type="text" id="start_time" name="start_time">
          終了時間
          <input type="text" id="end_time" name="end_time">
          @livewire('schedule-registration')
        </div>

      </div>
    </section>
  </div>

</x-admin-layout>
