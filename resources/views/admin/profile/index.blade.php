@extends('layouts.starlight')

@section('title')
edit profile
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">

                        <form action="{{ url('/profile/update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1"class="form-label">name</label>
                              <input type="text"  name="name"  class="form-control" value="{{ Auth::user()->name }}">

                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">

                              </div>

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                          </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Edit Password</div>
                    <div class="card-body">

                        <form action="{{ url('/profile/passchange') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1"class="form-label">old password</label>
                              <input type="password"  name="old_password"  class="form-control"">
                                @error('old_password')
                                <strong class="text-danger">{{ $message }}</strong>

                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1"class="form-label">new password</label>
                                <input type="password"  name="password"  class="form-control" >
                                @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputEmail1"class="form-label">password confirmation</label>
                                <input type="password"  name="password_confirmation"  class="form-control" >
                                    @error('password_confirmation')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                              </div>

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                          </form>
                            @if(session('uppass'))
                            <div class="alert alert-danger">
                                {{ session('uppass') }}
                            </div>

                            @endif
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Edit profile photo</div>
                    <div class="card-body">

                        <form action="{{ url('/profile/photochange') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="mb-3">
                                <label for="exampleInputEmail1"class="form-label">your photo</label>
                                <img class="w-25" src="{{asset('uploads/profile/')}}/{{ Auth::user()->profile_photo }}" alt="">

                              </div>


                              <div class="mb-3">
                                <label for="exampleInputEmail1"class="form-label">profile photo</label>
                                <input  type="file"  name="profile_photo"  class="form-control " oninput="pic.src=window.URL.createObjectURL(this.files[0])" >
                                <img class="w-25" id="pic" />

                                @error('profile_photo')

                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>

                                @enderror
                              </div>

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                          </form>

                    </div>
                </div>
            </div>
        </div>
       </div>

    </div>
</div>



@endsection



