@extends('layouts.starlight')

@section('subcategory')
active
@endsection

@section('title')
subcategory
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
              <div class="col-lg-6">
                  <div class="card">
                      <div class="card-header">sub category edit</div>
                      <div class="card-body">
                        <form action="{{ url('/subcategory/update') }}" method="POST">
                                @csrf

                                <input type="text" name="subcategory_id" value="{{ $subcategories->id }}">
                            <select class="form-select form-control" name="category_id"  aria-label="Default select example">

                                <option >--category name--</option>
                                @foreach ($categories as $category)
                                <option {{ $subcategories->category_id == $category->id?'selected':'' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                              </select>

                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">subcategory Name</label>
                              <input type="text" value="{{$subcategories->subcategory_name}}" name="subcategory_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                            </div>




                            <button type="submit" class="btn btn-primary">update</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    </div>
</div>

@endsection
