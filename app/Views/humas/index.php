<div class="container mt-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h2>event Calendar</h2>
        </div>
    </div>

    <div class="calendar-container mb-5">
        <div id="calendar"></div>
    </div>
</div>

<!-- event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">event for the Day</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="eventList"></ul>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for FullCalendar) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- FullCalendar Core and Plugins JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/main.min.js"></script> -->

<!-- Bootstrap Bundle JS (includes Popper) -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            firstDay: 1, // Start the week from Monday
            locale: 'id', // Use Indonesian language
            events: <?= json_encode(array_map(function ($jadwalKonten) {
                        return [
                            'id' => $jadwalKonten['id'],
                            'title' => $jadwalKonten['nama'],
                            'start' => $jadwalKonten['tanggal'], // 'start' is the correct key for event dates
                            'extendedProps' => [
                                'waktu' => $jadwalKonten['waktu'],
                                'kategori' => $jadwalKonten['kategori'],
                                'kontak' => $jadwalKonten['kontak'],
                                'pengingat' => $jadwalKonten['pengingat'],
                                'catatan' => $jadwalKonten['catatan'],
                            ]
                        ];
                    }, $jadwalKontens)) ?>,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventContent: function(arg) {
                // Customize event rendering (if needed)
                return {
                    html: `<b>${arg.event.title}</b>`
                };
            },
            dayMaxEventRows: true, // Enable "more" link when too many events
            moreLinkContent: function(arg) {
                return `+${arg.num} more`;
            },
            moreLinkClick: function(info) {
                showEventList(info.dateStr); // Show modal for the clicked date
            },
            eventClick: function(info) {
                alert('Event: ' + info.event.title);
            },
        });

        calendar.render();

        // Function to display the modal with events for a specific day
        function showEventList(date) {
            var eventsForDay = calendar.getEvents().filter(function(event) {
                return event.startStr === date;
            });

            var eventList = document.getElementById('eventList');
            eventList.innerHTML = ''; // Clear any existing list items

            eventsForDay.forEach(function(event) {
                var listItem = document.createElement('li');
                listItem.textContent = `${event.title}: ${event.extendedProps.catatan || ''}`;
                eventList.appendChild(listItem);
            });

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
            myModal.show();
        }
    });
</script>