@extends('layout')
@section('content')

  <!-- Manager dashboard page section -->
  <section class="dashboard_manager">

    <!-- Summary of Computers Rental Status -->
    <div class="lg">Computer Rental Summary</div>
    <ul>
        <li class="summary_group">
            <div class="summary_title">Not Rented: </div>
            <div class="summary_content">{{$not_rented_count}} Computers</div>
        </li>
        <li class="summary_group">
            <div class="summary_title">Pending Return: </div>
            <div class="summary_content">{{$rented_count}} Computers</div>
        </li>
        <li class="summary_group">
            <div class="summary_title">Rented: </div>
            <div class="summary_content">{{$pending_count}} Computers</div>
        </li>
    </ul>

    <!-- Summary of Users (Staff + Customer) -->
    <div class="summary_group">
        <div class="summary_title">User Summary:</div>
        <div class="summary_content">{{$user_count}} Users </div>
    </div>

    <!-- Summary of Users in Blacklist -->
    <div class="summary_group">
        <div class="summary_title">Blacklist Summary: </div>
        <div class="summary_content">{{$blacklist_count}} Blacklisted Customers</div>
    </div>


  </section>

@endsection

