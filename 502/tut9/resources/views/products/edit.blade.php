@extends('layouts.app')
@section('content')
<div class="container p-10">
    <div class="d-grid gap-3">
        <div class="p-2">
            <h1>Update a Product</h1>
        </div>
        <div class="p-2">
            <form action="{{url('/edit')}}" method="POST">
                @csrf
                <div class="mb-3 d-none">
                    <input type="hidden" class="form-control" name="id" id=id" value="{{$product->id}}">
                </div>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" value="{{$product->product_name}}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="float" class="form-control" name="price" id="price" value="{{$product->price}}">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{$product->quantity}}">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>
@endsection