@extends('logged.layout')

@section('title', 'Sell Product')

@section('content')
<div class="container p-10">
    <div class="d-grid gap-3">
        <div class="p-2">
            <h1>Sell a Product</h1>
        </div>
        <div class="p-2">
            <form action="{{url('/sell-product')}}" method="POST">
                @csrf
                <div class="mb-3 d-none">
                    <input type="hidden" class="form-control" name="ownerId" id="ownerId" value="{{Auth::user()->id}}">
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
                    <label for="zoneName" class="form-label">Zone:</label>
                    <input type="hidden" class="form-control" name="zoneId" id="zoneId" value="{{Auth::user()->zoneId}}">
                    <input type="input" class="form-control" name="zoneName" id="zoneName" value="{{$zones->filter(function($zone) { return $zone->id == (Auth::user()->zoneId); })->first()->zoneName}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="volume" class="form-label">Volume</label>
                    <input type="number" class="form-control" name="volume" id="volume">
                </div>
                <div class="mb-3">
                    <label for="sellerPrice" class="form-label">Price</label>
                    <input type="number" class="form-control" name="sellerPrice" id="sellerPrice">
                </div>
                <button type="submit" class="btn btn-primary">Publish</button>
            </form>
        </div>
    </div>
</div>
@endsection