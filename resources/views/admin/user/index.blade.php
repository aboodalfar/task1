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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users as $user)
                  <tr>
                    <td>{{ $user->prefixname}}</td>
                    <td>{{ $user->fullname}}</td>
                    <td>{{ $user->email}}</td>
                    <td>
                        <a href="{{route('users.show',$user->id)}}" class="m-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('users.edit',$user->id)}}" class="m-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#myModal{{$user->id}}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                  </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
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
                <form method="post" action="{{ route('users.delete', $user->id) }}">
                    @csrf
                    {{ method_field('DELETE')}}
                    <button class="btn btn-danger">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
