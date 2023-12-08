@extends('layout')
@section('content')
  <!-- Return rental page section: User -->
  <section class="table_page">

    <!-- If the user's rental list not empty, show the rental list -->
    @if (!$computers->isEmpty())
      <!-- Rented Computer List -->
      <table class="table_view">
        <thead>
          <tr>
            <th>Select</th>
            <th>Brand</th>
            <th>System</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($computers as $computer)
            <x-computer-return :computer="$computer"/>
          @endforeach
        </tbody>
      </table>
    @else
        <div class="lg">Your Rental List is Empty!</div>

        <!-- Back to Rental Page -->
        <a class="btn btn-basic rg" href="/rental">
          Rent NOW!
        </a>
    @endif

  </section>
@endsection
