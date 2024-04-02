@extends('layout')
@section('content')
  <!-- Index page section -->
  <section class="index">
    <div class="dark-cover">
      <!-- Title -->
      <header class="title">UTAS Computer Rental Services</header>

      <!-- Form to search computer with brand -->
      <form class="form-search" method="POST" action="/search">
        @csrf
        <input
          name = "brand"
          class="search-bar"
          type="text"
          placeholder="Please Enter a Brand"
        />
        <button type="submit">
          <img class="icon-submit" src="./img/search.png">
        </button>
      </form>
    </div>
  </section>
@endsection

