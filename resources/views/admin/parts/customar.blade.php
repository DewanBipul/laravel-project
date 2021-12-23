<div class="container">
    <div class="row">
        <div class="col-lg-8 m-auto pt-5">
            <div class="card">
                <div class="card-header"><h1>your order details</h1></div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>sl</th>
                            <th>total</th>
                            <th>discount</th>
                            <th>sub total</th>
                            <th>action</th>
                        </tr>

                            @foreach ($order_details as $order )
                            <tr>

                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->discount }}</td>
                            <td>{{ $order->subtotal }}</td>
                            <td><a target="_blank" href="{{ url('/invoice/dwonload') }}/{{ $order->id }}" class="btn btn-success">Dwonload</a></td>
                        </tr>
                            @endforeach


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

