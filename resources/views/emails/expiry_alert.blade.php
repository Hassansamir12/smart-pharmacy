<h2>Expiry Alert Report</h2>

<p>Expired: {{ $expiredCount }}</p>
<p>Expiring soon ({{ $days }} days): {{ $soonCount }}</p>

<h3>Expired batches</h3>
<ul>
@forelse($expired as $b)
    <li>{{ $b->medicine->name }} | Exp: {{ $b->expiry_date }} | Qty: {{ $b->quantity }}</li>
@empty
    <li>None</li>
@endforelse
</ul>

<h3>Expiring soon</h3>
<ul>
@forelse($soon as $b)
    <li>{{ $b->medicine->name }} | Exp: {{ $b->expiry_date }} | Qty: {{ $b->quantity }}</li>
@empty
    <li>None</li>
@endforelse
</ul>
