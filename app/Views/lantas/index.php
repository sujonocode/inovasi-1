<div class="container my-5">
    <h2 class="section-title text-center mb-4">Dashboard Dokumen</h2>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4" style="display: flex; justify-content: center; align-items: center;">
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 d-flex flex-column justify-content-center">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-folder-tree"></i> Total Dokumen
                </div>
                <div class="card-body text-center">
                    <h5 id="card-1" class="card-title display-6 fw-bold"></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 d-flex flex-column justify-content-center">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-file-lines"></i> Total Surat Keluar
                </div>
                <div class="card-body text-center">
                    <h5 id="card-2" class="card-title display-6 fw-bold"></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 d-flex flex-column justify-content-center">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-file-lines"></i> Total Surat Masuk
                </div>
                <div class="card-body text-center">
                    <h5 id="card-5" class="card-title display-6 fw-bold"></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 d-flex flex-column justify-content-center">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-file-signature"></i> Total SK
                </div>
                <div class="card-body text-center">
                    <h5 id="card-3" class="card-title display-6 fw-bold"></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 d-flex flex-column justify-content-center">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-file-contract"></i> Total Kontrak
                </div>
                <div class="card-body text-center">
                    <h5 id="card-4" class="card-title display-6 fw-bold"></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">Distribusi Dokumen</div>
                <div class="card-body">
                    <canvas id="pieChart1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">Surat Keluar Berdasarkan Kode Arsip</div>
                <div class="card-body">
                    <canvas id="pieChart2"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">Surat Keluar Berdasarkan PIC</div>
                <div class="card-body">
                    <canvas id="pieChart3"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">Surat Masuk Berdasarkan Asal</div>
                <div class="card-body">
                    <canvas id="pieChart4"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">Surat Masuk Berdasarkan PIC</div>
                <div class="card-body">
                    <canvas id="pieChart5"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">SK Berdasarkan Kode Arsip</div>
                <div class="card-body">
                    <canvas id="pieChart6"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">SK Berdasarkan PIC</div>
                <div class="card-body">
                    <canvas id="pieChart7"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">Kontrak Berdasarkan Kode Arsip</div>
                <div class="card-body">
                    <canvas id="pieChart8"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card chart-card">
                <div class="card-header">Kontrak Berdasarkan PIC</div>
                <div class="card-body">
                    <canvas id="pieChart9"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Data and Metadata -->
<script>
    const chartColors = {
        blue: "rgba(78, 121, 167, 1)", // #4E79A7
        orange: "rgba(242, 142, 43, 1)", // #F28E2B
        green: "rgba(89, 161, 79, 1)", // #59A14F
        red: "rgba(225, 87, 89, 1)", // #E15759
        purple: "rgba(176, 122, 161, 1)", // #B07AA1
        brown: "rgba(156, 117, 95, 1)", // #9C755F
        pink: "rgba(255, 157, 167, 1)", // #FF9DA7
        gray: "rgba(186, 176, 172, 1)", // #BAB0AC
        border: "rgba(211, 211, 211, 1)", // #D3D3D3
        blue7: "rgba(78, 121, 167, 0.7)", // #4E79A7
        orange7: "rgba(242, 142, 43, 0.7)", // #F28E2B
        green7: "rgba(89, 161, 79, 0.7)", // #59A14F
        red7: "rgba(225, 87, 89, 0.7)", // #E15759
        purple7: "rgba(176, 122, 161, 0.7)", // #B07AA1
        brown7: "rgba(156, 117, 95, 0.7)", // #9C755F
        pink7: "rgba(255, 157, 167, 0.7)", // #FF9DA7
        gray7: "rgba(186, 176, 172, 0.7)", // #BAB0AC
        border7: "rgba(211, 211, 211, 0.7)" // #D3D3D3
    };

    const totalSuratKeluar = <?php echo json_encode($totalSuratKeluar); ?>;
    const totalSuratMasuk = <?php echo json_encode($totalSuratMasuk); ?>;
    const totalSk = <?php echo json_encode($totalSk); ?>;
    const totalKontrak = <?php echo json_encode($totalKontrak); ?>;
    const totalSum = totalSuratKeluar + totalSuratMasuk + totalSk + totalKontrak;

    const totalSuratKeluarByKodeArsip = <?php echo json_encode($totalSuratKeluarByKodeArsip); ?>;
    const totalSuratMasukByAsal = <?php echo json_encode($totalSuratMasukByAsal); ?>;
    const totalSkByKodeArsip = <?php echo json_encode($totalSkByKodeArsip); ?>;
    const totalKontrakByKodeArsip = <?php echo json_encode($totalKontrakByKodeArsip); ?>;
    const totalSuratKeluarByCreatedBy = <?php echo json_encode($totalSuratKeluarByCreatedBy); ?>;
    const totalSuratMasukByCreatedBy = <?php echo json_encode($totalSuratMasukByCreatedBy); ?>;
    const totalSkByCreatedBy = <?php echo json_encode($totalSkByCreatedBy); ?>;
    const totalKontrakByCreatedBy = <?php echo json_encode($totalKontrakByCreatedBy); ?>;

    function groupAndCount(data, key) {
        const countByCategory = data.reduce((acc, item) => {
            acc[item[key]] = (acc[item[key]] ?? 0) + parseInt(item.count);
            return acc;
        }, {});

        return {
            categories: Object.keys(countByCategory),
            counts: Object.values(countByCategory),
        };
    }

    const {
        categories: suratKeluarKodeArsip,
        counts: suratKeluarKodeArsipCount
    } =
    groupAndCount(totalSuratKeluarByKodeArsip, 'kode_arsip');

    const {
        categories: suratMasukAsal,
        counts: suratMasukAsalCount
    } =
    groupAndCount(totalSuratMasukByAsal, 'asal');

    const {
        categories: skKodeArsip,
        counts: skKodeArsipCount
    } =
    groupAndCount(totalSkByKodeArsip, 'kode_arsip');

    const {
        categories: kontrakKodeArsip,
        counts: kontrakKodeArsipCount
    } =
    groupAndCount(totalKontrakByKodeArsip, 'kode_arsip');

    function groupAndCount(data, key) {
        const countByCategory = data.reduce((acc, item) => {
            acc[item[key]] = (acc[item[key]] ?? 0) + parseInt(item.count);
            return acc;
        }, {});

        return {
            categories: Object.keys(countByCategory),
            counts: Object.values(countByCategory),
        };
    }

    const {
        categories: suratKeluarCreatedBy,
        counts: suratKeluarCreatedByCount
    } =
    groupAndCount(totalSuratKeluarByCreatedBy, 'created_by');

    const {
        categories: suratMasukCreatedBy,
        counts: suratMasukCreatedByCount
    } =
    groupAndCount(totalSuratMasukByCreatedBy, 'created_by');

    const {
        categories: skCreatedBy,
        counts: skCreatedByCount
    } =
    groupAndCount(totalSkByCreatedBy, 'created_by');

    const {
        categories: kontrakCreatedBy,
        counts: kontrakCreatedByCount
    } =
    groupAndCount(totalKontrakByCreatedBy, 'created_by');
