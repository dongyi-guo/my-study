@extends('logged.layout')

@section('title', 'Trading')

@section('content')
@if (!Auth::user()->isActive)
<br> 
<h1>Sorry, but it appears that your account is deactivated.</h1>
<br>
@else
<h1>Market</h1>
@if (Auth::user()->tradingPositionId == 2 || Auth::user()->tradingPositionId == 3)
<div class="pt-10">
    <a href="{{url('logged/sell-product')}}", class="btn btn-primary bt-sm">Sell a new Product</a>
</div>
@endif
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
            @if (Auth::user()->tradingPositionId == 1 || Auth::user()->tradingPositionId == 3)
            <td class="action-cell">
                <a href="{{url('/logged/buy-product')}}/{{$entry->id}}" class="btn btn-warning btn-sm">Buy</a>
            </td>
            @endif
            @if (Auth::user()->tradingPositionId == 2 && Auth::user()->id == $entry->ownerId)
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
            @endif
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection