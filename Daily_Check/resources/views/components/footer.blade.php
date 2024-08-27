<footer class="bg-customGreen text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
      <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
      </svg> -->
      <span class="ml-3 text-steelblue text-xl">Daily-Check</span>
      <a href="{{ route('manager.page') }}" class="items-right py-3 px-4 gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:outline-none focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-blue-500 dark:text-blue-500 dark:hover:text-blue-400 dark:hover:border-blue-400">管理画面</a>
    </a>
    <!-- <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
      <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
        {{ __('〇〇〇〇邸') }}
      </x-nav-link>
    </nav> -->
    <!-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
      <path d="M5 12h14M12 5l7 7-7 7"></path>
    </svg> -->
    </button>
  </div>
</footer>
