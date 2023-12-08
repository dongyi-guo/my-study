@extends('logged.layout')

@section('title', 'Change Product')

@section('content')
<div class="container p-10">
    <div class="d-grid gap-3">
        <div class="p-2">
            <h1>Edit a Product</h1>
        </div>
        <div class="p-2">
            <form action="{{url('/edit-product')}}" method="POST">
                @csrf
                <div class="mb-3 d-none">
                    <input type="hidden" class="form-control" name="id" id=id" value="{{$product->id}}">
                </div>
                <div class="mb-3">
                    <label for="ownerId" class="form-label">Role:</label>
                    <input type="text" class="form-control" name="ownerId" id="ownerId" value="{{$product->ownerName}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="energyTypeId" class="form-label">Type:</label>
                    <select class="form-select" id="energyTypeId" name="energyTypeId" required>
                        <option value="{{$product->energyTypeId}}" selected>Select the Energy Type: (Current is {{$product->typeName}})</option>
                        @foreach ($energy_types as $type)
                        <option value="{{$type->id}}">{{$type->typeName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="zoneId" class="form-label">Zone:</label>
                    <select class="form-select" id="zoneId" name="zoneId">
                        <option value="{{$product->zoneId}}" selected>Select the Zone: (Current is {{$product->zoneName}})</option>
                        @foreach ($zones as $zone)
                        <option value="{{$zone->id}}">{{$zone->zoneName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="volume" class="form-label">Volume</label>
                    <input type="float" class="form-control" name="volume" id="volume" value="{{$product->volume}}">
                </div>
                <div class="mb-3">
                    <label for="sellerPrice" class="form-label">Price</label>
                    <input type="float" class="form-control" name="sellerPrice" id="sellerPrice" value="{{$product->sellerPrice}}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection