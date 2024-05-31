<div x-data="datePicker()" x-init="init()" class="flex items-center space-x-4">
  <div>
    <label for="year">年:</label>
    <select id="year" x-model="year" @change="updateDate" class="mr-1">
      <template x-for="year in years" :key="year">
        <option :value="year" x-text="year"></option>
      </template>
    </select>
  </div>
  <div>
    <label for="month">月:</label>
    <select id="month" x-model="month" @change="updateDate" class="mr-1">
      <template x-for="month in months" :key="month">
        <option :value="month" x-text="month"></option>
      </template>
    </select>
  </div>
  <div>
    <label for="day">日:</label>
    <select id="day" x-model="day" @change="updateDate" class="mr-1">
      <template x-for="day in days" :key="day">
        <option :value="day" x-text="day"></option>
      </template>
    </select>
  </div>
  <input type="hidden" name="date" x-ref="date" :value="formattedDate">
</div>

<script>
  function datePicker() {
    return {
      year: new Date().getFullYear(),
      month: new Date().getMonth() + 1,
      day: new Date().getDate(),
      years: Array.from({
        length: 100
      }, (_, i) => new Date().getFullYear() - i),
      months: Array.from({
        length: 12
      }, (_, i) => i + 1),
      days: [],
      init() {
        this.updateDays();
        this.updateDate();
      },
      updateDays() {
        const daysInMonth = new Date(this.year, this.month, 0).getDate();
        this.days = Array.from({
          length: daysInMonth
        }, (_, i) => i + 1);
        if (!this.days.includes(this.day)) {
          this.day = this.days[0];
        }
      },
      updateDate() {
        this.updateDays();
        this.$refs.date.value = this.formattedDate;
      },
      get formattedDate() {
        return `${this.year}-${String(this.month).padStart(2, '0')}-${String(this.day).padStart(2, '0')}`;
      }
    };
  }
</script>
