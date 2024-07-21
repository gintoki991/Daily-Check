<x-admin-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white text-center leading-tight">
      {{ __('管理者画面') }}
    </h2>
  </x-slot>

  <div class="w-full relative bg-steelblue overflow-hidden flex flex-col items-start justify-start pt-[0.562rem] pb-[1.437rem] pr-[0.062rem] pl-[0rem] box-border gap-[8.125rem] leading-[normal] tracking-[normal]">
    <section class="self-stretch flex items-center flex items-center justify-center min-h-screen text-center text-[1rem] text-black font-alice">
      <div class="self-stretch flex flex-col items-center justify-start gap-[0.812rem] max-w-full">

        <!-- ホームボタン，従業員を管理するボタン，現場を管理するボタン -->
        <div>
          <a href="{{ route('home') }}" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">ホーム画面</a><br>
          <a href="{{ route('employee.management') }}" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">従業員を管理する</a><br>
          <a href="{{ route('site.management') }}" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">現場を管理する</a><br>
        </div>

      </div>
    </section>
  </div>

</x-admin-layout>
