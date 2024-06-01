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

const setting = {
  "locale": Japanese,
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
}
flatpickr("#start_time", setting);
flatpickr("#end_time", setting);
