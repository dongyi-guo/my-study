<!doctype html>
<html>
    <head>
        <title>TaGET - @yield('title')</title>

        <link rel="stylesheet" href="guest-style.css" />
        <link rel="stylesheet" href="{{ asset('css/guest-style.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hind Siliguri">
    </head>
    <body>
        <div>
            @include('start.home-header')
        </div>
        
        <div class="container">        
            <div id="body-content" class="body-content" class="row">
                    @yield('content')
            </div>
        </div>

        <footer class="row">
            @include('start.home-footer')
        </footer>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js"></script>
</html>