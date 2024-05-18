<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white text-center leading-tight">
      {{ __('ログイン画面') }}
    </h2>
  </x-slot>

  <!-- <body> -->
    <div class="w-full relative bg-customBlue overflow-hidden flex flex-col items-start justify-start pt-2 pb-72 pr-2.5 pl-3 box-border gap-52 leading-normal tracking-normal font-alice">
      <header class="w-full flex flex-col items-end justify-start gap-6 max-w-full text-center text-base text-white font-alfa-slab-one">
        <div class="w-full flex flex-row items-end justify-between gap-5">
          <div class="w-13 flex flex-col items-start justify-end pt-0 pb-0.5 px-0 box-border">
            <img class="w-full h-4.5 relative rounded-full overflow-hidden object-cover shrink-0" loading="lazy" alt="" src="/public/image-12@2x.png" />
          </div>
          <img class="h-3.5 w-18.75 relative rounded-full object-cover" loading="lazy" alt="" src="/public/image-12-1@2x.png" />
        </div>
        <div class="w-full flex flex-row items-start justify-end py-0 pr-3.5 pl-4 box-border max-w-full">
          <div class="flex-1 flex flex-row items-start justify-between max-w-full gap-5">
            <img class="h-4.5 w-2.75 relative object-contain" loading="lazy" alt="" src="/public/group-5@2x.png" />
            <div class="flex flex-col items-start justify-start pt-0.5 px-0 pb-0">
              <img class="w-2.75 h-5 relative object-contain" loading="lazy" alt="" src="/public/group-3@2x.png" />
            </div>
          </div>
        </div>
      </header>

      <section class="w-full flex flex-row items-start justify-start py-0 pr-3.5 pl-2.5 box-border max-w-full text-center text-base text-white font-alice">
        <div class="flex-1 flex flex-col items-end justify-start gap-3.5 max-w-full">
          <div class="w-full flex flex-col items-start justify-start gap-5 max-w-full">
            <button class="cursor-pointer py-0.5 px-4.5 bg-gray-200 w-full rounded-2xs box-border flex flex-row items-start justify-start max-w-full border border-solid border-gray-600">
              <div class="h-11 w-81.75 relative rounded-2xs bg-gray-200 box-border hidden max-w-full border border-solid border-gray-600"></div>
              <div class="h-8.5 flex-1 relative text-base font-alice text-black text-center flex items-center justify-center z-10">
                アカウント名を入力してください
              </div>
            </button>
            <button class="cursor-pointer pt-4 px-4.5 pb-2 bg-gray-200 w-full rounded-2xs box-border flex flex-row items-start justify-start max-w-full border border-solid border-gray-600">
              <div class="h-15.5 w-81.75 relative rounded-2xs bg-gray-200 box-border hidden max-w-full border border-solid border-gray-600"></div>
              <div class="h-8.5 flex-1 relative text-base font-alice text-black text-center flex items-center justify-center z-10">
                パスワードを入力してください
              </div>
            </button>
            <div class="w-full flex flex-row items-start justify-start py-0 pr-0 pl-0.5 box-border max-w-full">
              <button class="cursor-pointer py-0.5 px-5 bg-orange-400 flex-1 rounded-full box-border flex flex-row items-start justify-center max-w-full border border-solid border-orange-400">
                <div class="h-11 w-81.75 relative rounded-full bg-orange-400 box-border hidden max-w-full border border-solid border-orange-400"></div>
                <div class="h-8.5 w-32.5 relative text-base font-alice text-white text-center flex items-center justify-center shrink-0 z-10">
                  ログイン
                </div>
              </button>
            </div>
          </div>
          <div class="w-full flex flex-row items-start justify-end py-0 pr-4.5 pl-5">
            <div class="h-8.5 flex-1 relative flex items-center justify-center">
              パスワードを忘れましたか？
            </div>

          </div>
        </div>
      </section>
    </div>
  <!-- </body> -->

</x-app-layout>
