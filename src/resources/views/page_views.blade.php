<!-- src/resources/views/page_views.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Page Views</title>
</head>
<body>
    <h1>Page Views</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
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
</body>
</html>