</script>

<!-- Card Chart -->
<script>
    document.getElementById('card-1').innerText = `${totalSum}`;
    document.getElementById('card-2').innerText = `${totalSuratKeluar}`;
    document.getElementById('card-3').innerText = `${totalSk}`;
    document.getElementById('card-4').innerText = `${totalKontrak}`;
    document.getElementById('card-5').innerText = `${totalSuratMasuk}`;
</script>

<!-- Chart -->
<script>
    const ctx_p1 = document.getElementById('pieChart1').getContext('2d');
    const employeeChart_p1 = new Chart(ctx_p1, {
        type: 'pie',
        data: {
            labels: ['Surat Keluar', 'Surat Masuk', 'SK', 'Kontrak'],
            datasets: [{
                label: 'Total: ',
                data: [totalSuratKeluar, totalSuratMasuk, totalSk, totalKontrak],
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctx_p2 = document.getElementById('pieChart2').getContext('2d');
    const employeeChart_p2 = new Chart(ctx_p2, {
        type: 'pie',
        data: {
            labels: suratKeluarKodeArsip,
            datasets: [{
                label: 'Jumlah',
                data: suratKeluarKodeArsipCount,
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctx_p3 = document.getElementById('pieChart3').getContext('2d');
    const employeeChart_p3 = new Chart(ctx_p3, {
        type: 'pie',
        data: {
            labels: suratKeluarCreatedBy,
            datasets: [{
                label: 'Jumlah',
                data: suratKeluarCreatedByCount,
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctx_p4 = document.getElementById('pieChart4').getContext('2d');
    const employeeChart_p4 = new Chart(ctx_p4, {
        type: 'pie',
        data: {
            labels: suratMasukAsal,
            datasets: [{
                label: 'Jumlah',
                data: suratMasukAsalCount,
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctx_p5 = document.getElementById('pieChart5').getContext('2d');
    const employeeChart_p5 = new Chart(ctx_p5, {
        type: 'pie',
        data: {
            labels: suratMasukCreatedBy,
            datasets: [{
                label: 'Jumlah',
                data: suratMasukCreatedByCount,
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctx_p6 = document.getElementById('pieChart6').getContext('2d');
    const employeeChart_p6 = new Chart(ctx_p6, {
        type: 'pie',
        data: {
            labels: skKodeArsip,
            datasets: [{
                label: 'Jumlah',
                data: skKodeArsipCount,
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctx_p7 = document.getElementById('pieChart7').getContext('2d');
    const employeeChart_p7 = new Chart(ctx_p7, {
        type: 'pie',
        data: {
            labels: skCreatedBy,
            datasets: [{
                label: 'Jumlah',
                data: skCreatedByCount,
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctx_p8 = document.getElementById('pieChart8').getContext('2d');
    const employeeChart_p8 = new Chart(ctx_p8, {
        type: 'pie',
        data: {
            labels: kontrakKodeArsip,
            datasets: [{
                label: 'Jumlah',
                data: kontrakKodeArsipCount,
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctx_p9 = document.getElementById('pieChart9').getContext('2d');
    const employeeChart_p9 = new Chart(ctx_p9, {
        type: 'pie',
        data: {
            labels: kontrakCreatedBy,
            datasets: [{
                label: 'Jumlah',
                data: kontrakCreatedByCount,
                backgroundColor: [chartColors.blue, chartColors.orange, chartColors.green, chartColors.red, chartColors.purple, chartColors.brown, chartColors.pink, chartColors.gray],
                borderColor: chartColors.border,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    font: {
                        size: 14
                    }
                }
            }
        }
    };

    new Chart(document.getElementById("pieChart1"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });

    new Chart(document.getElementById("pieChart2"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });

    new Chart(document.getElementById("pieChart3"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });

    new Chart(document.getElementById("pieChart4"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });

    new Chart(document.getElementById("pieChart5"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });

    new Chart(document.getElementById("pieChart6"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });

    new Chart(document.getElementById("pieChart7"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });

    new Chart(document.getElementById("pieChart8"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });

    new Chart(document.getElementById("pieChart9"), {
        type: 'pie',
        data: {
            /* Your data here */
        },
        options: chartOptions
    });
</script>