<!-- Header -->
<header>
    <nav class="navbar navbar-expand-md bg-light navbar-light">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link {{request()->is('/') ? 'active' : ''}}" href="{{route('main')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->is('products') ? 'active' : ''}}" href="{{route('products')}}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->is('about') ? 'active' : ''}}" href="{{route('about')}}">About</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">{{ __('Login')}}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register')}}">{{ __('Register')}}</a>
                        </li>
                    @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Welcome {{Auth::user()->name}}!
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('logout')}}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{__('Logout')}}
                                </a>
                                <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form2').submit();"
                            >{{ __('Logout')}}</a>
                            <form id="logout-form2" action="{{route('logout')}}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>