<?= $this->include('templates/header'); ?>
<div class="container my-4">
    <h4 class="fw-semibold text-primary mb-2">
        Detail: <?= esc($kegiatan['nama_kegiatan']) ?>
    </h4>
    <p class="text-muted mb-4"><?= esc($kegiatan['keterangan']) ?></p>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelDetail" class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Nama Pegawai</th>
                            <th>Peran</th>
                            <th>Target</th>
                            <th>Realisasi</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($items as $it): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($it['nama_pegawai']) ?></td>
                                <td><?= esc($it['peran']) ?></td>
                                <td><?= esc($it['target']) . ' ' . $it['satuan'] ?></td>
                                <td><?= esc($it['realisasi']) ?></td>
                                <td><?= esc($it['progress_persen']) ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Inisialisasi DataTable -->
<script>
    $(document).ready(function() {
        $('#tabelDetail').DataTable({
            order: [
                [5, 'desc']
            ], // urut default berdasarkan kolom persen (kolom ke-6)
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ baris",
                info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "›",
                    previous: "‹"
                }
            },
            columnDefs: [{
                    targets: 0,
                    className: 'text-center'
                },
                {
                    targets: 2,
                    className: 'text-center'
                },
                {
                    targets: 3,
                    className: 'text-end'
                },
                {
                    targets: 4,
                    className: 'text-end'
                },
                {
                    targets: 5,
                    className: 'text-end fw-semibold text-primary'
                },
            ]
        });
    });
</script>

