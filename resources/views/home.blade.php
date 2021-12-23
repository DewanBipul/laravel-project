@extends('layouts.starlight')

@section('dashboard')
active
@endsection

@section('title')
home
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

    <div class="container">
    @if(auth::user()->roll != 1)




        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Logged By :{{ $logged_user }}</h1>
                    </div>
                    <div class="alert alert-info text-center">
                        <h1>{{ $total_user }}</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                           <table class="table table-striped" >
                               <tr>
                                   <th>id</th>
                                   <th>name</th>
                                   <th>email</th>
                                   <th>created at</th>
                               </tr>
                              @foreach ( $users as $index=>$user_info )
                              <tr>
                                <td>{{ $users->firstitem()+$index}}</td>
                                <td>{{ $user_info->name }}</td>
                                <td>{{ $user_info->email }}</td>
                                <td>{{ $user_info->created_at->diffForHumans()}}</td>

                            </tr>
                              @endforeach

                           </table>

                           {{ $users->links() }}


                    </div>
                </div>
            </div>
            <div class="col-lg-4 btn-info">
                <form action="{{ url('/user/insert') }}" method="POST" >
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Your Name">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Your email">

                      </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Enter your Password">
                    </div>

                    <div class="mb-3">
                        <div class="form-control">
                       <select class="form-control" name="roll" >
                     <option value="1">Customar</option>
                     <option value="2">Admin</option>
                     <option value="3">modarator</option>
                     </select>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning m-auto">Submit</button>
                  </form>
            </div>
        </div>

        @elseif(auth::user()->roll==1)



        @include('admin.parts.customar')

        @endif

    </div>



    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

@endsection
