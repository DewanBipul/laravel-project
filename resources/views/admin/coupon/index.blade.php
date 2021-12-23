@extends('layouts.starlight')

@section('coupon')
active
@endsection

@section('title')
coupon
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
                                    <th>Coupon_name</th>
                                    <th>coupon_discount</th>
                                    <th>coupon_validity</th>
                                    <th>created at</th>
                                    <th>action</th>
                                </tr>
                                        @foreach ( $coupon as $coupon )
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $coupon->coupon_name }}</td>
                                            <td>{{ $coupon->coupon_discount }}</td>
                                            <td>{{ $coupon->coupon_validity }}</td>
                                            <td>{{ $coupon->created_at }}</td>
                                            <td><a class="btn btn-danger" href="#">Delete</a></td>
                                        </tr>
                                        @endforeach




                            </table>



                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg-warning">Add Category</div>
                        @if(session('coupon'))
                        <div class="alert alert-danger mt-2">
                                {{ session('coupon') }}
                        </div>
                        @endif
                        <div class="card-body">


                            <form action="{{ url('/coupon/insert') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label">coupon name</label>

                                  <input type="text" class="form-control" placeholder="Enter Your Coupon name" name="coupon_name">
                                </div>

                                @error('coupon_name')
                                <div class="alert alert-danger">
                                 {{ $message }}

                                </div>
                                @enderror

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">coupon discount</label>

                                    <input type="text" class="form-control" placeholder="Enter Your Category parcentage" name="coupon_discount">
                                  </div>

                                  @error('category_percentage')
                                  <div class="alert alert-danger">
                                   {{ $message }}

                                  </div>
                                  @enderror

                                  <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">coupon validity</label>

                                    <input type="date" class="form-control" placeholder="Enter Your coupon validity" name="coupon_validity">
                                  </div>

                                  @error('coupon_validity')
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
