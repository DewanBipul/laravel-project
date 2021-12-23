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
        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">subcategory list </div>
                <div class="div">
                    <input type="checkbox" id="checkAll"> Mark All
                </div>
                <form action="{{ url('/subcategory/markdelete') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if(session('subcategorymsg'))
                        <div class="alert alert-danger">
                            {{ session('subcategorymsg') }}
                        </div>
                        @endif
                        <table class="table table-striped">
                            <tr>
                                <th>marked</th>
                                <th>id</th>
                                <th>category name</th>
                                <th>sub-category name</th>
                                <th>created at</th>
                                <th>action</th>

                            </tr>
                            @forelse ($subcategories as $subcategory )
                            <td><input class="checkItem" type="checkbox" name="marked_delete[]" value="{{ $subcategory->id }}"></td>
                            <td>{{ $subcategory->id }}</td>
                            <td>{{ App\Models\category::find($subcategory->category_id)->category_name }}</td>
                            <td>{{ $subcategory->subcategory_name }}</td>
                            <td>
                                @if($subcategory->created_at->DiffInDays(\carbon\carbon::today()) > 30)
                                {{ $subcategory->created_at->format('d/m/y h.i.s a')}}

                                @else
                                {{ $subcategory->created_at->diffForHumans() }}

                                @endif
                            </td>
                            <td>
                                <a href="{{url('/subcategory/delete')}}/{{ $subcategory->id }}" class="btn btn-danger">Delete</a>
                                <a href="{{ url('/subcategory/edit') }}/{{ $subcategory->id }}" class="btn btn-success">Edit</a>
                            </td>

                            </tr>

                            @empty
                            <div class="alert alert-danger">
                                Data Not Found
                            </div>
                            @endforelse
                        </table>
                        <button type="submit" class="btn btn-success">Marked Delete</button>
                    </div>
                </form>
            </div>


            <div class="card my-4">
                <div class="card-header"> trashed list </div>
                <form action="{{ url('/trashed/markall') }}" method="POST">
                @csrf
                    <div class="card-body">
                        @if(session('subcategorymsg'))
                        <div class="alert alert-danger">
                            {{ session('subcategorymsg') }}
                        </div>
                        @endif
                        <table class="table table-striped">
                            <div class="div">
                                <input type="checkbox" id="checkedall"> Mark All
                            </div>
                            <tr>
                                <th>marked</th>
                                <th>id</th>
                                <th>category name</th>
                                <th>sub-category name</th>
                                <th>created at</th>
                                <th>action</th>

                            </tr>
                            @forelse ($deleted_subcategory as $deletesubcategory )
                            <td><input type="checkbox" name="markdelete[]" value="{{$deletesubcategory->id }}" class="checkedtem"></td>
                            <td>{{ $deletesubcategory->id }}</td>
                            <td>{{ App\Models\category::find($deletesubcategory->category_id)->category_name }}</td>
                            <td>{{ $deletesubcategory->subcategory_name }}</td>
                            <td>{{ $deletesubcategory->created_at->diffForHumans() }}</td>
                            <td class="d-flex">
                                <a href="{{url('/subcategory/restore')}}/{{ $deletesubcategory->id }}" class="btn btn-success mr-2">restore</a>
                                <a href="{{ url('/subcategory/perdelete')}}/{{ $deletesubcategory->id}}" class="btn btn-danger">Delete</a>


                            </td>

                            </tr>



                            @empty
                            <div class="alert alert-danger">
                                Data Not Found
                            </div>
                            @endforelse
                        </table>
                        @if (session('perdelete'))
                        <div class="alert alert-success">
                            {{ session('perdelete') }}
                        </div>

                        @endif
                      <button type="submit" value="markrestore" name="markrestore" class="btn btn-success">restore</button>
                      <button type="submit" value="markdelete" name="trashdelete" class="btn btn-danger">mark delete</button>
                    </div>
                </form>

            </div>

        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Add Subcategory</div>
                <div class="card-body">

                    <form action="{{ url('/category/subcategory') }}" method="Post">
                        @csrf

                        <div class="mb-3">
                            <select name="category_id" class="form-control" ">
                                <option  value="">--SELECT CATEGORY--</option>
                                @foreach ($categories as $category )
                                <option {{ old('category_id') == $category->id?'selected':'' }} value="{{ $category->id }}">{{ $category->category_name }}</option>

                                @endforeach
                              </select>
                              @error('category_id')
                              <div class="alert alert-danger">
                                  {{ $message }}
                              </div>
                          @enderror
                        </div>

                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">subcategory name</label>
                          <input value="{{old('subcategory_name')}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="subcategory_name">

                             </div>
                             @error('subcategory_name')
                             <div class="alert alert-danger">
                                 {{ $message }}
                             </div>
                             @enderror


                        <button type="submit" class="btn btn-primary">Submit</button>


                      </form>

                      @if (session('success'))
                      <div class="alert alert-danger mt-3">
                          {{ session('success') }}
                      </div>
                  @endif




                </div>
            </div>
        </div>
    </div>
</div>

</div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
@endsection

@section('footer_script')
    <script>
 $('#checkAll').click(function () {
    $(':checkbox.checkItem').prop('checked', this.checked);
});

    </script>

<script>
    $('#checkedall').click(function () {
       $(':checkbox.checkedtem').prop('checked', this.checked);
   });

       </script>

@endsection
