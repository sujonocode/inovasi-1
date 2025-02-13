<div class="container my-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="fw-bold section-title">Reminder BRS dan Publikasi</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-sm">
                <div class="card-body p-3">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Detail Reminder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="modalEventTitle" class="fw-bold"></h5>
                <p>Tanggal &nbsp;&nbsp;: <span id="modalEventDate"></span></p>
                <p>Waktu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="modalEventTime"></span></p>
                <!-- <p>Kategori&nbsp;&nbsp;: <span id="modalEventCategory"></span></p> -->
                <p>Kontak &nbsp;&nbsp;&nbsp;: <span id="modalEventContact"></span></p>
                <p>Reminder: <span id="modalEventReminder"></span></p>
                <p>Catatan &nbsp;&nbsp;: <span id="modalEventNotes"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            firstDay: 1,
            locale: 'id',
            aspectRatio: window.innerWidth < 768 ? 1 : 1.5, // Adjust aspect ratio for mobile
            contentHeight: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: window.innerWidth < 768 ? 'dayGridMonth' : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: <?= json_encode(array_map(function ($jadwalKonten) {
                        return [
                            'id' => $jadwalKonten['id'],
                            'title' => $jadwalKonten['nama'],
                            'start' => $jadwalKonten['tanggal'],
                            'extendedProps' => [
                                'waktu' => $jadwalKonten['waktu'],
                                'kontak' => $jadwalKonten['kontak'],
                                'pengingat' => $jadwalKonten['pengingat'],
                                'catatan' => $jadwalKonten['catatan'],
                            ]
                        ];
                    }, $jadwalKontens)) ?>,
            buttonText: {
                today: 'Hari Ini',
                month: 'Bulan',
                week: 'Minggu',
                day: 'Hari'
            },
            eventClick: function(info) {
                // Close any existing modals before opening a new one
                var eventModal = document.getElementById('eventModal');
                var moreEventsModal = document.querySelector('.fc-more-popover'); // FullCalendar's built-in popover for "+N others"

                var eventModalInstance = bootstrap.Modal.getInstance(eventModal);
                if (eventModalInstance) {
                    eventModalInstance.hide();
                }

                // Close the "+N others" modal if it's open
                if (moreEventsModal) {
                    moreEventsModal.style.display = 'none'; // Hide the popover
                }

                // Populate modal content
                const date = new Date(info.event.start);
                const formattedDate = date.toLocaleDateString("id-ID", {
                    weekday: "long",
                    day: "2-digit",
                    month: "long",
                    year: "numeric"
                });
                const contacts = <?= json_encode($contacts, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
                const contactNumbers = info.event.extendedProps.kontak || 'N/A';
                if (contactNumbers !== 'N/A') {
                    const contactNames = contactNumbers.split(',').map(number => contacts[number] || number).join(', ');

                    document.getElementById('modalEventContact').textContent = contactNames;
                } else {
                    document.getElementById('modalEventContact').textContent = 'N/A';
                }
                document.getElementById('modalEventTitle').textContent = info.event.title;
                document.getElementById('modalEventDate').textContent = formattedDate;
                document.getElementById('modalEventTime').textContent = info.event.extendedProps.waktu.split(":").slice(0, 2).join(":") + " WIB" || 'N/A';
                document.getElementById('modalEventReminder').textContent = info.event.extendedProps.pengingat.replace(/[\[\]"]/g, '').split(",").join(", ") || 'N/A';
                document.getElementById('modalEventNotes').textContent = info.event.extendedProps.catatan || 'N/A';

                // Show the event details modal
                var myModal = new bootstrap.Modal(eventModal);
                myModal.show();
            },
            dayMaxEventRows: 3,
            moreLinkText: function(n) {
                return "+" + n + " others";
            }
        });

        calendar.render();

        function makeButtonsResponsive() {
            document.querySelectorAll('.fc-button').forEach(function(btn) {
                btn.classList.add('btn', 'btn-sm', 'btn-primary');
                btn.style.fontSize = '14px';
            });
        }

        setTimeout(makeButtonsResponsive, 500);
    });
</script>