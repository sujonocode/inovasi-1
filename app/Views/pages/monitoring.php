<h1>Employee Schedule</h1>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '<?= site_url('schedule/getSchedules') ?>', // Fetch data from the controller
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventColor: '#378006', // Customize event color
                navLinks: true, // Allow day/week views to be clickable
            });

            calendar.render();
        });
    </script>