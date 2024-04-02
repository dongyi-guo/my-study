@extends('start.home-layout')
 
@section('title', 'Home')
 
@section('content')
<div class="container">
    <img src={{ URL::asset("images/second-pic.jpg") }} class ="img-fluid" alt="solar-energy-picture-1">
</div> 
<br>
<hr>
<br>
<div class="row align-items-center">
    <div class="col-6">
        <h3><span class="ordinary-blue">Clean energy</span><span class = "navy-blue"> that works for everyone on the planet.</span></h3>
    </div>
	<div class="col-6">	
        <p class="navy-blue">We have developed an energy and flexibility trading platform that allows households, organisations, and the grid itself to trade with each other.</p>
        <p class="navy-blue">We offer technology that supports a responsive market. Because the grid is only as good as the market behind it.</p>
	</div>
</div> 
<br>
<hr>
<br>
<div class="row align-items-center">
    <div class="col-6">
        <img src={{ URL::asset("images/first-pic.jpg") }} class ="img-fluid" alt="wind-energy-picture-1" width="500" height="300">
    </div>
	<div class="col-6">	
        <h3><span class="ordinary-blue">Explore</span><span class="navy-blue"> renewable energy trading market.</span></h3>
        <p class="navy-blue">TaGET is the leading environment-friendly energy trading company in Tasmania.</p>
	</div>
</div> 
<br>
<hr>
<br>
<div class="row align-items-center">
    <div class="col-6">	
        <h3><span class="navy-blue">We have a </span><span class="ordinary-blue">variety of trading products.</span></h3>
        <p class="navy-blue">We collaborate with local providers including Commercial Wind, Solar, Geothermal, Hydroelectric and Biomass.</p>
	</div>
    <div class="col-6 text-right">
        <img src={{ URL::asset("images/fourth-pic.jpg") }} class ="img-fluid" alt="solar-energy-picture-2" width="500" height="300">
    </div>
</div> 
<br>
<hr>
<br>
<div class="row align-items-center">
    <div class="col-6">
        <img src={{ URL::asset("images/third-pic.jpg") }} class ="img-fluid" alt="wind-energy-picture-2" width="500" height="300">
    </div>
	<div class="col-6">	
        <h3><span class="navy-blue">Do not limit </span><span class="ordinary-blue">your possibility.</span></h3>
        <p class="navy-blue">You can both buy and sell renewable energy on our platform.</p>
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