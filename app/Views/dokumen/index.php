<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Responsive Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ03K5DL2wI7j9Q6BPM69U+P69FcZXGV2XlG19IHqhPHQ7OG5xw5ya5ojOjp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }

        .content {
            padding: 30px 20px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .card-header {
            background-color: #3f51b5;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 12px 12px 0 0;
        }

        .card-body {
            background-color: #f9f9f9;
            padding: 20px;
        }

        .section-header {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #3f51b5;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .chart-container .canvas-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
        }

        .footer {
            background-color: #3f51b5;
            color: white;
            padding: 15px 20px;
            text-align: center;
            margin-top: 50px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .section-header {
                font-size: 1.5rem;
            }

            .chart-container {
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            .section-header {
                font-size: 1.2rem;
            }

            .chart-container {
                height: 200px;
            }

            .card-body h5 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="container-fluid">
            <h1 class="mb-4">Advanced Responsive Dashboard</h1>

            <!-- Section 1: Sales -->
            <div class="section-header">Sales Overview</div>
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-line"></i> Monthly Revenue
                        </div>
                        <div class="card-body">
                            <h5>$10,345</h5>
                            <p>Revenue for the current month</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-pie"></i> Sales by Category
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-bar"></i> Sales Performance
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Employee Stats -->
            <div class="section-header">Employee Stats</div>
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-users"></i> Total Employees
                        </div>
                        <div class="card-body">
                            <h5>1,245</h5>
                            <p>Employees currently in the system</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-tie"></i> Active Employees
                        </div>
                        <div class="card-body">
                            <h5>850</h5>
                            <p>Employees actively working</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-clock"></i> Employees On Leave
                        </div>
                        <div class="card-body">
                            <h5>120</h5>
                            <p>Employees currently on leave</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Analytics -->
            <div class="section-header">Analytics Overview</div>
            <div class="row mb-4">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i> Monthly Revenue (Line Chart)
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-bar"></i> Sales Performance (Bar Chart)
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Recent Activities -->
            <div class="section-header">Recent Activities</div>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-table"></i> Latest Updates
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Activity</th>
                                        <th>User</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Updated profile</td>
                                        <td>Imam</td>
                                        <td>2025-01-15</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Created new task</td>
                                        <td>Intan</td>
                                        <td>2025-01-16</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Approved report</td>
                                        <td>Fara</td>
                                        <td>2025-01-17</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Assigned new project</td>
                                        <td>Rita</td>
                                        <td>2025-01-18</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="footer">
        &copy; 2025 Your Company | All rights reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Line Chart - Monthly Revenue
        var lineCtx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Revenue ($)',
                    data: [1200, 1500, 1800, 1700, 2000, 2100, 2400],
                    borderColor: '#3f51b5',
                    backgroundColor: 'rgba(63, 81, 181, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '$' + context.raw;
                            }
                        }
                    }
                },
            }
        });

        // Bar Chart - Sales by Category
        var barCtx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Product A', 'Product B', 'Product C', 'Product D'],
                datasets: [{
                    label: 'Sales',
                    data: [500, 800, 300, 650],
                    backgroundColor: '#007bff',
                    borderColor: '#0056b3',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Pie Chart - Market Share
        var pieCtx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Product A', 'Product B', 'Product C'],
                datasets: [{
                    data: [50, 30, 20],
                    backgroundColor: ['#4caf50', '#ff9800', '#2196f3'],
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
</body>

</html>