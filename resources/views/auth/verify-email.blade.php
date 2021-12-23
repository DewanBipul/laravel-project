@extends('layouts.starlight')
@extends('layouts.nav')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    email varfication
                </div>
                <div class="card-body">
                    <form action="{{ Route('verification.send') }}" method="POST">
                        <input type="text" class="form-control">

                        <button type="submit" class="btn btn-primary">send Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
