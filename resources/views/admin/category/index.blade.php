@extends('layouts.starlight')

@section('category')
active
@endsection

@section('title')
category
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
                <div class="col-lg-9">

                    <div class="card">
                        <div class="card-header">Category List</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>SL</th>
                                    <th>Category_name</th>
                                    <th>Added By</th>
                                    <th>created at</th>
                                    <th>action</th>
                                </tr>

                                @foreach ($categories as $category_list)

                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $category_list->category_name }}</td>
                                    <td>{{App\Models\user::find($category_list->added_by)->name}}</td>
                                    <td>{{ $category_list->created_at->diffForHumans() }}</td>
                                    <td><a href="{{ url('/category/delete/')}}/{{$category_list->id}}" class="btn btn-danger">Delete</a></td>
                                </tr>
                                @endforeach

                            </table>
                            @if (session('delsuccess'))
                            <div class="alert alert-success">
                            {{ session('delsuccess')}}
                            </div>
                        @endif
                            @if($categories->count()==0)
                            <div class="alert alert-warning text-center">
                              no data found
                            </div>
                              @endif


                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg-warning">Add Category</div>
                        @if(session('success'))
                        <div class="alert alert-danger mt-2">
                                {{ session('success') }}
                        </div>
                        @endif
                        <div class="card-body">


                            <form action="{{ url('/category/insert') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label"></label>

                                  <input type="text" class="form-control" placeholder="Enter Your Category Name" name="category_name">
                                </div>

                                @error('category_name')
                                <div class="alert alert-danger">
                                 {{ $message }}

                                </div>
                                @enderror


                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->


@endsection