<?php
$json_items = json_encode($items, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
?>

<style>
    /* wrapper umum untuk chart */
    .chart-section {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        transition: box-shadow 0.3s ease;
    }

    .chart-section:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .chart-wrap {
        max-width: 960px;
        margin: 0 auto;
    }

    canvas {
        width: 100% !important;
        height: 60vh !important;
    }

    /* heading section */
    .chart-title {
        font-weight: 600;
        color: #0d47a1;
        text-align: center;
        margin-bottom: 1rem;
        letter-spacing: 0.3px;
    }

    .subtext {
        text-align: center;
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    /* responsive tweak */
    @media (max-width: 768px) {
        canvas {
            height: 50vh !important;
        }

        .chart-section {
            padding: 1rem 1.25rem;
        }
    }
</style>


<div class="container py-4">

    <!-- Target & Realisasi -->
    <div class="chart-section">
        <h2 class="chart-title">📊 Target dan Realisasi</h2>
        <p class="subtext">Perbandingan antara target dan capaian realisasi setiap pegawai</p>
        <div class="chart-wrap">
            <canvas id="chart8a"></canvas>
        </div>
    </div>

    <!-- Progres -->
    <div class="chart-section">
        <h2 class="chart-title">🚀 Progres Pekerjaan</h2>
        <p class="subtext">Persentase kemajuan terhadap target per pegawai</p>
        <div class="chart-wrap">
            <canvas id="chart8b"></canvas>
        </div>
    </div>

</div>

<script>
    const rawItems = <?php echo $json_items; ?>;

    // const items = rawItems
    //     .map(it => ({
    //         ...it,
    //         // konversi angka (digit-by-digit)
    //         realisasiN: (function(s) {
    //             const cleaned = (typeof s === 'string') ? s.replace(/[^0-9\.\-]/g, '') : (s || 0);
    //             const v = parseFloat(cleaned);
    //             return Number.isFinite(v) ? v : 0;
    //         })(it.realisasi),
    //         targetN: (function(s) {
    //             const cleaned = (typeof s === 'string') ? s.replace(/[^0-9\.\-]/g, '') : (s || 0);
    //             const v = parseFloat(cleaned);
    //             return Number.isFinite(v) ? v : 0;
    //         })(it.target),
    //         progressN: parseFloat(it.progress_persen || 0)
    //     }))
    //     .sort((a, b) => {
    //         const diff = b.progressN - a.progressN;
    //         if (diff !== 0) return diff; // urut menurun berdasar persentase
    //         return (a.nama_pegawai || '').localeCompare(b.nama_pegawai || '');
    //     });

    // const items = rawItems
    //     .map(it => ({
    //         ...it,
    //         // konversi angka dengan pembersihan karakter non-digit
    //         realisasiN: (function(s) {
    //             const cleaned = (typeof s === 'string') ? s.replace(/[^0-9\.\-]/g, '') : (s || 0);
    //             const v = parseFloat(cleaned);
    //             return Number.isFinite(v) ? v : 0;
    //         })(it.realisasi),
    //         targetN: (function(s) {
    //             const cleaned = (typeof s === 'string') ? s.replace(/[^0-9\.\-]/g, '') : (s || 0);
    //             const v = parseFloat(cleaned);
    //             return Number.isFinite(v) ? v : 0;
    //         })(it.target),
    //         progressN: parseFloat(it.progress_persen || 0)
    //     }));

    // // --- cek apakah semua realisasi masih 0 ---
    // const allZero = items.every(it => it.realisasiN === 0);

    // // --- urutkan ---
    // items.sort((a, b) => {
    //     if (allZero) {
    //         // Jika semua realisasi = 0, urutkan berdasarkan target terbanyak
    //         const diffTarget = b.targetN - a.targetN;
    //         if (diffTarget !== 0) return diffTarget;
    //     } else {
    //         // Jika sudah ada realisasi, urutkan berdasarkan progress persen menurun
    //         const diffProgress = b.progressN - a.progressN;
    //         if (diffProgress !== 0) return diffProgress;
    //     }

    //     // Jika nilai sama, urutkan berdasarkan nama (A-Z)
    //     return (a.nama_pegawai || '').localeCompare(b.nama_pegawai || '');
    // });

    const items = rawItems
        .map(it => ({
            ...it,
            // konversi ke angka aman untuk perhitungan
            realisasiN: (function(s) {
                const cleaned = (typeof s === 'string') ? s.replace(/[^0-9.\-]/g, '') : (s || 0);
                const v = parseFloat(cleaned);
                return Number.isFinite(v) ? v : 0;
            })(it.realisasi),
            targetN: (function(s) {
                const cleaned = (typeof s === 'string') ? s.replace(/[^0-9.\-]/g, '') : (s || 0);
                const v = parseFloat(cleaned);
                return Number.isFinite(v) ? v : 0;
            })(it.target),
            progressN: parseFloat(it.progress_persen || 0)
        }))
        .sort((a, b) => {
            const diffTarget = b.targetN - a.targetN; // urut menurun berdasarkan target
            if (diffTarget !== 0) return diffTarget;
            return (a.nama_pegawai || '').localeCompare(b.nama_pegawai || ''); // urut A–Z jika target sama
        });


    // labels & arrays untuk dua dataset
    const labels = items.map(i => i.nama_pegawai || ('ID ' + (i.id_pegawai || i.id || '')));
    const targetValues = items.map(i => i.targetN);
    const realValues = items.map(i => i.realisasiN);

    // Warna: pilih dua warna berbeda (Anda bisa ganti hex sesuai selera)
    const colorTarget = '#87bfff'; // warna untuk Target (lebih terang)
    const colorRealisasi = '#044b91'; // warna untuk Realisasi (lebih gelap)

    // Border warna (sedikit gelap)
    function hexToRgb(hex) {
        const h = hex.replace('#', '');
        return [parseInt(h.substring(0, 2), 16), parseInt(h.substring(2, 4), 16), parseInt(h.substring(4, 6), 16)];
    }

    function rgbToHex(r, g, b) {
        return '#' + [r, g, b].map(v => v.toString(16).padStart(2, '0')).join('');
    }

    function darker(hex, factor = 0.82) {
        const rgb = hexToRgb(hex);
        const d = rgb.map(v => Math.max(0, Math.round(v * factor)));
        return rgbToHex(d[0], d[1], d[2]);
    }

    const targetBorder = darker(colorTarget);
    const realBorder = darker(colorRealisasi);

    // Buat Chart.js horizontal grouped bars (dua dataset per label)
    const ctx = document.getElementById('chart8a').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Target',
                    data: targetValues,
                    backgroundColor: colorTarget,
                    borderColor: targetBorder,
                    borderWidth: 1,
                    borderRadius: 6,
                    maxBarThickness: 28,
                    // put Target as first (atas), realisasi di bawah
                },
                {
                    label: 'Realisasi',
                    data: realValues,
                    backgroundColor: colorRealisasi,
                    borderColor: realBorder,
                    borderWidth: 1,
                    borderRadius: 6,
                    maxBarThickness: 28,
                }
            ]
        },
        options: {
            indexAxis: 'y', // horizontal bars
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 8,
                    right: 12,
                    bottom: 8,
                    left: 8
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: (items[0]?.satuan ? ('Jumlah (' + items[0].satuan + ')') : 'Jumlah')
                    },
                    ticks: {
                        precision: 0
                    },
                },
                y: {
                    stacked: false,
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    },
                    grid: {
                        display: false // ← hilangkan garis horizontal (grid di sumbu X)
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            const dsLabel = ctx.dataset.label || '';
                            const i = ctx.dataIndex;
                            const it = items[i] || {};
                            const v = ctx.raw;
                            if (dsLabel === 'Target') {
                                return `Target: ${v} ${it.satuan || ''}`;
                            } else {
                                return `Realisasi: ${v} ${it.satuan || ''} — Progress: ${it.progress_persen || '-'}%`;
                            }
                        }
                    }
                },
                // datalabels disabled by default; we implement manual labels below
            },
            animation: {
                duration: 600,
                easing: 'easeOutQuart'
            },
            // atur bar grouping / jarak
            datasets: {
                bar: {
                    // smaller category to fit two bars cleanly
                    categoryPercentage: 0.6,
                    barPercentage: 0.9
                }
            }
        }
    });

    // Render label angka di ujung tiap bar (mendukung multi-dataset)
    // jalankan setiap selesai render / update
    function drawDataLabels() {
        const ctx2 = myChart.ctx;
        ctx2.save();
        ctx2.font = '12px system-ui, Arial';
        ctx2.textBaseline = 'middle';
        ctx2.fillStyle = '#000';
        const metas = myChart.getSortedVisibleDatasetMetas(); // meta per dataset
        // loop per dataset untuk menggambar label tiap bar
        metas.forEach(meta => {
            meta.data.forEach((bar, idx) => {
                if (!bar) return;
                // posisi: ujung kanan bar + offset
                const x = bar.x + 6;
                const y = bar.y;
                const val = meta.raw[idx];
                // tampilkan angka, jika integer tampil bulat
                const text = (Number.isInteger(val)) ? String(val) : String(val);
                ctx2.fillText(text, x, y);
            });
        });
        ctx2.restore();
    }

    // panggil setelah render dan setelah setiap update
    myChart.on('afterRender', function() {
        drawDataLabels();
    });
    myChart.on('afterUpdate', function() {
        drawDataLabels();
    });

    // jika butuh update data secara dinamis, update myChart.data.datasets[...] lalu myChart.update()
