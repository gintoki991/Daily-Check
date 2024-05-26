<div x-data="datePicker()" x-init="init()" @change="updateDate" class="flex items-center space-x-4">
  <form class="flex items-center space-x-4">
    <div>
      <label for="year">年:</label>
      <select id="year" x-model="year" class="mt-1 block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
        <template x-for="year in years" :key="year">
          <option :value="year" x-text="year"></option>
        </template>
      </select>
    </div>

    <div>
      <label for="month">月:</label>
      <select id="month" x-model="month" class="mt-1 block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
        <template x-for="month in months" :key="month">
          <option :value="month" x-text="month"></option>
        </template>
      </select>
    </div>

    <div>
      <label for="day">日:</label>
      <select id="day" x-model="day" class="mt-1 block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
        <template x-for="day in days" :key="day">
          <option :value="day" x-text="day"></option>
        </template>
      </select>
    </div>
  </form>
</div>

<script>
  function datePicker() {
    return {
      year: new Date().getFullYear(),
      month: new Date().getMonth() + 1,
      day: new Date().getDate(),
      years: Array.from({
        length: 3
      }, (_, i) => new Date().getFullYear() - 1 + i),
      months: Array.from({
        length: 12
      }, (_, i) => i + 1),
      get days() {
        return Array.from({
          length: new Date(this.year, this.month, 0).getDate()
        }, (_, i) => i + 1);
      },
      init() {
        this.updateDate();
      },
      updateDate() {
        this.$dispatch('input', `${this.year}-${String(this.month).padStart(2, '0')}-${String(this.day).padStart(2, '0')}`);
      }
    }
  }
</script>
