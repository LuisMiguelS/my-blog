<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto font-weight-bold">

    @foreach($categories->take(10)->all() as $slug => $category)
        <li class="nav-item">
            <a class="nav-link" href="{{ url($slug) }}">{{ $category }} <span class="sr-only">(current)</span></a>
        </li>
    @endforeach

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Otras categorias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($categories->take(-20)->all() as $slug => $category)
                <a class="dropdown-item" href="{{ $slug }}">{{ $category }}</a>
            @endforeach
        </div>
    </li>

</ul>

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav ml-auto font-weight-bold">
    <!-- Authentication Links -->
    @guest
        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a></li>
       {{-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a></li>--}}
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <img class="rounded-circle" src="{{ auth()->user()->avatar }}" height="32" width="32">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                    {{ __('Dashboard') }}
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Cerrar sesión') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>