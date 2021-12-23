@extends('frontend.main')


@section('content')

      <!-- .breadcumb-area start -->
      <div class="breadcumb-area bg-img-4 ptb-100">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcumb-wrap text-center">
                          <h2>{{ $category_name }}</h2>
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
        <div class="row">



          @foreach ($category_products  as $products)
          @include('frontend.part.product_list',['shopproducts'=>$products])

          @endforeach






        </div>



    </div>
</div>
<!-- product-area end -->
@endsection
