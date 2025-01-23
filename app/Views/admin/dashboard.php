<div class="container my-5">
    <!-- Statistics Cards -->
    <div class="row mb-4 g-4">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-users"></i> Total Employees
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-size: 2.5rem; font-weight: bold;">1,245</h5>
                    <p class="card-text">Employees currently in the system</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-user-tie"></i> Active Employees
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-size: 2.5rem; font-weight: bold;">850</h5>
                    <p class="card-text">Employees actively working</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <i class="fas fa-user-clock"></i> Employees On Leave
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-size: 2.5rem; font-weight: bold;">120</h5>
                    <p class="card-text">Employees currently on leave</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-briefcase"></i> Vacant Positions
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-size: 2.5rem; font-weight: bold;">150</h5>
                    <p class="card-text">Available job openings</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4"> <!-- Add margin-bottom for spacing -->
        <!-- Pie Chart 1 -->
        <div class="col-lg-4 col-md-12 mb-2"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    Bar Chart - Employee Distribution
                </div>
                <div class="card-body">
                    <canvas id="pieChart1"></canvas>
                </div>
            </div>
        </div>
        <!-- Pie Chart 2 -->
        <div class="col-lg-4 col-md-12 mb-2"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    Bar Chart - Department Overview
                </div>
                <div class="card-body">
                    <canvas id="pieChart2"></canvas>
                </div>
            </div>
        </div>
        <!-- Pie Chart 3 -->
        <div class="col-lg-4 col-md-12 mb-2"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    Bar Chart - Employee Distribution
                </div>
                <div class="card-body">
                    <canvas id="pieChart3"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4"> <!-- Add margin-bottom for spacing -->
        <!-- Bar Chart 1 -->
        <div class="col-lg-6 col-md-12 mb-2"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    Bar Chart - Employee Distribution
                </div>
                <div class="card-body">
                    <canvas id="barChart1"></canvas>
                </div>
            </div>
        </div>
        <!-- Bar Chart 2 -->
        <div class="col-lg-6 col-md-12 mb-2"> <!-- Add margin-bottom for each column -->
            <div class="card">
                <div class="card-header bg-info text-white">
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
    // ChartJS Initialization
    const ctx_p1 = document.getElementById('pieChart1').getContext('2d');
    const employeeChart_p1 = new Chart(ctx_p1, {
        type: 'pie',
        data: {
            labels: ['Active Employees', 'On Leave', 'Vacant Positions'],
            datasets: [{
                label: 'Employee Distribution',
                data: [850, 120, 150],
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
                    position: 'top',
                }
            }
        }
    });

    // ChartJS Initialization
    const ctx_p2 = document.getElementById('pieChart2').getContext('2d');
    const employeeChart_p2 = new Chart(ctx_p2, {
        type: 'pie',
        data: {
            labels: ['Active Employees', 'On Leave', 'Vacant Positions'],
            datasets: [{
                label: 'Employee Distribution',
                data: [850, 120, 150],
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
                    position: 'top',
                }
            }
        }
    });

    // ChartJS Initialization
    const ctx_p3 = document.getElementById('pieChart3').getContext('2d');
    const employeeChart_p3 = new Chart(ctx_p3, {
        type: 'pie',
        data: {
            labels: ['Active Employees', 'On Leave', 'Vacant Positions'],
            datasets: [{
                label: 'Employee Distribution',
                data: [850, 120, 150],
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
                    position: 'top',
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