import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja.js"


flatpickr("#plan_date", {
  "locale": Japanese
});
flatpickr("#report_create_date", {
  "locale": Japanese
});
flatpickr("#report_display_date", {
  "locale": Japanese
});
flatpickr("#schedule_date", {
  "locale": Japanese
});
flatpickr("#week_picker", {
  "locale": Japanese,
    minDate: "today",
    maxDate: new Date().fp_incr(7) // 7 days from now
});

const setting = {
  "locale": Japanese,
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
}
flatpickr("#start_time", setting);
flatpickr("#end_time", setting);
