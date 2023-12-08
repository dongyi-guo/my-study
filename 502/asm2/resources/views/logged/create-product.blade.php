@extends('logged.layout')

@section('title', 'New Product')

@section('content')
<div class="container p-10">
    <div class="d-grid gap-3">
        <div class="p-2">
            <h1>Create a Product</h1>
        </div>
        <div class="p-2">
            <form action="{{url('/create-product')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="ownerId" class="form-label">Owner:</label>
                    <select class="form-select" id="ownerId" name="ownerId" required>
                        <option value="" selected>Select the owner:</option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->userName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="energyTypeId" class="form-label">Type:</label>
                    <select class="form-select" id="energyTypeId" name="energyTypeId" required>
                        <option value="" selected>Select the Energy Type:</option>
                        @foreach ($energy_types as $type)
                        <option value="{{$type->id}}">{{$type->typeName}}</option>
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
                    <label for="volume" class="form-label">Volume</label>
                    <input type="number" class="form-control" name="volume" id="volume">
                </div>
                <div class="mb-3">
                    <label for="sellerPrice" class="form-label">Price</label>
                    <input type="number" class="form-control" name="sellerPrice" id="sellerPrice">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection