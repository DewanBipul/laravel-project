
@extends('frontend.main')

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->

@auth


@if(auth::user()->roll==1)

<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                    <form action="{{url('/order/confirm')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <p>Full Name *</p>
                                <input type="text" name="name" value="{{ auth::user()->name }}">
                            </div>

                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" name="email" value="{{auth::user()->email}}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input name="phone" type="text">
                            </div>
                            <div class="col-6">
                               <select name="country_id" id="country_select" class="js-example-basic-single">
                                   <option ">--select country--</option>
                                   @foreach ( $countries  as $country )
                                   <option value="{{ $country->id }}">{{ $country->name }}</option>
                                   @endforeach

                               </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Town/City *</p>
                                <select name="city_id" id="select_city" class="js-example-basic-single">
                                    <option value="">---select city--</option>
                                </select>

                            </div>
                            <div class="col-6">
                                <p>Your Address *</p>
                                <input name="address" type="text">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input name="post_code" type="text">
                            </div>



                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="order_note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">

                        <li>Total<span class="pull-right" name="total">{{ session('total_from_cart') }}</span></li>
                        <li>discount <span class="pull-right" name="discount">{{ session('discount_from_cart') }}</span></li>
                        <li>Subtotal <span class="pull-right" name="subtotal"><strong>{{ session('total_from_cart') - session('discount_from_cart') }}</strong></span></li>
                    </ul>
                    <ul class="payment-method" >

                        <li>
                            <input value="1" id="delivery" type="radio" name="payment_method">
                            <label  for="delivery">Cash on Delivery</label>
                        </li>

                        <li>
                            <input value="2" id="delivery" type="radio" name="payment_method">
                            <label  for="delivery">payment with sslcommerce</label>
                        </li>

                        <li>
                            @if(session('payment'))
                            <div class="alert alert-warning">
                                {{ session('payment') }}
                            </div>
                            @endif
                        </li>

                    </ul>
                    <button type="submit">Place Order</button>
                </form>
                </div>
            </div>

        </div>
    </div>
</div>

@else
<div class="container">
    <div class="row">
        <div class="col-lg-4 m-auto">
            <div class="my-5">
                <div class="alert alert-danger">
                    you are not customar <a class="btn btn-success" href="{{ url('/') }}">Go Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

@else
<div class="container">
    <div class="row">
        <div class="col-lg-4 m-auto">
            <div class="my-5 ">
     <div class="alert alert-danger">Please Login------> <a class="btn btn-success" href="{{ url('/login') }}">Login</a></div>
   </div>
        </div>
    </div>
</div>
@endauth

<!-- checkout-area end -->
@endsection

@section('footer_script')
<script>
    $(document).ready(function(){
    $('.js-example-basic-single').select2();
    });


$('#country_select').change(function(){
    var country_id = $('#country_select').val();


            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
           });

           $.ajax({

            type:'POST',
            url:'/getcitylist',
            data:{country_id:country_id},
            success:function(data){

                $('#select_city').html(data);

                }

        });

        });

</script>
@endsection






 });





