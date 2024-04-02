@extends('logged.layout')

@section('title', 'New User')

@section('content')
<div class="container p-10">
    <div class="d-grid gap-3">
        <div class="p-2">
            <h1>Create a User</h1>
        </div>
        <div class="p-2">
            <form action="{{url('/create-user')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="userName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="userName" id="userName">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="tpd" class="form-label">Role:</label>
                    <select class="form-select" id="tpd" name="tpd" required>
                        <option value="" selected>Select the role:</option>
                        @foreach ($trading_positions as $role)
                        <option value="{{$role->id}}">{{$role->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="zoneId" class="form-label">Zone:</label>
                    <select class="form-select" id="zoneId" name="zoneId" required>
                        <option value="" selected>Select the Zone</option>
                        @foreach ($zones as $zone)
                        <option value="{{$zone->id}}">{{$zone->zoneName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="passwd" class="form-label">Password</label>
                    <input type="password" class="form-control" name="passwd" id="passwd">
                </div>
                <div class="mb-3">
                    <label for="postalAddress" class="form-label">Postal Address</label>
                    <input type="text" class="form-control" name="postalAddress" id="postalAddress">
                </div>
                <div class="mb-3">
                    <label for="balance" class="form-label">Balance</label>
                    <input type="float" class="form-control" name="balance" id="balance">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection