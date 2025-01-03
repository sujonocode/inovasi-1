<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- FullCalendar Core and Plugins CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/main.min.css" rel="stylesheet">

    <!-- Modal CSS for event popup -->
    <style>
        .fc-daygrid-event-more {
            cursor: pointer;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col text-center">
                <h2>Event Calendar</h2>
            </div>
        </div>

        <div class="calendar-container mb-5">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Events for the Day</h5>
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
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/main.min.js"></script>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [{
                        title: 'Event 1',
                        start: '2025-01-10',
                        description: 'Description for Event 1'
                    },
                    {
                        title: 'Event 2',
                        start: '2025-01-10',
                        description: 'Description for Event 2'
                    },
                    {
                        title: 'Event 3',
                        start: '2025-01-10',
                        description: 'Description for Event 3'
                    },
                    {
                        title: 'Event 4',
                        start: '2025-01-10',
                        description: 'Description for Event 4'
                    },
                    {
                        title: 'Event 5',
                        start: '2025-01-10',
                        description: 'Description for Event 5'
                    },
                    {
                        title: 'Event 6',
                        start: '2025-01-12',
                        description: 'Description for Event 6'
                    },
                    {
                        title: 'Event 7',
                        start: '2025-01-12',
                        description: 'Description for Event 7'
                    },
                    {
                        title: 'Event 8',
                        start: '2025-01-12',
                        description: 'Description for Event 8'
                    },
                    {
                        title: 'Event 9',
                        start: '2025-01-12',
                        description: 'Description for Event 9'
                    }
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventRender: function(info) {
                    // Check if there are more than 3 events
                    if (info.el.parentElement.querySelectorAll('.fc-daygrid-event').length > 3) {
                        var extraEvents = info.el.parentElement.querySelectorAll('.fc-daygrid-event');
                        extraEvents.forEach(function(event, index) {
                            if (index >= 3) {
                                // Hide extra events
                                event.style.display = 'none';
                            }
                        });
                        // Show the "+n others" link
                        var moreLink = document.createElement('span');
                        moreLink.classList.add('fc-daygrid-event-more');
                        moreLink.innerText = `+${extraEvents.length - 3} others`;
                        moreLink.onclick = function() {
                            showEventList(info.event.startStr);
                        };
                        info.el.parentElement.appendChild(moreLink);
                    }
                }
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
                    listItem.textContent = `${event.title}: ${event.extendedProps.description}`;
                    eventList.appendChild(listItem);
                });

                // Show the modal
                var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
                myModal.show();
            }
        });
    </script>
</body>

</html>