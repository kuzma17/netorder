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
        <img style="height: 80px; width: auto;" src="/images/logo.jpg">
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
        <li class="nav-item"><a href="{{ route('orders') }}" class="nav-link">Заказы</a></li>
        @can('menu', \App\User::class)
        <li class="nav-item"><a href="{{ route('firms') }}" class="nav-link">Клиенты</a></li>
        <li class="nav-item"><a href="{{ route('contractors.index') }}" class="nav-link">Подрядчики</a></li>
        <li class="nav-item"><a href="{{ route('users') }}" class="nav-link">Пользователи</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i>
                     Параметры<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('printers.index') }}">Принтеры</a></li>
                    <li><a href="{{ route('cartridges.index') }}">Картриджи</a></li>
                    <li><a href="{{ route('cites.index') }}">Населенные пункты</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('setting.edit') }}" class="nav-link">Настройки</a></li>
                </ul>
            </li>
        @endcan
        <li class="nav-item"><a href="{{ route('help') }}" class="nav-link"><i class="fa fa-life-ring" aria-hidden="true"></i>
                 Помощь</a></li>
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
                    <li class="logout">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> выход
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