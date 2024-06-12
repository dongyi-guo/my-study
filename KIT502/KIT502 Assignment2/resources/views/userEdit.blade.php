@extends('layout')
@section('content')
  <!-- Edit user page section -->
  <section class="edit_user">
    <form class="form" method="POST" action="/user/edit/{{$user->id}}">
        @csrf
        @method('PUT')
        <h2>Edit My Details</h2>
        <div class="registration_form">

          <!-- User name -->
          <label>My Name</label>
          <input
            class="registration_input"
            id="name"
            name="name"
            type="text"
            value={{$user->name}}
            required
          />
          @error('name')
            <p>{{$message}}</p>   
          @enderror
  
          <!-- Email -->
          <label>My Email Address</label>
          <input
            class="registration_input"
            id="email"
            name="email"
            type="email"
            value={{$user->email}}
            required
          />
          @error('email')
            <p>{{$message}}</p>   
          @enderror

            <!-- number -->
            <label>My Phone Number</label>
            <input
              class="registration_input"
              id="number"
              name="number"
              type="number"
              value={{$user->number}}
              required
            />
            @error('number')
              <p>{{$message}}</p>   
            @enderror
        </div>
  
        <!-- Submit button -->
        <div class="registration_submit">
          <input
            class="btn btn-basic"
            type="submit"
            value="Submit"
            onclick="submitForm()"
          />
      </form>
  </section>
@endsection