<div>
  <div x-data="timePicker()">
    <form>
      <div class="flex gap-5">
        <!-- 開始時間 -->
        <div class="flex flex-col">
          <label for="start-hour" class="mb-1">開始時間:</label>
          <div class="flex items-center">
            <select id="start-hour" x-model="startHour" class="mr-1">
              <template x-for="hour in hours" :key="hour">
                <option :value="hour" x-text="hour"></option>
              </template>
            </select>
            :
            <select id="start-minute" x-model="startMinute" class="ml-1">
              <template x-for="minute in minutes" :key="minute">
                <option :value="minute" x-text="minute"></option>
              </template>
            </select>
          </div>
        </div>

        <!-- 終了時間 -->
        <div class="flex flex-col">
          <label for="end-hour" class="mb-1">終了時間:</label>
          <div class="flex items-center">
            <select id="end-hour" x-model="endHour" class="mr-1">
              <template x-for="hour in hours" :key="hour">
                <option :value="hour" x-text="hour"></option>
              </template>
            </select>
            :
            <select id="end-minute" x-model="endMinute" class="ml-1">
              <template x-for="minute in minutes" :key="minute">
                <option :value="minute" x-text="minute"></option>
              </template>
            </select>
          </div>
        </div>
      </div>
    </form>

    <!-- <div>
      <p>選択された時間の間: <span x-text="duration"></span></p>
    </div> -->
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
        get duration() {
          const start = this.startHour * 60 + this.startMinute;
          const end = this.endHour * 60 + this.endMinute;
          const duration = end - start;
          const hours = Math.floor(duration / 60);
          const minutes = duration % 60;
          return `${hours}時間 ${minutes}分`;
        }
      }
    }
  </script>
</div>
