<div class="container my-5">
    <h2 class="section-title text-center mb-4">Tentang Kami</h2>
    <!-- Statistics Cards -->
    <div class="row mb-2 g-4">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <i class="fas fa-users"></i> Total Dokumen
                </div>
                <div class="card-body text-center">
                    <h5 id="card-1" class="card-title" style="font-size: 2.5rem; font-weight: bold;">1,245</h5>
                    <p class="card-text">Employees currently in the system</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-user-tie"></i> Total Surat
                </div>
                <div class="card-body text-center">
                    <h5 id="card-2" class="card-title" style="font-size: 2.5rem; font-weight: bold;">850</h5>
                    <p class="card-text">Employees actively working</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <i class="fas fa-user-clock"></i> Total SK
                </div>
                <div class="card-body text-center">
                    <h5 id="card-3" class="card-title" style="font-size: 2.5rem; font-weight: bold;">120</h5>
                    <p class="card-text">Employees currently on leave</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-briefcase"></i> Total Kontrak
                </div>
                <div class="card-body text-center">
                    <h5 id="card-4" class="card-title" style="font-size: 2.5rem; font-weight: bold;">150</h5>
                    <p class="card-text">Available job openings</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="section-title text-center mb-4">Tentang Kami</h2>
    <!-- Charts Section -->
    <div class="row mb-4"> <!-- Add margin-bottom for spacing -->
        <!-- Pie Chart 1 -->
        <div class="col-lg-4 col-md-12 mb-4"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    Distribusi Dokumen
                </div>
                <div class="card-body">
                    <canvas id="pieChart1"></canvas>
                </div>
            </div>
        </div>
        <!-- Pie Chart 2 -->
        <div class="col-lg-4 col-md-12 mb-4"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    Bar Chart - Department Overview
                </div>
                <div class="card-body">
                    <canvas id="pieChart2"></canvas>
                </div>
            </div>
        </div>
        <!-- Pie Chart 3 -->
        <div class="col-lg-4 col-md-12 mb-4"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    Bar Chart - Employee Distribution
                </div>
                <div class="card-body">
                    <canvas id="pieChart3"></canvas>
                </div>
            </div>
        </div>
    </div>

    <h2 class="section-title text-center mb-4">Tentang Kami</h2>
    <div class="row mb-4"> <!-- Add margin-bottom for spacing -->
        <!-- Bar Chart 1 -->
        <div class="col-lg-6 col-md-12 mb-4"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    Bar Chart - Employee Distribution
                </div>
                <div class="card-body">
                    <canvas id="barChart1"></canvas>
                </div>
            </div>
        </div>
        <!-- Bar Chart 2 -->
        <div class="col-lg-6 col-md-12 mb-4"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    Bar Chart - Department Overview
                </div>
                <div class="card-body">
                    <canvas id="barChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
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

        // Get list of kode_arsip and list of counts
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

        // Get list of created_by and list of counts
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

<script>
    document.getElementById('card-1').innerText = `${totalSum}`;
    document.getElementById('card-2').innerText = `${totalSurat}`;
    document.getElementById('card-3').innerText = `${totalSk}`;
    document.getElementById('card-4').innerText = `${totalKontrak}`;
</script>

<script>
    // ChartJS Initialization
    const ctx_p1 = document.getElementById('pieChart1').getContext('2d');
    const employeeChart_p1 = new Chart(ctx_p1, {
        type: 'pie',
        data: {
            labels: ['Surat', 'SK', 'Kontrak'],
            datasets: [{
                label: 'Total: ',
                data: [totalSurat, totalSk, totalKontrak],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
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

    // ChartJS Initialization
    const ctx_p2 = document.getElementById('pieChart2').getContext('2d');
    const employeeChart_p2 = new Chart(ctx_p2, {
        type: 'pie',
        data: {
            labels: suratKodeArsip,
            datasets: [{
                label: 'Employee Distribution',
                data: suratKodeArsipCount,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)', // Active
                    'rgba(255, 206, 86, 0.6)', // On Leave
                    'rgba(255, 99, 132, 0.6)' // Vacant
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
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

    // ChartJS Initialization
    const ctx_p3 = document.getElementById('pieChart3').getContext('2d');
    const employeeChart_p3 = new Chart(ctx_p3, {
        type: 'pie',
        data: {
            labels: suratCreatedBy,
            datasets: [{
                label: 'Employee Distribution',
                data: suratCreatedByCount,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)', // Active
                    'rgba(255, 206, 86, 0.6)', // On Leave
                    'rgba(255, 99, 132, 0.6)' // Vacant
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
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
</script>

<script>
    // Bar Chart 1
    const ctx1 = document.getElementById('barChart1').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Employees',
                data: [120, 150, 180, 200, 170, 160],
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart 2
    const ctx2 = document.getElementById('barChart2').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['HR', 'IT', 'Finance', 'Marketing', 'Admin'],
            datasets: [{
                label: 'Departments',
                data: [50, 80, 40, 70, 60],
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>