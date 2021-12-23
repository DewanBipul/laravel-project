@extends('frontend.main')


@section('content')

      <!-- .breadcumb-area start -->
      <div class="breadcumb-area bg-img-4 ptb-100">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcumb-wrap text-center">
                          <h2>Cart Details</h2>
                          <ul>
                              <li><a href="index.html">Home</a></li>
                              <li><span>Shop</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- .breadcumb-area end -->


      <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ url('/cart/update') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $total = 0;
                                    $stock_out_product = true;
                                @endphp


                               @forelse( $cart_details as $cart )


                                <tr>
                                    <td width="40" class="images"><img src="{{ asset('/uploads/product') }}/{{ App\Models\product::find($cart->product_id)->product_photo }}" alt=""></td>
                                    <td class="product"><a href="single-product.html">{{ App\Models\product::find($cart->product_id)->product_name }}</a>
                                        @if($cart->product_quantity > App\Models\product::find($cart->product_id)->product_quantity)
                                            <div class="badge badge-warning">stock out</div>

                                           @php
                                                $stock_out_product = false;

                                           @endphp
                                        @endif


                                    <div class="badge badge-success">IN STOCK : {{ App\Models\product::find($cart->product_id)->product_quantity }}</div>
                                    </td>
                                    <td class="ptice">{{ App\Models\product::find($cart->product_id)->product_price * $cart->product_quantity }}</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" name="product_quantity[{{ $cart->id }}]" value="{{ $cart->product_quantity }}" />
                                    </td>
                                    <td class="total">{{ App\Models\product::find($cart->product_id)->product_price * $cart->product_quantity}}</td>
                                    <td class="remove"><a href="{{ url('cart/delete/') }}/{{ $cart->id }}"><i class="fa fa-times"></a></i></td>
                                </tr>

                                @php
                                    $total = $total+(App\Models\product::find($cart->product_id)->product_price * $cart->product_quantity)
                                @endphp

                                @empty

                                No Product To show

                                @endforelse

                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>

                                    </form>
                                        <li><a href="{{ url('/shopproduct') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" id="coupon_name" placeholder="Cupon Code">
                                        <button type="button" id="coupon_btn">Apply Cupon</button>

                                        @if (session('expired'))
                                        <div class="alert alert-warning">
                                            {{ session('expired') }}
                                        </div>

                                        @endif

                                        @if (session('invalid_coupon'))
                                        <div class="alert alert-warning">
                                       {{ session('invalid_coupon') }}
                                        </div>

                                        @endif

                                    </div>



                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left"> Total</span>{{   $total }}</li>
                                        <li><span class="pull-left"> discount({{ $discount }}%)</span>{{($total/100)* $discount }}</li>
                                        <li><span class="pull-left">  Subtotal </span>{{ $total - ($total/100)*$discount }}</li>
                                    </ul>


                                   @php
                                       session([
                                       'total_from_cart'=>$total,
                                       'discount_from_cart'=>($total/100)*$discount,
                                ]);
                                   @endphp

                                    @if ( $stock_out_product  )
                                    <a href="{{url('/checkout')}}">Proceed to Checkout</a>
                                    @else
                                   <div class="alert alert-warning">some product is stock out</div>
                                    @endif

                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->

      @endsection

      @section('footer_script')
        <script>

            $('#coupon_btn').click(function(){

                var coupon_value = $('#coupon_name').val();
                var current_link = "{{ url('/cart') }}";

                var link_to_go = current_link+'/'+coupon_value;
                window.location.href = link_to_go;
            });
        </script>
      @endsection


