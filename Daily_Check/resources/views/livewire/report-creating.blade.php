<div>
    {{-- 日報作成画面 --}}
    <section class="text-white body-font relative">
        <div class="container px-5 py-2 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <!-- <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">入力フォーム</h1> -->
            </div>
            <!-- 日付を選択 -->
            <x-date-picker />
            <!-- 時間を選択 -->
            <x-time-picker/>
            <!-- 現場を選択dropDown -->
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                        <div class="mx-auto w-full max-w-xs">
                            <label class="text-sm text-gray-800">現場を選択</label>
                            <div class="mt-1">
                                <select class="mt-1 block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option value="1">現場1</option>
                                    <option value="2">現場2</option>
                                    <option value="3">現場3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- 現場責任者 -->
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="email" class="leading-7 text-sm text-gray-600">現場責任者</label>
                            <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <!-- 現場に入った人チェックボックス -->
                        <div class="w-max">
                            <label class="block text-gray-700 my-1 flex items-center">
                                <input type="checkbox" name="radio-example" class="mr-2 w-4 h-4 focus:ring-2" checked="">
                                <span>名　前 1</span>
                            </label>
                            <label class="block text-gray-700 my-1 flex items-center">
                                <input type="checkbox" name="radio-example" class="mr-2 w-4 h-4 focus:ring-2">
                                <span>名　前 2</span>
                            </label>
                            <label class="block text-gray-700 my-1 flex items-center">
                                <input type="checkbox" name="radio-example" class="mr-2 w-4 h-4 focus:ring-2">
                                <span>名　前 3</span>
                            </label>
                        </div>

                        <!-- コメント入力欄 -->
                        <div class="relative">
                            <label for="message" class="leading-7 text-sm text-gray-600">コメント</label>
                            <textarea id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
