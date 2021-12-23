@extends('frontend.main')


@section('content')

      <!-- .breadcumb-area start -->
      <div class="breadcumb-area bg-img-4 ptb-100">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcumb-wrap text-center">
                          <h2>search result</h2>
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
  <!-- product-area start -->
  <div class="product-area pt-100">
    <div class="container">



                <ul class="row">
                    @forelse(  $search_product as $shopproducts )
                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                        <div class="product-wrap">
                            <div class="product-img">
                                <span>Sale</span>
                                <img src="{{ asset('uploads/product') }}/{{ $shopproducts->product_photo }}" alt="">
                                <div class="product-icon flex-style">
                                    <ul>
                                        <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                 <h3><a href="{{ url('/product/details') }}/{{ $shopproducts->id }}">{{ $shopproducts->product_name }}</a></h3>
                                <p class="pull-left">BDT: {{ $shopproducts->product_price }}  </p>
                                <ul class="pull-right d-flex">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-half-o"></i></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @empty
                   <div class="alert alert-danger">
                       Data Not found
                   </div>
                    @endforelse
                </ul>




        </div>



    </div>
</div>
<!-- product-area end -->
@endsection
