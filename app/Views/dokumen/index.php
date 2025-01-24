<div class="container my-5">
    <h2 class="section-title text-center mb-4">Dashboard Dokumen</h2>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-header text-white" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-folder-tree"></i> Total Dokumen
                </div>
                <div class="card-body text-center">
                    <h5 id="card-1" class="card-title display-6 fw-bold">1,245</h5>
                    <!-- <p class="card-text">Employees currently in the system</p> -->
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-header text-white" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-file-lines"></i> Total Surat
                </div>
                <div class="card-body text-center">
                    <h5 id="card-2" class="card-title display-6 fw-bold">850</h5>
                    <!-- <p class="card-text">Employees actively working</p> -->
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-header text-white" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-file-signature"></i> Total SK
                </div>
                <div class="card-body text-center">
                    <h5 id="card-3" class="card-title display-6 fw-bold">120</h5>
                    <!-- <p class="card-text">Employees currently on leave</p> -->
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-header text-white" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fas fa-file-contract"></i> Total Kontrak
                </div>
                <div class="card-body text-center">
                    <h5 id="card-4" class="card-title display-6 fw-bold">150</h5>
                    <!-- <p class="card-text">Available job openings</p> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Chart 1 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    Distribusi Dokumen
                </div>
                <div class="card-body">
                    <canvas id="pieChart1"></canvas>
                </div>
            </div>
        </div>
        <!-- Chart 2 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    Jumlah Surat Berdasarkan Kode Arsip
                </div>
                <div class="card-body">
                    <canvas id="pieChart2"></canvas>
                </div>
            </div>
        </div>
        <!-- Chart 3 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    Jumlah Surat Berdasarkan PIC
                </div>
                <div class="card-body">
                    <canvas id="pieChart3"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    Jumlah Dokumen Per Hari
                </div>
                <div class="card-body">
                    <canvas id="barChart1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    Jumlah Surat Per Hari
                </div>
                <div class="card-body">
                    <canvas id="lineChart1"></canvas>
                </div>
            </div>
        </div>
    </div> -->
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

    const totalSurat = <?php echo json_encode($totalSurat); ?>;
    const totalSk = <?php echo json_encode($totalSk); ?>;
    const totalKontrak = <?php echo json_encode($totalKontrak); ?>;
    const totalSum = totalSurat + totalSk + totalKontrak;

    const totalSuratByKodeArsip = <?php echo json_encode($totalSuratByKodeArsip); ?>;
    const totalSkByKodeArsip = <?php echo json_encode($totalSkByKodeArsip); ?>;
    const totalKontrakByKodeArsip = <?php echo json_encode($totalKontrakByKodeArsip); ?>;
    const totalSuratByCreatedBy = <?php echo json_encode($totalSuratByCreatedBy); ?>;
    const totalSkByCreatedBy = <?php echo json_encode($totalSkByCreatedBy); ?>;
    const totalKontrakByCreatedBy = <?php echo json_encode($totalKontrakByCreatedBy); ?>;

    function getKodeArsipAndCount(data) {
        const countByCategory = data.reduce((acc, item) => {
            if (acc[item.kode_arsip]) {
                acc[item.kode_arsip] += parseInt(item.count);
            } else {
                acc[item.kode_arsip] = parseInt(item.count);
            }
            return acc;
        }, {});

        const suratKodeArsip = Object.keys(countByCategory);
        const suratKodeArsipCount = Object.values(countByCategory);

        return {
            suratKodeArsip,
            suratKodeArsipCount
        };
    }

    const {
        suratKodeArsip,
        suratKodeArsipCount
    } = getKodeArsipAndCount(totalSuratByKodeArsip);

    function getCreatedByAndCount(data) {
        const countByCategory = data.reduce((acc, item) => {
            if (acc[item.created_by]) {
                acc[item.created_by] += parseInt(item.count);
            } else {
                acc[item.created_by] = parseInt(item.count);
            }
            return acc;
        }, {});

        const suratCreatedBy = Object.keys(countByCategory);
        const suratCreatedByCount = Object.values(countByCategory);

        return {
            suratCreatedBy,
            suratCreatedByCount
        };
    }

    const {
        suratCreatedBy,
        suratCreatedByCount
    } = getCreatedByAndCount(totalSuratByCreatedBy);
</script>

<!-- Card Chart -->
<script>
    document.getElementById('card-1').innerText = `${totalSum}`;
    document.getElementById('card-2').innerText = `${totalSurat}`;
    document.getElementById('card-3').innerText = `${totalSk}`;
    document.getElementById('card-4').innerText = `${totalKontrak}`;
</script>

<!-- Chart -->
<script>
    const ctx_p1 = document.getElementById('pieChart1').getContext('2d');
    const employeeChart_p1 = new Chart(ctx_p1, {
        type: 'pie',
        data: {
            labels: ['Surat', 'SK', 'Kontrak'],
            datasets: [{
                label: 'Total: ',
                data: [totalSurat, totalSk, totalKontrak],
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
            labels: suratKodeArsip,
            datasets: [{
                label: 'Jumlah',
                data: suratKodeArsipCount,
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
            labels: suratCreatedBy,
            datasets: [{
                label: 'Jumlah',
                data: suratCreatedByCount,
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

    // const ctx_b1 = document.getElementById('barChart1').getContext('2d');
    // new Chart(ctx_b1, {
    //     type: 'bar',
    //     data: {
    //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    //         datasets: [{
    //             label: 'Employees',
    //             data: [120, 150, 180, 200, 170, 160],
    //             backgroundColor: chartColors.blue7,
    //             borderColor: chartColors.blue,
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: {
    //                 display: false
    //             }
    //         },
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // var lineCtx1 = document.getElementById('lineChart1').getContext('2d');
    // var lineChart = new Chart(lineCtx1, {
    //     type: 'line',
    //     data: {
    //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    //         datasets: [{
    //             label: 'Revenue ($)',
    //             data: [1200, 1500, 1800, 1700, 2000, 2100, 2400],
    //             borderColor: '#3f51b5',
    //             backgroundColor: 'rgba(63, 81, 181, 0.2)',
    //             fill: true,
    //             tension: 0.4
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: {
    //                 position: 'top',
    //             },
    //             tooltip: {
    //                 callbacks: {
    //                     label: function(context) {
    //                         return '$' + context.raw;
    //                     }
    //                 }
    //             }
    //         },
    //     }
    // });
</script>