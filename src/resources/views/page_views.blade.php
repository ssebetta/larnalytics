<!-- src/resources/views/page_views.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - Larnalytics</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #6a0dad;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .table thead {
            background-color: #6a0dad;
            color: #fff;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #e9ecef;
        }
        .visits-count {
            font-size: 2em;
            font-weight: bold;
            color: #6a0dad;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .text-purple { color: #6a0dad !important; }
        .flip {
            animation: flipInY 3.5s ease;
        }
        @keyframes flipInY {
            from {
                transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
                animation-timing-function: ease-in;
                opacity: 0;
            }
            40% {
                transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
                animation-timing-function: ease-in;
            }
            60% {
                transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
                opacity: 1;
            }
            80% {
                transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
            }
            to {
                transform: perspective(400px);
            }
        }
        .chart-container { position: relative; height: 50vh; width: 100vw; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Larnalytics</a>
    </nav>

    <div class=" mt-4">
        <div class="text-center">
            <h3 class="mb-3">{{ config('app.name') }}</h3>
            <p id="visitsCount" class="visits-count">{{ $totalPageViews }} visits</p>
        </div>

        <ul class="nav nav-tabs mt-3" id="pageViewTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-purple" id="tab24hrs-tab" data-toggle="tab" href="#tab24hrs" role="tab" aria-controls="tab24hrs" aria-selected="true">Last 24 Hours</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-purple" id="tabPastWeek-tab" data-toggle="tab" href="#tabPastWeek" role="tab" aria-controls="tabPastWeek" aria-selected="false">Past Week</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-purple" id="tabPastMonth-tab" data-toggle="tab" href="#tabPastMonth" role="tab" aria-controls="tabPastMonth" aria-selected="false">Past Month</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-purple" id="tabPastYear-tab" data-toggle="tab" href="#tabPastYear" role="tab" aria-controls="tabPastYear" aria-selected="false">Past Year</a>
            </li>
        </ul>
        <div class="tab-content mt-3" id="pageViewTabsContent">
            <div class="tab-pane fade show active" id="tab24hrs" role="tabpanel" aria-labelledby="tab24hrs-tab">
                <div class="d-flex justify-content-center align-items-center" style="min-height: 400px;">
                    <canvas id="last24HoursChart"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="tabPastWeek" role="tabpanel" aria-labelledby="tabPastWeek-tab">
                <div class="d-flex justify-content-center align-items-center" style="min-height: 400px;">
                    <canvas id="lastWeekChart"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="tabPastMonth" role="tabpanel" aria-labelledby="tabPastMonth-tab">
                <div class="d-flex justify-content-center align-items-center" style="min-height: 400px;">
                    <canvas id="lastMonthChart"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="tabPastYear" role="tabpanel" aria-labelledby="tabPastYear-tab">
                <div class="d-flex justify-content-center align-items-center" style="min-height: 400px;">
                    <canvas id="lastYearChart"></canvas>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <h3 class="">Devices</h3>
            <div class="col-lg-8 chart-container mt-3">
                <canvas id="deviceChart"></canvas>
            </div>
        </div>
        <table class="table table-responsive table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Page URL</th>
                    <th>Viewed At</th>
                    <th>IP Address</th>
                    <th>Location</th>
                    <th>User Agent</th>
                    <th>Device</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pageViews as $view)
                    <tr>
                        <td>{{ $view->id }}</td>
                        <td>{{ $view->user_id }}</td>
                        <td>{{ $view->page_url }}</td>
                        <td>{{ $view->viewed_at }}</td>
                        <td>{{ $view->ip_address }}</td>
                        <td>{{ $view->location }}</td>
                        <td>{{ $view->user_agent }}</td>
                        <td>{{ $view->device }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $pageViews->links() }}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // page_views.js

        document.addEventListener('DOMContentLoaded', function () {
            var pageViewTabs = new bootstrap.Tab(document.getElementById('pageViewTabs'));
            var tabContent = document.getElementById('pageViewTabsContent');

            // Handle tab click event
            pageViewTabs.show();

            // Render charts based on active tab
            document.querySelectorAll('.nav-link').forEach(function (tab) {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();
                    var tabId = this.getAttribute('href').replace('#', '');
                });
            });
        });
    </script>
    <script>
        const last24HoursData = {!! json_encode($last24HoursData) !!};
        const lastWeekData = {!! json_encode($lastWeekData) !!};
        const lastMonthData = {!! json_encode($lastMonthData) !!};
        const lastYearData = {!! json_encode($lastYearData) !!};
        const deviceData = {!! json_encode($deviceData) !!};

        const last24HoursCtx = document.getElementById('last24HoursChart').getContext('2d');
        new Chart(last24HoursCtx, {
            type: 'line',
            data: {
                labels: last24HoursData.labels,
                datasets: [{
                    label: 'Last 24 Hours',
                    data: last24HoursData.data,
                    backgroundColor: 'rgba(106, 13, 173, 0.2)',
                    borderColor: 'rgba(106, 13, 173, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const lastWeekCtx = document.getElementById('lastWeekChart').getContext('2d');
        new Chart(lastWeekCtx, {
            type: 'line',
            data: {
                labels: lastWeekData.labels,
                datasets: [{
                    label: 'Last Week',
                    data: lastWeekData.data,
                    backgroundColor: 'rgba(106, 13, 173, 0.2)',
                    borderColor: 'rgba(106, 13, 173, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const lastMonthCtx = document.getElementById('lastMonthChart').getContext('2d');
        new Chart(lastMonthCtx, {
            type: 'bar',
            data: {
                labels: lastMonthData.labels,
                datasets: [{
                    label: 'Last Month',
                    data: lastMonthData.data,
                    backgroundColor: 'rgba(106, 13, 173, 0.2)',
                    borderColor: 'rgba(106, 13, 173, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const lastYearCtx = document.getElementById('lastYearChart').getContext('2d');
        new Chart(lastYearCtx, {
            type: 'bar',
            data: {
                labels: lastYearData.labels,
                datasets: [{
                    label: 'Last Year',
                    data: lastYearData.data,
                    backgroundColor: 'rgba(106, 13, 173, 0.2)',
                    borderColor: 'rgba(106, 13, 173, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const deviceCtx = document.getElementById('deviceChart').getContext('2d');
        new Chart(deviceCtx, {
            type: 'doughnut',
            data: {
                labels: deviceData.labels,
                datasets: [{
                    label: 'Devices',
                    data: deviceData.data,
                    backgroundColor: [
                        'rgba(106, 13, 173, 0.2)',
                        'rgba(106, 13, 173, 0.4)',
                        'rgba(106, 13, 173, 0.6)'
                    ],
                    borderColor: [
                        'rgba(106, 13, 173, 1)',
                        'rgba(106, 13, 173, 1)',
                        'rgba(106, 13, 173, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        // Add flip animation on page load
        window.onload = function() {
            document.getElementById('visitsCount').classList.add('flip');
        }
    </script>
</body>
</html>
