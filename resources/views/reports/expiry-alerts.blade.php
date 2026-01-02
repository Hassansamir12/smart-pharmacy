<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expiry Alerts</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin: 0 0 8px; }
        h3 { margin: 14px 0 6px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <h2>Expiry Alerts (Next {{ $days }} days)</h2>

    <h3>Expired ({{ $expired->count() }})</h3>
    <table>
        <thead>
        <tr>
            <th>Medicine</th>
            <th>Supplier</th>
            <th>Expiry</th>
            <th>Qty</th>
        </tr>
        </thead>
        <tbody>
        @forelse($expired as $b)
            <tr>
                <td>{{ $b->medicine->name }}</td>
                <td>{{ $b->supplier?->name ?? '—' }}</td>
                <td>{{ $b->expiry_date }}</td>
                <td>{{ $b->quantity }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No expired batches.</td></tr>
        @endforelse
        </tbody>
    </table>

    <h3>Expiring Soon ({{ $expiringSoon->count() }})</h3>
    <table>
        <thead>
        <tr>
            <th>Medicine</th>
            <th>Supplier</th>
            <th>Expiry</th>
            <th>Qty</th>
        </tr>
        </thead>
        <tbody>
        @forelse($expiringSoon as $b)
            <tr>
                <td>{{ $b->medicine->name }}</td>
                <td>{{ $b->supplier?->name ?? '—' }}</td>
                <td>{{ $b->expiry_date }}</td>
                <td>{{ $b->quantity }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No batches expiring soon.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
