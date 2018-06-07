@if(Auth::user())
<nav class="navbar navbar-default navbar-static-top main_menu">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
    <div style="position: absolute; top: -31px; width: 300px; z-index: 150; ">
        <div style="float: left;">
        <img style="height: 80px; width: auto;" src="/images/logo5.jpg">
        </div>
        <div style="float: left; margin-top: 47px; margin-left: 10px; width: 150px">
            @include('layouts.logo')
        </div>
    </div>
</a>
</div>

<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">
        &nbsp;
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <li class="nav-item"><a href="{{ route('orders') }}" class="nav-link">Заявки</a></li>
        @can('menu', \App\User::class)
        <li class="nav-item"><a href="{{ route('firms') }}" class="nav-link">Клиенты</a></li>
        <li class="nav-item"><a href="{{ route('contractors') }}" class="nav-link">Подрядчики</a></li>
        <li class="nav-item"><a href="{{ route('users') }}" class="nav-link">Пользователи</a></li>
        @endcan
        <li class="nav-item"><a href="" class="nav-link">Помощь</a></li>
        <!-- Authentication Links -->
        @guest
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endguest
    </ul>
</div>
</div>
</nav>
@endif