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
    <table class="table table-responsive table-striped table-bordered">
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
<script>
    // Add flip animation on page load
    window.onload = function() {
        document.getElementById('visitsCount').classList.add('flip');
    }
</script>
</body>
</html>
