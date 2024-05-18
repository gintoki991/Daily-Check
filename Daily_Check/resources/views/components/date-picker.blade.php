<div>
  <form x-data="datePicker()">
    <label for="year">年:</label>
    <select id="year" x-model="year">
      <template x-for="year in years">
        <option :value="year" x-text="year"></option>
      </template>
    </select>

    <label for="month">月:</label>
    <select id="month" x-model="month">
      <template x-for="month in months">
        <option :value="month" x-text="month"></option>
      </template>
    </select>

    <label for="day">日:</label>
    <select id="day" x-model="day">
      <template x-for="day in days">
        <option :value="day" x-text="day"></option>
      </template>
    </select>
  </form>

  <script>
    function datePicker() {
      const currentDate = new Date();
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
        }
      }
    }
  </script>
</div>
