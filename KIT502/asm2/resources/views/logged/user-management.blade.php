@extends('logged.layout')

@section('title', 'User Management')

@section('content')
<h1>Users</h1>
<div class="pt-10">
    <a href="{{url('logged/user-create')}}", class="btn btn-primary bt-sm">Create a User</a>
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Zone</td>
                <td>Postal</td>
                <td>Balance</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->userName}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->roleName}}</td>
                <td>{{$user->zoneName}}</td>
                <td>{{$user->postalAddress}}</td>
                <td>{{$user->balance}}</td>
                @if ($user->isActive == 1)
                <td><a href="{{url('/logged/user-management/deactive')}}/{{$user->id}}" class="btn btn-danger btn-sm">Deactive</a></td>
                @else
                <td><a href="{{url('/logged/user-management/active')}}/{{$user->id}}" class="btn btn-primary btn-sm">Active</a></td>
                @endif
                <td>
                    <form action="{{url('/logged/user-management/delete')}}/{{$user->id}}" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection