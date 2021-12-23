@extends('layouts.starlight')

@section('title')
   edit
@endsection

@section('content')
@include('layouts.nav')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <a class="breadcrumb-item" href="index.html">Pages</a>
      <span class="breadcrumb-item active">Blank Page</span>
    </nav>

    <div class="sl-pagebody">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                        @endif
                    <form action="{{ url('/product/update/') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" value="{{ $product_details->id }}" name="product_info" class="form-control">
                         <div class="mb-3">
                            <label for="exampleInputEmail1"  class="form-label">category name</label>

                            <select class="form-control" name="category_id" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                @foreach ( $category_info as $category_information )
                                <option {{$product_details->category_id== $category_information->id?'selected':'' }} value="{{ $category_information->id }}">{{ $category_information->category_name }}</option>
                                @endforeach
                              </select>


                         </div>
                         <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">subcategory name</label>

                            <select class="form-control" name="subcategory_id" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                @foreach ( $subcategory_info as $subcategory_information )
                                <option  {{ $product_details->subcategory_id == $subcategory_information->id?'selected':'' }}   value="{{ $subcategory_information->id }}">{{$subcategory_information->subcategory_name }}</option>
                                @endforeach
                              </select>


                         </div>

                         <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">product name</label>
                            <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" value="{{  $product_details->product_name }}" aria-describedby="emailHelp">

                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">product price</label>
                            <input type="text" class="form-control" name="product_price" id="exampleInputEmail1" value="{{ $product_details->product_price }}" aria-describedby="emailHelp">

                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">product desp</label>
                            <input type="text" class="form-control" name="product_desp" id="exampleInputEmail1" value="{{ $product_details->product_desp }}" aria-describedby="emailHelp">

                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">product quantity</label>
                            <input type="text" class="form-control" name="product_quantity" id="exampleInputEmail1" value="{{ $product_details->product_quantity }}" aria-describedby="emailHelp">

                          </div>

                          <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">old product</label>
                              <img class="w-25" src="{{ asset('uploads/product/') }}/{{ $product_details->product_photo }}" alt="">
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">product photo</label>
                            <input type="file" class="form-control" name="product_photo"  oninput="pic.src=window.URL.createObjectURL(this.files[0])" >
                            <img class="w-25" id="pic" />
                          </div>

                        <button type="submit" class="btn btn-primary">update</button>
                      </form>
                      @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>

                      @endif

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
