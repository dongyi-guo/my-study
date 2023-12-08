@extends('layouts.app')
@section('content')
<div class="container">
    <h1>I love Soonja</h1>
</div>

<br>

<div class="container">
<div class="row align-items-center">
<div class="col">
    <figure>
        <img src="{{url('../images/cascade-brewery.jpg')}}" alt="cascade-brewery" width="400" height="300">
        <figcaption class="figure-caption text-center figcap-bigger">Cascade Brewery</figcaption>
    </figure>
</div>
<div class="col">
    <figure>
        <img src="{{url('../images/hobart-harbour.jpg')}}" alt="hobart-harbour" width="400" height="300">
        <figcaption class="figure-caption text-center figcap-bigger">Hobart Harbour</figcaption>
    </figure>
</div>
<div class="col">
    <figure>
        <img src="{{url('../images/port-arthur.jpg')}}" alt="port-arthur" width="400" height="300">
        <figcaption class="figure-caption text-center figcap-bigger">Port Arthur</figcaption>
    </figure>
</div>
</div>
</div>
@endsection