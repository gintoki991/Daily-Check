<!-- resources/views/components/daily-check/navbar.blade.php -->

<nav class="self-stretch h-[5.688rem] bg-powderblue flex flex-row items-end justify-start pt-[0.5rem] px-[0.687rem] pb-[0.25rem] box-border gap-[1.187rem] max-w-full text-steelblue">
  <div class="h-[5.688rem] w-[23.313rem] relative bg-powderblue hidden max-w-full"></div>
  <div class="self-stretch w-[3.5rem] flex flex-col items-start justify-start">
    <div class="self-stretch flex-1 relative rounded-[50%] bg-lavender z-[1]"></div>
    <div class="self-stretch flex flex-row items-start justify-start py-[0rem] px-[0.187rem]">
      <div class="flex-1 relative inline-block min-w-[3.125rem] z-[1]">ホーム</div>
    </div>
  </div>
  <div class="self-stretch flex-1 flex flex-row items-start justify-start py-[0rem] pr-[0.437rem] pl-[0rem] gap-[0.875rem] text-[0.625rem] text-white">
    <div class="flex-1 flex flex-col items-start justify-start gap-[0.25rem]">
      <div class="self-stretch h-[3.5rem] relative">
        <div class="absolute top-[0rem] left-[0rem] rounded-[50%] bg-lavender w-full h-full z-[1]"></div>
        <div class="absolute top-[2.375rem] left-[2.375rem] w-[1.125rem] h-[1.125rem]">
          <div class="absolute top-[0rem] left-[0rem] rounded-[50%] bg-steelblue box-border w-full h-full z-[2] border-[0px] border-solid border-white"></div>
          <div class="absolute top-[0.25rem] left-[0.25rem] leading-[0.719rem] flex items-center justify-center w-[0.688rem] h-[0.625rem] min-w-[0.688rem] z-[3]">✔️</div>
        </div>
      </div>
      <div class="w-[3.25rem] relative text-[1rem] text-steelblue flex items-center justify-center z-[1]">写真</div>
    </div>
    <div class="self-stretch flex-1 flex flex-col items-end justify-start gap-[0.25rem] text-[1rem] text-steelblue">
      <div class="self-stretch flex-1 relative rounded-[50%] bg-lavender z-[1]"></div>
      <div class="w-[3.25rem] relative flex items-center justify-center z-[1]">書類</div>
    </div>
  </div>
  <div class="w-[7.375rem] flex flex-col items-start justify-end pt-[0rem] px-[0rem] pb-[0.375rem] box-border">
    <div class="self-stretch flex flex-row items-start justify-between gap-[1.25rem]">
      <div class="w-[2.188rem] flex flex-row items-start justify-start relative">
        <div class="h-[3.5rem] w-[3.5rem] absolute !m-[0] top-[-3.375rem] right-[-0.812rem] rounded-[50%] bg-lavender z-[1]"></div>
        <div class="h-[1.188rem] flex-1 relative flex items-center justify-center z-[2]">日報作成</div>
      </div>
      <div class="w-[2.875rem] flex flex-row items-start justify-start relative">
        <div class="h-[3.5rem] w-[3.5rem] absolute !m-[0] top-[-3.437rem] left-[calc(50%_-_28px)] rounded-[50%] bg-lavender z-[1]"></div>
        <div class="h-[1.188rem] flex-1 relative flex items-center justify-center z-[2]">日報閲覧</div>
      </div>
    </div>
  </div>
</nav>
