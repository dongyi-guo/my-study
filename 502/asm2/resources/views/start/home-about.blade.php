@extends('start.home-layout')
 
@section('title', 'About Us')
 
@section('content')
<div class="container">
    <img src={{ URL::asset("images/fifth-pic.jpg") }} class ="img-fluid" alt="solar-energy-picture-1">
</div> 
<br>
<hr>
<br> 
<div class="row">
    <div class="col-4">
        <h3 class="ordinary-blue">Who we are</h3>
        <p class="navy-blue">We are 100% Tasmanian owned and operated energy trading company.<p>
    </div>
    <div class="col-4">
        <h3 class="ordinary-blue">Environment</h3>
        <p class="navy-blue">We love our island state, we think it's beautiful and want to keep it that way!  That's why we're committed to minimising our impact on the environment at every opportunity.</p>
    </div>
    <div class="col-4">
        <h3 class="ordinary-blue">Community</h3>
        <p class="navy-blue">We are proud to be Tasmanian and are committed to ensuring as Tasmanians we all have a community to be proud of now and into the future. We support a variety of sporting, community and not for profit organisations across the island.</p>
    </div>
</div>
<style>
    .navy-blue{
        color: #000080;
    }
    .ordinary-blue{
        color: #0000FF;
    }
</style>
@endsection