@extends('layout')
@section('content')
  <!-- include js file for search -->
  <script src="./search.js"></script>
  <!-- include js file for rental page -->
  <script src="./rental.js"></script>

  <!-- Rental Page Section: User -->
  <section class="rental">

    <!-- List of availiable computers + Details + Availability button -->
    <ul class="computer-list">
      @foreach ($computers as $computer)
        <x-computer-rent :computer="$computer"/>
      @endforeach
    </ul>
  </section>
@endsection