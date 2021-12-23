<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1 >your order details</h1>

    <table bg="blue" width="400" cellspacing="0" cellpadding="0" align="center" border="1">
        <tr>
            <th>total</th>
            <th>discount</th>
            <th>subtotal</th>
            <th>product name</th>
        </tr>

        @foreach ( App\Models\order_details::where('order_id', $data->id)->get() as $order )

        <tr>
            <td>{{ $data->total }}</td>
            <td>{{ $data->discount }}</td>
            <td>{{ $data->subtotal }}</td>
            <td>{{ $order->product_name }}</td>

        </tr>
        @endforeach

    </table>

</body>
</html>
