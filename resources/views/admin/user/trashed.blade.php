@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table>
            <thead>
                <tr>
                    <th>prefixname</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users as $user)
                  <tr>
                    <td>{{ $user->prefixname}}</td>
                    <td>{{ $user->fullname}}</td>
                    <td>{{ $user->email}}</td>
                    <td>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#myModal{{$user->id}}">
                            Restore
                        </button>
                    </td>
                  </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- The Modal -->
@foreach($users as $user)
<div class="modal" id="myModal{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Are you sure?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <form method="post" action="{{ route('users.restore', $user->id) }}">
                    @csrf
                    {{ method_field('PATCH')}}
                    <button class="btn btn-danger">
                        Restore
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
