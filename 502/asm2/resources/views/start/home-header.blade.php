<header class="container d-none d-sm-block">
    <div class="row align-items-center">
        <div class="col-12 col-md-8">
        <h3 style="color: #000080; font-family: Tahoma;">Tassie Green Energy Trading Company</h3>   
        </div>
        <div class="col-12 col-md-4 text-end">
            <a href="#" class="social-box facebook" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social-box twitter" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-box pinterest" target="_blank"><i class="fab fa-pinterest"></i></a>
            <a href="#" class="social-box linkedin" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="social-box envelope" target="_blank"><i class="fas fa-envelope"></i></a>
        </div>
    </div>
</header>
        
<nav class="navbar navbar-expand-lg">
<div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <img src={{ URL::asset("images/home-logo.jpg") }} class="img img-fluid d-lg-none rounded-0" alt="TaGET Logo" style="width: 100px; height: 40px;" />
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/home-trading') }}">Trading</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/home-privacy') }}">Privacy</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/home-terms') }}">Our Terms</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/home-about') }}">About Us</a>
            </li>
        </ul>
        <form class="d-flex py-2 search-bar" role="search" type="get" action="{{ url('/home-search') }}">
            <div class="input-group">
                <input class="form-control rounded-0" type="search" placeholder="'Wind' or 'Zone A'" aria-label="Search" id="txtSerch" name="query">
                <button class="btn btn-outline-info input-group-text rounded-0" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav navbar-right">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->userName }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{  __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
            @endguest
        </ul>
    </div>
</div>
</nav>
                            
<style>
.navbar{
        border-width: 0;
        background-color: #0000FF;
        border-color: #dedede;
        border-style: solid;
        padding-top: 0px;
        padding-bottom: 0px;
        border-top-width: 1px;
        border-bottom-width: 1px;
        height: 58px;
    }
    
    .nav-item{
        margin-right: 10px;
    }

    .nav-link{
        position: relative;
        font-size: 16px;
        font-weight: bold;
        color: #FFFFFF;
        line-height: 30px;
    }

    .nav-link:hover{
        color: #FFFFFF;
        border-bottom: 2px solid #FFFFFF;
    }

    .search-bar{
        margin-right: 20px;
    }
    .navbar-collapse{
        background-color: #0000FF;
        padding-left: 20px;
        padding-right: 20px;
    }

    header {
        border-width: 0;
        background-color: #fffffd;
        border-style: solid;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .btn-light {
    background-color: #0000FF;
    margin-left: 10px;
    color: #ffffff;
    font-weight: bold;
    border-color: #0000FF; 
    }

    .btn-light:hover, .btn-light:focus, .btn-light:active, .btn-light.active, .open>.dropdown-toggle.btn-light {
    color: #ffffff;
    background-color: #000080;
    }

    header .input-group {
        width: 100%;
        max-width: 500px;
    }

    header .input-group input {
        color: #313131;
        font-size: 13px;
    }

    header .input-group .input-group-text {
        padding: 11px;
        background-color: #303f9f;
        color: #ffffff;
    }

    .social-box {
        display: inline-block;
        margin-right: 5px;
        color: #ffffff;
        height: 28px;
        width: 28px;
        text-align: center;
    }

    .facebook {
        line-height: 28px;
        color: #fff !important;
        background-color: #0d47a1 !important;
    }

    .twitter {
        line-height: 28px;
        color: #fff !important;
        background-color: #40c4ff !important;
    }

    .pinterest {
        line-height: 28px;
        color: #fff !important;
        background-color: #e71b22 !important;
    }

    .linkedin {
        line-height: 28px;
        color: #fff !important;
        background-color: #0077b7 !important;
    }

    .envelope {
        line-height: 28px;
        color: #fff !important;
        background-color: #0084ff !important;
    }                    
</style>