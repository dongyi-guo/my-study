@extends('layouts.app')
@section('content')
<div class="container p-10">
    <div class="d-grid gap-3">
        <div class="p-2">
            <h1>Create a Product</h1>
        </div>
        <div class="p-2">
            <form action="{{url('/create')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" id="product_name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="float" class="form-control" name="price" id="price">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection