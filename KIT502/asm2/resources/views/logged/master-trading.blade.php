@extends('logged.layout')

@section('title', 'Master Trading')

@section('content')
<h1>Management</h1>
<div class="pt-10">
    <a href="{{url('/logged/create-product')}}", class="btn btn-primary bt-sm">Create new Product</a>
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Owner</th>
            <th>Type</th>
            <th><strong>Zone</strong></th>
            <th><strong>Volume</strong></th>
            <th><strong>Price</strong></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($energy_products as $entry)
        <tr>
            <td>{{$entry->ownerName}}</td>
            <td>{{$entry->typeName}}</td>
            <td>{{$entry->zoneName}}</td>
            <td>{{$entry->volume}}</td>
            <td>{{$entry->sellerPrice}}</td>
            <td class="action-cell">
                <a href="{{url('/logged/edit-product')}}/{{$entry->id}}" class="btn btn-warning btn-sm">Edit</a>
            </td>
            <td class="action-cell">
                <form action="{{url('/logged/delete-product')}}/{{$entry->id}}" method="POST">
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