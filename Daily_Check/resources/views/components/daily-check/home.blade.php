
@extends('layouts.app-daily-check')

@section('title', 'home Page')

@section('content')
<body>

  <div class="w-full relative bg-steelblue overflow-hidden flex flex-col items-start justify-start pt-[0.562rem] pb-[1.437rem] pr-[0.062rem] pl-[0rem] box-border gap-[8.125rem] leading-[normal] tracking-[normal]">
    <section class="self-stretch flex flex-col items-end justify-start gap-[1.437rem] max-w-full text-center text-[1rem] text-black font-alice">
      <div class="self-stretch flex flex-row items-start justify-end py-[0rem] pr-[0.687rem] pl-[1rem] box-border max-w-full">
        <div class="flex-1 flex flex-row items-end justify-between max-w-full gap-[1.25rem]">
          <div class="w-[3.063rem] flex flex-col items-start justify-end pt-[0rem] px-[0rem] pb-[0.062rem] box-border">
            <img class="self-stretch h-[1.063rem] relative rounded-xl max-w-full overflow-hidden shrink-0 object-cover" loading="lazy" alt="" src="/public/image-121@2x.png" />
          </div>
          <img class="h-[0.875rem] w-[4.5rem] relative rounded-xl object-cover" loading="lazy" alt="" src="/public/image-12-11@2x.png" />
        </div>
      </div>


      <div class="self-stretch flex flex-col items-end justify-start gap-[0.812rem] max-w-full">
        <div class="self-stretch flex flex-row items-start justify-end pt-[0rem] pb-[0.268rem] pr-[0.987rem] pl-[1.187rem] box-border max-w-full">
        <header class="flex-1 flex flex-row items-start justify-between max-w-full gap-[1.25rem] text-center text-[1rem] text-white font-alfa-slab-one">
            <div class="h-[1.225rem] w-[0.694rem] relative">
              <img class="absolute top-[0rem] left-[0rem] w-[0.688rem] h-[0.625rem] object-contain" alt="" src="/public/line-25.svg" />

              <img class="absolute top-[0.581rem] left-[0.031rem] w-[0.663rem] h-[0.65rem] object-contain z-[1]" loading="lazy" alt="" />
            </div>
            <div class="w-[7.313rem] relative flex items-center justify-center shrink-0 min-w-[7.313rem] whitespace-nowrap">
              Daily -Check
            </div>
            <div class="flex flex-col items-start justify-start pt-[0.312rem] px-[0rem] pb-[0rem]">
              <img class="w-[0.7rem] h-[1.231rem] relative object-contain" loading="lazy" alt="" src="/public/group-31@2x.png" />
            </div>
          </header>
        </div>


        <div class="self-stretch h-[5.688rem] bg-powderblue flex flex-row items-end justify-start pt-[0.5rem] px-[0.687rem] pb-[0.25rem] box-border gap-[1.187rem] max-w-full text-steelblue">
          <div class="h-[5.688rem] w-[23.313rem] relative bg-powderblue hidden max-w-full"></div>
          <div class="self-stretch w-[3.5rem] flex flex-col items-start justify-start">
            <div class="self-stretch flex-1 relative rounded-[50%] bg-lavender z-[1]"></div>
            <div class="self-stretch flex flex-row items-start justify-start py-[0rem] px-[0.187rem]">
              <div class="flex-1 relative inline-block min-w-[3.125rem] z-[1]">
                ホーム
              </div>
            </div>
          </div>
          <div class="self-stretch flex-1 flex flex-row items-start justify-start py-[0rem] pr-[0.437rem] pl-[0rem] gap-[0.875rem] text-[0.625rem] text-white">
            <div class="flex-1 flex flex-col items-start justify-start gap-[0.25rem]">
              <div class="self-stretch h-[3.5rem] relative">
                <div class="absolute top-[0rem] left-[0rem] rounded-[50%] bg-lavender w-full h-full z-[1]"></div>
                <div class="absolute top-[2.375rem] left-[2.375rem] w-[1.125rem] h-[1.125rem]">
                  <div class="absolute top-[0rem] left-[0rem] rounded-[50%] bg-steelblue box-border w-full h-full z-[2] border-[0px] border-solid border-white"></div>
                  <div class="absolute top-[0.25rem] left-[0.25rem] leading-[0.719rem] flex items-center justify-center w-[0.688rem] h-[0.625rem] min-w-[0.688rem] z-[3]">
                    ✔️
                  </div>
                </div>
              </div>
              <div class="w-[3.25rem] relative text-[1rem] text-steelblue flex items-center justify-center z-[1]">
                写真
              </div>
            </div>
            <div class="self-stretch flex-1 flex flex-col items-end justify-start gap-[0.25rem] text-[1rem] text-steelblue">
              <div class="self-stretch flex-1 relative rounded-[50%] bg-lavender z-[1]"></div>
              <div class="w-[3.25rem] relative flex items-center justify-center z-[1]">
                書類
              </div>
            </div>
          </div>
          <div class="w-[7.375rem] flex flex-col items-start justify-end pt-[0rem] px-[0rem] pb-[0.375rem] box-border">
            <div class="self-stretch flex flex-row items-start justify-between gap-[1.25rem]">
              <div class="w-[2.188rem] flex flex-row items-start justify-start relative">
                <div class="h-[3.5rem] w-[3.5rem] absolute !m-[0] top-[-3.375rem] right-[-0.812rem] rounded-[50%] bg-lavender z-[1]"></div>
                <div class="h-[1.188rem] flex-1 relative flex items-center justify-center z-[2]">
                  日報作成
                </div>
              </div>
              <div class="w-[2.875rem] flex flex-row items-start justify-start relative">
                <div class="h-[3.5rem] w-[3.5rem] absolute !m-[0] top-[-3.437rem] left-[calc(50%_-_28px)] rounded-[50%] bg-lavender z-[1]"></div>
                <div class="h-[1.188rem] flex-1 relative flex items-center justify-center z-[2]">
                  日報閲覧
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="self-stretch h-[10.438rem] flex flex-row items-start justify-end py-[0rem] pr-[0.687rem] pl-[1rem] box-border max-w-full text-left">
          <div class="self-stretch flex-1 bg-gray flex flex-row items-start justify-start pt-[0.018rem] pb-[0rem] px-[0rem] box-border max-w-full">
            <div class="self-stretch w-[21.625rem] relative bg-gray hidden max-w-full z-[1]"></div>
            <div class="ml-[-0.063rem] h-[10.438rem] w-[21.563rem] relative max-w-full">
              <div class="absolute top-[0.313rem] left-[0.063rem] w-[18.5rem] flex flex-row items-start justify-start gap-[0.625rem]">
                <div class="w-[6.938rem] flex flex-col items-start justify-start pt-[0.125rem] px-[0rem] pb-[0rem] box-border">
                  <div class="self-stretch relative whitespace-nowrap z-[1]">
                    　5月1日（月）　
                  </div>
                </div>
                <div class="flex-1 relative z-[2]">　〇〇〇〇〇〇邸　</div>
              </div>
              <div class="absolute top-[4.688rem] left-[0rem] w-[18.563rem] flex flex-row items-start justify-start gap-[0.625rem]">
                <div class="w-[7rem] relative flex items-center shrink-0 whitespace-nowrap z-[1]">
                  　5月4日（木）　
                </div>
                <div class="flex-1 flex flex-col items-start justify-start pt-[0.125rem] px-[0rem] pb-[0rem]">
                  <div class="self-stretch relative z-[2]">
                    　〇〇〇〇〇〇邸　
                  </div>
                </div>
              </div>
              <div class="absolute top-[9.063rem] left-[0.063rem] w-[18.5rem] flex flex-row items-start justify-start gap-[0.625rem]">
                <div class="w-[6.938rem] relative flex items-center shrink-0 whitespace-nowrap z-[1]">
                  　5月7日（日）　
                </div>
                <div class="flex-1 relative z-[2]">　〇〇〇〇〇〇邸　</div>
              </div>
              <div class="absolute top-[1.688rem] left-[0.063rem] box-border w-[21.563rem] h-[0.063rem] z-[1] border-t-[1px] border-solid border-black"></div>
              <div class="absolute top-[3.25rem] left-[0rem] w-full h-[1.375rem]">
                <div class="absolute top-[0rem] left-[0rem] flex items-center w-[7rem] h-[1.125rem] whitespace-nowrap z-[1]">
                  　5月3日（水）　
                </div>
                <div class="absolute top-[0.188rem] left-[7.625rem] flex items-center w-[10.938rem] h-[1.125rem] z-[2]">
                  　〇〇〇〇〇〇邸　
                </div>
                <div class="absolute top-[1.313rem] left-[0.063rem] box-border w-[21.563rem] h-[0.063rem] z-[3] border-t-[1px] border-solid border-black"></div>
              </div>
              <div class="absolute top-[7.438rem] left-[0.063rem] w-full h-[1.438rem]">
                <div class="absolute top-[0rem] left-[0rem] flex items-center w-[6.938rem] h-[1.125rem] whitespace-nowrap z-[1]">
                  　5月6日（土）　
                </div>
                <div class="absolute top-[0.25rem] left-[7.563rem] flex items-center w-[10.938rem] h-[1.125rem] z-[2]">
                  　〇〇〇〇〇〇邸　
                </div>
                <div class="absolute top-[1.375rem] left-[0rem] box-border w-[21.563rem] h-[0.063rem] z-[3] border-t-[1px] border-solid border-black"></div>
              </div>
              <div class="absolute top-[1.875rem] left-[0.063rem] w-full h-[1.313rem]">
                <div class="absolute top-[0rem] left-[0rem] flex items-center w-[6.938rem] h-[1.125rem] whitespace-nowrap z-[1]">
                  　5月2日（火）　
                </div>
                <div class="absolute top-[0.063rem] left-[7.563rem] flex items-center w-[10.938rem] h-[1.125rem] z-[2]">
                  　〇〇〇〇〇〇邸　
                </div>
                <div class="absolute top-[1.25rem] left-[0rem] box-border w-[21.563rem] h-[0.063rem] z-[1] border-t-[1px] border-solid border-black"></div>
              </div>
              <div class="absolute top-[6.125rem] left-[0rem] w-full h-[1.313rem]">
                <div class="absolute top-[0rem] left-[0rem] flex items-center w-[7rem] h-[1.125rem] whitespace-nowrap z-[1]">
                  　5月5日（金）　
                </div>
                <div class="absolute top-[0.063rem] left-[7.625rem] flex items-center w-[10.938rem] h-[1.125rem] z-[2]">
                  　〇〇〇〇〇〇邸　
                </div>
                <div class="absolute top-[1.25rem] left-[0.063rem] box-border w-[21.563rem] h-[0.063rem] z-[2] border-t-[1px] border-solid border-black"></div>
              </div>
              <div class="absolute top-[6.125rem] left-[0.063rem] box-border w-[21.563rem] h-[0.063rem] z-[3] border-t-[1px] border-solid border-black"></div>
              <div class="absolute top-[10.375rem] left-[0.063rem] box-border w-[21.563rem] h-[0.063rem] z-[1] border-t-[1px] border-solid border-black"></div>
              <div class="absolute top-[0rem] left-[0.063rem] box-border w-[21.563rem] h-[0.063rem] z-[1] border-t-[1px] border-solid border-black"></div>
            </div>
            <div class="self-stretch w-[28.438rem] flex flex-col items-start justify-start max-w-[132%] shrink-0 ml-[-21.5rem]">
              <img class="w-[0.063rem] flex-1 relative max-h-full object-contain z-[4]" loading="lazy" alt="" />
            </div>
            <div class="self-stretch flex-1 flex flex-col items-start justify-start pt-[0.075rem] px-[0rem] pb-[0rem] box-border max-w-[168%] shrink-0 ml-[-21.5rem]">
              <img class="w-[0.063rem] flex-1 relative max-h-full object-contain z-[4]" loading="lazy" alt="" />
            </div>
            <img class="mt-[-0.082rem] self-stretch w-[0.063rem] relative max-h-full object-contain min-h-[10.375rem] z-[1] ml-[-21.5rem]" loading="lazy" alt="" />
          </div>
        </div>
        <div class="self-stretch flex flex-row items-start justify-end py-[0rem] pr-[0.812rem] pl-[1.062rem] box-border max-w-full">
          <div class="flex-1 rounded-xl bg-gray flex flex-col items-start justify-start pt-[1rem] pb-[0.687rem] pr-[0.312rem] pl-[1.562rem] box-border gap-[0.375rem] max-w-full">
            <div class="w-[21.438rem] h-[11.688rem] relative rounded-xl bg-gray hidden max-w-full"></div>
            <div class="w-[17.625rem] flex flex-row items-start justify-start py-[0rem] px-[1.062rem] box-border">
              <div class="h-[2.125rem] flex-1 relative flex items-center z-[1]">
                <span class="[line-break:anywhere]">
                  <p class="m-0">　5月5日木曜日　</p>
                  <p class="m-0">〇〇さんは，〇〇邸で作業です。</p>
                </span>
              </div>
            </div>
            <div class="self-stretch flex flex-col items-start justify-start text-left">
              <div class="self-stretch h-[3.375rem] relative flex items-center shrink-0 z-[2]">
                <span class="[line-break:anywhere]">
                  <p class="m-0">連絡事項：　　ペンキが切れています！</p>
                  <p class="m-0">　　　　　　　雨天決行です。</p>
                </span>
              </div>
              <div class="w-[19.063rem] relative inline-block z-[1] mt-[-0.375rem]">
                <p class="m-0">メンバー：　佐藤 美智子　斎藤 聡太郎</p>
                <p class="m-0">鈴木 絵理香　田中浩二　伊藤 恵一郎</p>
                <p class="m-0">森 彩乃　加藤 良平　小山 麻衣子</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="self-stretch flex flex-col items-end justify-start gap-[0.812rem] max-w-full text-center text-[1rem] text-steelblue font-alice">
      <div class="w-[22.438rem] flex flex-row items-start justify-center py-[0rem] px-[1.25rem] box-border max-w-full">
        <div class="w-[5.688rem] rounded-mini bg-powderblue box-border flex flex-row items-start justify-start border-[1px] border-solid border-steelblue">
          <div class="h-[1.563rem] w-[5.5rem] relative rounded-mini bg-powderblue box-border hidden border-[1px] border-solid border-steelblue"></div>
          <div class="flex-1 relative z-[1]">管理画面</div>
        </div>
      </div>
      <footer class="self-stretch bg-powderblue flex flex-row flex-wrap items-start justify-center pt-[0.375rem] pb-[0.437rem] pr-[1.25rem] pl-[1.312rem] box-border gap-[0.618rem] max-w-full">
        <div class="h-[3.5rem] w-[23.375rem] relative bg-powderblue hidden max-w-full"></div>
        <div class="flex-1 flex flex-col items-start justify-start py-[0rem] pr-[1.187rem] pl-[0rem] box-border min-w-[4.75rem]">
          <button class="cursor-pointer [border:none] pt-[0.375rem] px-[0.625rem] pb-[0.343rem] bg-whitesmoke self-stretch rounded-mini flex flex-row items-start justify-start z-[1]">
            <div class="h-[2.688rem] w-[6.131rem] relative rounded-mini bg-whitesmoke hidden"></div>
            <div class="h-[1.969rem] flex-1 relative text-[1rem] font-alice text-cornflowerblue text-center flex items-center justify-center z-[1]">
              〇〇邸
            </div>
          </button>
        </div>
        <button class="cursor-pointer [border:none] pt-[0.375rem] pb-[0.343rem] pr-[0.625rem] pl-[0.687rem] bg-powderblue w-[6.131rem] rounded-mini flex flex-row items-start justify-start box-border z-[1]">
          <div class="h-[2.688rem] w-[6.131rem] relative rounded-mini bg-powderblue hidden"></div>
          <div class="h-[1.969rem] flex-1 relative text-[1rem] font-alice text-steelblue text-center flex items-center justify-center shrink-0 z-[1]">
            〇〇邸
          </div>
        </button>
        <button class="cursor-pointer [border:none] pt-[0.375rem] px-[0.625rem] pb-[0.343rem] bg-powderblue w-[6.131rem] rounded-mini flex flex-row items-start justify-start box-border z-[1]">
          <div class="h-[2.688rem] w-[6.131rem] relative rounded-mini bg-powderblue hidden"></div>
          <div class="h-[1.969rem] flex-1 relative text-[1rem] font-alice text-steelblue text-center flex items-center justify-center z-[1]">
            〇〇邸
          </div>
        </button>
      </footer>
    </section>
  </div>
</body>
@endsection
