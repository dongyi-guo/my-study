<!doctype html>
<html>
    <head>
        <title>TaGET - @yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js"></script>
    </head>
    <body>
        {{-- Header Bar --}}
        <nav class="navbar navbar-expand-lg bg-info fixed-top">
            <div class="container-fluid">
                <button id="menu-toggle" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#"><i class="fa fa-2x fa-lightbulb"></i> <span class="logo-text">TaGET - @yield('title')</span></a>
            </div>
        </nav>

        {{-- Side Menu Bar --}}
        <div id="wrapper" style="margin-top: 72px;">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                    <li>
                        <a href="{{url('/logged')}}">
                            <span class="fa-stack fa-lg pull-left"><i class="fa fa-tachometer fa-stack-1x"></i></span> Dashboard
                        </a>
                    </li>
                    <li>
                        @if (Auth::user()->isManager == 0)
                        <a href="{{url('/logged/trading')}}/{{Auth::user()->id}}">
                            <span class="fa-stack fa-lg pull-left"><i class="fa fa-suitcase fa-stack-1x"></i></span> Trading
                        </a>
                        @else
                        <a href="{{url('/logged/master-trading')}}">
                            <span class="fa-stack fa-lg pull-left"><i class="fa fa-suitcase fa-stack-1x"></i></span> Master Trading
                        </a>
                        @endif
                        
                    </li>

                    @if (Auth::user()->isManager == 1)
                    <hr class="menu-divider" />
                    <li>
                        <a href="{{url('/logged/fee')}}">
                            <span class="fa-stack fa-lg pull-left"><i class="fa fa-usd fa-stack-1x"></i></span> Fee Management
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/logged/user-management')}}">
                            <span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x"></i></span> User Management
                        </a>
                    </li>
                    @endif
                    
                    <hr class="menu-divider" />
                    <li>
                        <a href="{{url('/logged/profile')}}/{{Auth::user()->id}}">
                            <span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x"></i></span> {{Auth::user()->userName}}
                        </a>
                    </li>
		            <li>
                        <a href="{{url('/logout')}}">
                            <span class="fa-stack fa-lg pull-left"><i style="min-width: 20px;" class="fa fa-sign-out fa-stack-1x"></i></span> Logout
                        </a>
                    </li>
                </ul>
            </div>

            <div id="page-content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        
        $(document).ready(function() {
            
        });
    </script>
</html>