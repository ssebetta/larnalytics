<!-- src/resources/views/custom_events.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Custom Events</title>
</head>
<body>
    <h1>Custom Events</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Event Name</th>
                <th>Event Data</th>
                <th>Occurred At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customEvents as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ json_encode($event->event_data) }}</td>
                    <td>{{ $event->occurred_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
