@extends('layouts.starlight')

@section('title')

product

@endsection

@section('product')
active
@endsection

@section('content')

@include('layouts.nav')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <a class="breadcrumb-item" href="index.html">Pages</a>
      <span class="breadcrumb-item active">Blank Page</span>
    </nav>

    <div class="sl-pagebody">

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            product information
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>SL</th>
                                    <th>Category name</th>
                                    <th>subcategory name</th>
                                    <th>product name</th>
                                    <th>product desp</th>
                                    <th>product quantity</th>
                                    <th>product photo</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ( $product_info as $products )


                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ App\Models\category::find($products->category_id)->category_name }}</td>
                                    <td>{{ App\Models\subcategory::find($products->subcategory_id)->subcategory_name }}</td>
                                    <td>{{ $products->product_name }}</td>
                                    <td>{{ $products->product_desp }}</td>
                                    <td>{{ $products->product_quantity }}</td>
                                    <td>
                                        <img class="w-25" src="{{ asset('/uploads/product')}}/{{ $products->product_photo }}" alt="">
                                    </td>
                                    <td class="d-flex">
                                        <a class="btn btn-success " href="{{ url('/product/edit')}}/{{ $products->id }}">Edit</a>
                                        <a class="btn btn-danger " href="{{ url('/product/delete')}}/{{ $products->id }}">Delete</a>
                                    </td>

                                </tr>
                                @empty

                               <div class="alert alert-danger">
                                Data not found
                               </div>

                                @endforelse

                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 d-right">
                    <div class="card">
                        <div class="card-header">
                           add product list
                        </div>
                        <div class="card-body">
                            <form action="{{url('/product/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                               <div class="mb-3 ">
                                <label  class="form-label">category name</label>
                                <select class="form-control" name="category_id" aria-label="Default select example">
                                    <option >--Select Category--</option>
                                    @foreach ( $categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                                    @endforeach

                                  </select>
                               </div>
                                <div class="form-group mb-3">
                                    <label  class="form-label">subcategory name</label>
                                    <select class="form-control " name="subcategory_id" >
                                        <option >--subcategory--</option>
                                    @foreach ($subcategories as $subcategory )
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name  }}</option>
                                    @endforeach

                                </select>

                                  </div>

                                  <div class="mb-3">
                                    <label  class="form-label">product name</label>
                                    <input type="text" class="form-control" name="product_name">
                                  </div>

                                  <div class="mb-3">
                                    <label  class="form-label">product price</label>
                                    <input type="text" class="form-control" name="product_price">
                                  </div>

                                  <div class="mb-3">
                                    <label  class="form-label">product description</label>
                                    <input type="text" class="form-control" name="product_desp" >
                                  </div>

                                  <div class="mb-3">
                                    <label  class="form-label">product quantity</label>
                                    <input type="text" class="form-control" name="product_quantity" >
                                  </div>

                                  <div class="mb-3">
                                    <label  class="form-label">producct photo</label>
                                    <input type="file" class="form-control" name="product_photo" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                    <img class="w-25" id="pic" />
                                  </div>

                                  <div class="mb-3">
                                    <label  class="form-label">producct thumbnail</label>
                                    <input type="file" class="form-control" multiple name="product_thumbnails[]">

                                  </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                @if (session('product'))
                                <div class="alert alert-success">
                                    {{ session('product') }}
                                </div>

                                @endif
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>




@endsection


