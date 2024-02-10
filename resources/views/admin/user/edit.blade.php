@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('users.index')}}"><button style="margin-bottom: 10px" class="btn btn-sm btn-primary">Back to Lists</button></a>

            <div class="card">
            <div class="card-header">Update record of {{ucwords($user->fullname)}}</div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{route('users.update',['id'=> $user->id])}}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="@if( old('firstname') ){{ old('firstname')}}@else{{ $user->firstname }}@endif" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="@if( old('middlename') ){{ old('middlename')}}@else{{ $user->middlename }}@endif" required autocomplete="middlename" autofocus>

                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="@if( old('lastname') ){{ old('lastname')}}@else{{ $user->lastname }}@endif" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if( old('email') ){{ old('email')}}@else{{ $user->email }}@endif" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username"  class="form-control @error('username') is-invalid @enderror" name="username" value="@if( old('username') ){{ old('username')}}@else{{ $user->username }}@endif" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Update Password
                            <input style="margin-left: 10px; cursor: pointer" title="Update {{ucwords($user->name)}}'s' Password?" onClick="togglePassword()" type="checkbox" name="changePassword" id="changePassword"></label>

                            <div class="col-md-6">
                                <input id="password" style="display: none" placeholder="Type in new Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">Photo</label>
                            <div class="col-md-6">
                                <input class="form-control" name="photo" type="file" id="photo">
                            </div>
                        </div>

                     <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" onclick="return confirm('Are you sure you want to update {{ucwords($user->name)}}\'s account?')" class="btn btn-success">
                                   Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

function togglePassword()
{

    if ($("#changePassword").is(':checked')) {
           $('#password').show();
        } else {
            $('#password').hide();
        }
}
</script>
@endsection
