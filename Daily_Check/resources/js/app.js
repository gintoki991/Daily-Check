import './bootstrap';
import 'alpinejs';

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded event fired');

    // var calendarEl = document.getElementById('calendar');
    // if (calendarEl) {
    //     console.log('Calendar element found');

    //     var calendar = new FullCalendar.Calendar(calendarEl, {
    //         initialView: 'dayGridMonth',
    //         locale: 'ja',
    //         dateClick: function(info) {
    //             console.log('Clicked date:', info.dateStr);
    //             if (typeof Livewire !== 'undefined') {
    //                 Livewire.emit('selectDate', info.dateStr);
    //             } else {
    //                 console.error('Livewire is not defined');
    //             }
    //         }
    //     });
    //     calendar.render();
    // } else {
    //     console.error('Calendar element not found');
    // }
});