</script>

<!-- chart8b -->
<script>
    // === Grafik Progress Persentase ===
    const rawItems2 = <?php echo $json_items; ?>;

    // Ubah string -> angka dan urutkan menurun berdasarkan progress_persen
    const items2 = rawItems2
        .map(it => ({
            ...it,
            progressN: parseFloat(it.progress_persen || 0)
        }))
        .sort((a, b) => {
            const valA = parseFloat(a.progress_persen || 0);
            const valB = parseFloat(b.progress_persen || 0);

            if (valB > valA) return 1; // urut menurun
            if (valB < valA) return -1; // urut menurun

            // jika sama, urutkan nama secara abjad (A → Z)
            const nameA = (a.nama_pegawai || '').trim().toLowerCase();
            const nameB = (b.nama_pegawai || '').trim().toLowerCase();
            return nameA.localeCompare(nameB, 'id'); // urut lokal Indonesia
        });


    const labels2 = items2.map(i => i.nama_pegawai || ('ID ' + (i.id_pegawai || i.id || '')));
    const progressValues = items2.map(i => i.progressN);

    // Buat gradasi hijau: kecil = terang, besar = gelap
    function hexToRgb(hex) {
        const h = hex.replace('#', '');
        return [parseInt(h.substring(0, 2), 16), parseInt(h.substring(2, 4), 16), parseInt(h.substring(4, 6), 16)];
    }

    function rgbToHex(r, g, b) {
        return '#' + [r, g, b].map(v => v.toString(16).padStart(2, '0')).join('');
    }

    function interpColor(hexA, hexB, t) {
        const a = hexToRgb(hexA),
            b = hexToRgb(hexB);
        const r = Math.round(a[0] + (b[0] - a[0]) * t);
        const g = Math.round(a[1] + (b[1] - a[1]) * t);
        const bl = Math.round(a[2] + (b[2] - a[2]) * t);
        return rgbToHex(r, g, bl);
    }

    const lightGreen = '#dfefff'; // nilai kecil
    const darkGreen = '#044b91'; // nilai besar

    const maxVal2 = Math.max(...progressValues, 100);
    const minVal2 = Math.min(...progressValues, 0);
    const range2 = Math.max(maxVal2 - minVal2, 1);

    const barColors2 = progressValues.map(v => {
        const t = (v - minVal2) / range2;
        return interpColor(lightGreen, darkGreen, t);
    });
    const borderColors2 = barColors2.map(c => {
        const rgb = hexToRgb(c);
        const darker = rgb.map(v => Math.max(0, Math.round(v * 0.82)));
        return rgbToHex(darker[0], darker[1], darker[2]);
    });

    // Buat chart progress
    const ctx2 = document.getElementById('chart8b').getContext('2d');
    const progressChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels2,
            datasets: [{
                label: 'Progress (%)',
                data: progressValues,
                backgroundColor: barColors2,
                borderColor: borderColors2,
                borderWidth: 1,
                borderRadius: 8,
                maxBarThickness: 48
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 8,
                    right: 12,
                    bottom: 8,
                    left: 8
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Progress (%)'
                    },
                    ticks: {
                        stepSize: 10
                    },
                },
                y: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    },
                    grid: {
                        display: false // ← hilangkan garis horizontal (grid di sumbu X)
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            const i = ctx.dataIndex;
                            const it = items2[i];
                            return `Progress: ${ctx.raw}% (${it.realisasi} dari ${it.target} ${it.satuan || ''})`;
                        }
                    }
                }
            },
            animation: {
                duration: 600,
                easing: 'easeOutQuart'
            }
        }
    });

    // Tambahkan label angka di ujung bar
    function drawPercentLabels() {
        const ctx = progressChart.ctx;
        ctx.save();
        ctx.font = '12px system-ui, Arial';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = '#000';
        const meta = progressChart.getDatasetMeta(0);
        meta.data.forEach((bar, idx) => {
            const val = progressValues[idx];
            const x = bar.x + 6;
            const y = bar.y;
            ctx.fillText(val + '%', x, y);
        });
        ctx.restore();
    }
    progressChart.on('afterRender', drawPercentLabels);
    progressChart.on('afterUpdate', drawPercentLabels);
</script>

<?= $this->include('templates/footer'); ?>