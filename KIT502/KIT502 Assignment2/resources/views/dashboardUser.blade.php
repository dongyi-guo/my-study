@extends('layout')
@section('content')
  <!-- User page section -->
  <section class="dashboard_user">
    <div class="lg"> My Details </div>

      <!-- View user details -->
      <div class="detail_group">
        <div class="info_group">
            <div>
              <div class="rg"> Name: {{$user->name}} </div>
              <div class="rg"> Email: {{$user->email}} </div>
              <div class="rg"> Number: {{$user->number}} </div>
            </div>
          <a href="/user/edit/{{$user->id}}">Update</a>
        </div>

        <!-- View account balance -->
        <div class="info_group">
          <div class="rg"> My Current Balance: <p class="rg">{{$customer->balance}}</p> </div>
          <a  class="" href="#!" data-bs-toggle="modal" data-bs-target="#chargeModal"> Charge</a>
        </div>
      </div>

      <!-- View renting history -->
      <div class="lg"> My Renting Histories </div>
      <div class="history_group">
        <ul>
          @foreach ($histories as $history)
            <x-history :history="$history" :computers="$computers"/>
          @endforeach
        </ul>
      </div>

      <!-- Charge Modal -->
      <div class="modal fade" id="chargeModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Charge My Account</h4>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
              ></button>
            </div>
  
            <!-- Modal body -->
            <div class="modal-body">
              <form class="form" method="POST" action="/user/charge">
                @csrf
                @method('PUT')
                  <div class="form-group">
                    <label for="balance" class="form-label">Enter the amount of deposit: </label>

                    <!-- The amount of money must greater than 0 -->
                    <input type="number" class="form-control" id="balance" name="balance" min="0" required>
                    @error('balance')
                        <p>{{$message}}</p>   
                    @enderror
                </div>
  
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary float-right">
                  Charge
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
@endsection