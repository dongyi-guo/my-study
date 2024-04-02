@extends('layout')
@section('content')
  <!-- Computer page section -->
  <section class="computer">

    <!-- Back to Rental Page -->
    <a class="btn_back" href="/rental">
      <i class="fa fa-solid fa-chevron-left"></i>
      Go Back
    </a>

    <!-- Basic info group -->
    <div class="computer_basic_group">
      <div class="computer_price_group">
        <div class="computer_title">{{$computer->brand}}:</div>
        <div>$ {{$computer->price}}/h</div>
      </div>
      <img src="/storage/{{$computer->image}}" />
    </div>

    <!-- Specification group -->
    <div class="computer_detail_align">
      <div class="computer_detail_group">
        <div>System</div>
        <div>{{$computer->system}}</div>
      </div>
  
      <div class="computer_detail_group">
        <div>Display</div>
        <div>{{$computer->display}}"</div>
      </div>
  
      <div class="computer_detail_group">
        <div>RAM</div>
        <div>{{$computer->ram}} GB</div>
      </div>
  
      <div class="computer_detail_group">
        <div>USB</div>
        <div>{{$computer->usbCount}}</div>
      </div>
  
      <div class="computer_detail_group">
        <div>HDMI</div>
        <div>{{$computer->hdmi}}</div>
      </div>
    </div>

    <!-- Redirect to create rent page -->
    <a class="btn_rent btn-danger" href="/rental/createRent/{{$computer->id}}">Rent it NOW!</a>

  </section>
@endsection

