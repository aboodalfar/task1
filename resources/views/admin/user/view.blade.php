@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('users.index')}}"><button style="margin-bottom: 10px" class="btn btn-sm btn-primary">Back to Lists</button></a>
            <div class="card">
                <div class="card-body">
                    <p>
                        prefixname : {{ $user->prefixname}}
                    </p>
                    <p>
                        Name : {{ $user->fullname}}
                    </p>
                    <p>
                        User Name : {{ $user->username}}
                    </p>
                    <p>
                        Email : {{ $user->email}}
                    </p>
                    <p>
                        Photo : <img src="{{ $user->photo}}" />
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
