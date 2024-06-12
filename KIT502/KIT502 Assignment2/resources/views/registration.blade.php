@extends('layout')
@section('content')
  <!-- Include js file for this page -->
  <script type="text/javascript" src="{{ URL::asset('js/registration.js') }}"></script>
  
  <!-- Registration Form -->
  <section id="registration_section">
    <form class="form" method="POST" action="/user">
      @csrf
      <h2>Create your Account</h2>
      <div class="registration_form">
        <!-- Account name -->
        <input
          class="registration_input"
          id="name"
          name="name"
          type="text"
          placeholder="Name"
          required
        />
        @error('name')
          <p>{{$message}}</p>   
        @enderror

        <!-- Email -->
        <input
          class="registration_input"
          id="email"
          name="email"
          type="email"
          placeholder="Email"
          required
        />
        @error('email')
          <p>{{$message}}</p>   
        @enderror

        <!-- Password -->
        <input
          class="registration_input"
          id="password"
          name="password"
          type="password"
          placeholder="Password"
          required
        />
        @error('password')
          <p>{{$message}}</p>   
        @enderror

        <!-- Confirm Password -->
        <input
          class="registration_input"
          id="password_confirmation"
          name="password_confirmation"
          type="password"
          placeholder="Confirm Password"
          required="required"
        />
        @error('password_confirmation')
          <p>{{$message}}</p>   
        @enderror
      </div>

      <!-- Is student checkbox -->
      <div class="form-check">
        <!-- check box with hidden input, gives it a default value: false -->
        <input type="hidden" name="isStudent" value="false"/>
        <input class="form-check-input" type="checkbox" id="isStudent" name="isStudent" value="true">
        <label class="form-check-label" for="isStudent">I am a student</label>
        @error('isStudent')
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

        <!-- Redirect to Login Link -->
      <div class="regestration_redirect">
        Already have an account? please
        <a
          id="link-login"
          href="#!"
          data-bs-toggle="modal"
          data-bs-target="#loginModal"
        >
          Login</a
        >
      </div>
    </form>
  </section>
@endsection