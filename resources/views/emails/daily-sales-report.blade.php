<h2>Daily Sales Report</h2>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity Sold</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->quantity }}</td>
                <td>${{ number_format($row->total, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
