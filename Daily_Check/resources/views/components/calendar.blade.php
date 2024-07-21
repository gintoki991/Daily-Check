<div>
  <!-- FullCalendarのCSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css" rel="stylesheet">

  <!-- FullCalendarのJavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <div id="calendar"></div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ja',
        dateClick: function(info) {
          Livewire.emit('selectDate', info.dateStr);
        }
      });
      calendar.render();
    });
  </script>
</div>
