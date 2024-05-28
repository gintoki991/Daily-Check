<!-- resources/views/components/date-picker.blade.php -->
<div x-data="datePicker()" x-init="init()" class="flex items-center space-x-4">
  <div>
    <label for="year">年:</label>
    <select id="year" name="year" x-model="year" @change="updateDate" class="mr-1">
      <template x-for="year in years" :key="year">
        <option :value="year" x-text="year"></option>
      </template>
    </select>
  </div>
  <div>
    <label for="month">月:</label>
    <select id="month" name="month" x-model="month" @change="updateDate" class="mr-1">
      <template x-for="month in months" :key="month">
        <option :value="month" x-text="month"></option>
      </template>
    </select>
  </div>
  <div>
    <label for="day">日:</label>
    <select id="day" name="day" x-model="day" @change="updateDate" class="mr-1">
      <template x-for="day in days" :key="day">
        <option :value="day" x-text="day"></option>
      </template>
    </select>
  </div>
  <input type="hidden" name="date" x-ref="date" x-model="date" @input="$dispatch('input', { target: { value: date } })">
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
      get date() {
        return `${this.year}-${String(this.month).padStart(2, '0')}-${String(this.day).padStart(2, '0')}`;
      },
      init() {
        this.updateDate();
      },
      updateDate() {
        console.log('updateDate called with date:', this.date);
        this.$refs.date.value = this.date;
        this.$dispatch('input', {
          target: {
            value: this.date
          }
        });
      }
    }
  }
</script>
