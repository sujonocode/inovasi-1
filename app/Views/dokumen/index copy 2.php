<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ03K5DL2wI7j9Q6BPM69U+P69FcZXGV2XlG19IHqhPHQ7OG5xw5ya5ojOjp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }

        .navbar {
            background-color: #5c6bc0;
        }

        .navbar-brand {
            color: white;
        }

        .sidebar {
            height: 100%;
            background-color: #283593;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 240px;
            padding-top: 20px;
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            font-size: 1.1rem;
        }

        .sidebar .nav-link:hover {
            background-color: #3f51b5;
            border-radius: 4px;
        }

        .content {
            margin-left: 240px;
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

        .footer {
            position: fixed;
            bottom: 0;
            left: 240px;
            right: 0;
            background-color: #283593;
            color: white;
            padding: 15px 20px;
            text-align: center;
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

        .mb-4 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
    </nav>

    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Analytics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Reports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Settings</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid">
            <h1 class="mb-4">Dashboard Overview</h1>

            <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-users"></i> Total Users
                        </div>
                        <div class="card-body">
                            <h5>1,245</h5>
                            <p>Users registered in the system</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-line"></i> Revenue
                        </div>
                        <div class="card-body">
                            <h5>$10,345</h5>
                            <p>Monthly revenue</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-cogs"></i> Active Tasks
                        </div>
                        <div class="card-body">
                            <h5>35</h5>
                            <p>Tasks currently in progress</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-bell"></i> Notifications
                        </div>
                        <div class="card-body">
                            <h5>18</h5>
                            <p>New notifications</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-bar"></i> Sales by Category (Bar Chart)
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="barChart"></canvas>
                            </div>
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
    </script>
</body>

</html>