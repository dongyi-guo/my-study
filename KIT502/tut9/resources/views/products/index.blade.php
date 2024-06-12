@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Product Lists</h1>
    @if (Auth::user())
    <div class="pt-10">
        <a href="{{url('products/create')}}", class="btn btn-primary bt-sm">Add a new Product</a>
    </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Item Name</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    @if (isset(Auth::user()->id))
                    <td></td>
                    <td></td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    @if (isset(Auth::user()->id) && Auth::user()->id == $product->user_id)
                    <td><a href="products/{{$product->id}}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                    <td>
                        <form action="products/{{$product->id}}" method="POST">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection