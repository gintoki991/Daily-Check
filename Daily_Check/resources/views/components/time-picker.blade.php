<!-- resources/views/components/time-picker.blade.php -->
<div x-data="timePicker()" class="flex gap-5">
  <div class="flex flex-col">
    <label for="start-hour" class="mb-1">開始時間:</label>
    <div class="flex items-center">
      <select id="start-hour" x-model="startHour" @change="updateTime('start')" class="mr-1">
        <template x-for="hour in hours" :key="hour">
          <option :value="hour" x-text="hour"></option>
        </template>
      </select>
      :
      <select id="start-minute" x-model="startMinute" @change="updateTime('start')" class="ml-1">
        <template x-for="minute in minutes" :key="minute">
          <option :value="minute" x-text="minute"></option>
        </template>
      </select>
    </div>
  </div>

  <div class="flex flex-col">
    <label for="end-hour" class="mb-1">終了時間:</label>
    <div class="flex items-center">
      <select id="end-hour" x-model="endHour" @change="updateTime('end')" class="mr-1">
        <template x-for="hour in hours" :key="hour">
          <option :value="hour" x-text="hour"></option>
        </template>
      </select>
      :
      <select id="end-minute" x-model="endMinute" @change="updateTime('end')" class="ml-1">
        <template x-for="minute in minutes" :key="minute">
          <option :value="minute" x-text="minute"></option>
        </template>
      </select>
    </div>
  </div>
</div>

<script>
  function timePicker() {
    return {
      startHour: 0,
      startMinute: 0,
      endHour: 0,
      endMinute: 0,
      hours: Array.from({
        length: 24
      }, (_, i) => i),
      minutes: Array.from({
        length: 6
      }, (_, i) => i * 10),
      updateTime(type) {
        if (type === 'start') {
          this.$dispatch('start-time-changed', {
            hour: this.startHour,
            minute: this.startMinute
          });
        } else {
          this.$dispatch('end-time-changed', {
            hour: this.endHour,
            minute: this.endMinute
          });
        }
      }
    }
  }
</script>
