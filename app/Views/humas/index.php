<div class="container my-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="fw-bold">Reminder Konten Humas</h2>
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
                <p>Kategori&nbsp;&nbsp;: <span id="modalEventCategory"></span></p>
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
            aspectRatio: 1.5, // Adjusts height dynamically
            contentHeight: 'auto', // Makes it fit smaller screens
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: <?= json_encode(array_map(function ($jadwalKonten) {
                        return [
                            'id' => $jadwalKonten['id'],
                            'title' => $jadwalKonten['nama'],
                            'start' => $jadwalKonten['tanggal'],
                            'extendedProps' => [
                                'waktu' => $jadwalKonten['waktu'],
                                'kategori' => $jadwalKonten['kategori'],
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
                document.getElementById('modalEventTitle').textContent = info.event.title;
                document.getElementById('modalEventDate').textContent = info.event.start.toISOString().split('T')[0];
                document.getElementById('modalEventTime').textContent = info.event.extendedProps.waktu || 'N/A';
                document.getElementById('modalEventCategory').textContent = info.event.extendedProps.kategori || 'N/A';
                document.getElementById('modalEventContact').textContent = info.event.extendedProps.kontak || 'N/A';
                document.getElementById('modalEventReminder').textContent = info.event.extendedProps.pengingat || 'N/A';
                document.getElementById('modalEventNotes').textContent = info.event.extendedProps.catatan || 'N/A';

                var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
                myModal.show();
            }
        });

        calendar.render();

        // Ensure buttons are responsive
        function makeButtonsResponsive() {
            document.querySelectorAll('.fc-button').forEach(function(btn) {
                btn.classList.add('btn', 'btn-sm', 'btn-primary'); // Make buttons smaller and stylish
                btn.style.fontSize = '14px'; // Adjust font size for mobile screens
            });
        }

        // Wait for FullCalendar to render buttons
        setTimeout(makeButtonsResponsive, 500);
    });
</script>