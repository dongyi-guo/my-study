@extends('logged.layout')

@section('title', 'Your Profile')

@section('content')
<h1>Your Profile</h1>

{{-- Personal Information --}}
<div class="accordion" id="personal-details">
  <div class="accordion-item">
    <h2 class="accordion-header accordion-flush" id="panelsStayOpen-headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        Your Details
        </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
        <div class="accordion-body">
            <form action="{{url('logged/profile/update')}}" method="POST">
                @csrf
                <div class="mb-3 d-none">
                    <input type="hidden" class="form-control" name="id" id=id" value="{{$user->id}}">
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">Name:</label>
                    <input type="input" class="form-control" id="userName" name="userName" value="{{$user->userName}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="postalAddress" class="form-label">Postal Address:</label>
                    <input type="input" class="form-control" id="postalAddress" name="postalAddress" value="{{$user->postalAddress}}">
                </div>
                <div class="mb-3">
                    <label for="passwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="passwd" name="passwd" value="" placeholder="Put your desired new password">
                </div>
                <div class="mb-3">
                    <label for="tradingPositionId" class="form-label">Role:</label>
                    <select class="form-select" id="tradingPositionId" name="tradingPositionId">
                        <option value="{{$user->tradingPositionId}}" selected>Select a new role: (Current: {{$user->roleName}})</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="zoneId" class="form-label">Zone:</label>
                    <select class="form-select" id="zoneId" name="zoneId">
                        <option value="{{$user->zoneId}}" selected>Select your new zone: (Current: {{$user->zoneName}})</option>
                        @foreach ($zones as $zone)
                        <option value="{{$zone->id}}">{{$zone->zoneName}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
  </div>
</div>

@if (Auth::user()->isManager == 0)

<br>

{{-- Balance Management --}}
<div class="accordion accordion-flush" id="balance">
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
        Your Balance
        </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
        <div class="accordion-body">
            <h5>Your Remaining Balance: $AUD {{$user->balance}}</h5> 
            <br>
            <form action="{{url('/top-up')}}/{{$user->id}}" method="post">
                @csrf
                <input type="float" class="form-control" id="money" name="money" placeholder="Top-up">
                <br>
                <button type="submit" class="btn btn-primary">Top-up</button>
            </form>
            <br>
            <form action="{{url('/withdraw')}}/{{$user->id}}" method="post">
                @csrf
                <input type="float" class="form-control" id="money" name="money" placeholder="Withdraw">
                <br>
                <button type="submit" class="btn btn-warning">Withdraw</button>
            </form>
        </div>
    </div>
  </div>
</div>

<br>

{{-- Trading History --}}
<div class="accordion accordion-flush" id="trading-history">
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
        Your Trading History
        </button>
    </h2>
    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
        <div class="accordion-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Buyer</td>
                            <td>Seller</td>
                            <td>Type</td>
                            <td>Zone</td>
                            <td>Time</td>
                            <td>Volume</td>
                            <td>Tax</td>
                            <td>Trade Price</td>
                            <td>Deal Price</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trading_history as $entry)
                        <tr>
                            <td>{{$entry->buyerName}}</td>
                            <td>{{$entry->sellerName}}</td>
                            <td>{{$entry->typeName}}</td>
                            <td>{{$entry->zoneName}}</td>
                            <td>{{$entry->transactionDateTime}}</td>
                            <td>{{$entry->volume}}</td>
                            <td>{{$entry->tax}}</td>
                            <td>{{$entry->tradingPrice}}</td>
                            <td>{{$entry->sellerReceivedPrice}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>
@endif
@endsection