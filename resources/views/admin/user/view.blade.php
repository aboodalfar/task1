@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
@endsection
