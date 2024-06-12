<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta tag -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--Bootstrap CSS  -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <!-- Fontawesome icons -->
    <link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" 
      crossorigin="anonymous" 
      referrerpolicy="no-referrer" 
    />

    <!--Bootstrap Bundles  -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

    <!--External CSS file  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >

    <!-- Import font style -->
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway&display=swap"
      rel="stylesheet"
    />

    <!-- Import Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Home</title>
  </head>
  <body>
    <!-- include js file for login -->
    <script src="./login.js"></script>
    <!-- include js file for search -->
    <script src="./search_index.js"></script>

    <!-- NavBar -->
    <nav class="navbar">
      <a class="title-abbr" href="#!">UCR</a>
      <ul>
        <!-- Link to Index Page -->
        <li><a href="{{ route('/') }}"> Home</a></li>

        <!-- Authenticated user nav tab -->
        @auth

        <!-- If the authenticated user is customer -->
        @if (auth()->user()->accessLevel == 0)

        <!-- Link to Customer account Page -->
        <li><a href="{{ route('user') }}">Hi! {{auth()->user()->name}}</a></li>

        <!-- Link to Rental Page -->
        <li><a href="{{ route('rental') }}"> Rental</a></li>

        <!-- Link to Return Rental Page -->
        <li><a href="{{ route('return') }}"> Return</a></li>

        <!-- If the authenticated user is Staff -->
        @else

          <!-- If the authenticated user is Manager -->
          @if (auth()->user()->accessLevel == 2)
      
          <!-- Link to Manage User Page -->
          <li><a href="{{ route('manager') }}">Hi, Manager!</a></li> 

          @endif

        <!-- Link to Master Page -->
        <li><a href="{{ route('master') }}"> Master</a></li>

        <!-- Link to Manage Rental Page -->
        <li><a href="{{ route('returnManage') }}"> Manage Return</a></li>

        <!-- Link to Manage User Page -->
        <li><a href="{{ route('userManage') }}"> Manage User</a></li>

        @endif

        <!-- Logout form -->
        <li>
          <form method="POST" action="/logout">
          @csrf
          <button type="submit">
            Logout
            <i class="fa fa-solid fa-arrow-right-from-bracket"></i>
          </button>
          </form>
        </li>

        @else
        <!-- Link to Registration Page -->
        <li><a href="{{ route('registration') }}"> Registor</a></li>

        <!-- Login button -->
        <li>
          <a href="#!" data-bs-toggle="modal" data-bs-target="#loginModal"> 
            <i class="fa-solid fa-arrow-right-to-bracket"></i>
            Login
          </a>
        </li>
        @endauth

      </ul>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Login</h4>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form" method="POST" action="/login">
              @csrf
                <div class="form-group">
                  <label for="name" class="form-label">User Name</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                  @error('name')
                      <p>{{$message}}</p>   
                  @enderror
              </div>

              <div class="form-group">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                  @error('password')
                      <p>{{$message}}</p>   
                  @enderror
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary float-right">
                Login
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @yield('content')
  </body>
</html>
