<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto font-weight-bold">
    <li class="nav-item @if(Request::path() == '/') active @endif">
        <a class="nav-link" href="/">Inicio</a>
    </li>

    @foreach($categories->take(7)->all() as $slug => $category)
        <li class="nav-item @if(Request::path() == $slug) active @endif">
            <a class="nav-link" href="{{ url($slug) }}">{{ $category }}</a>
        </li>
    @endforeach

    @if($categories->count() > 7)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Otras categorías
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($categories->all() as $slug => $category)
                    @if($loop->index > 6)
                        <a class="dropdown-item" href="{{ $slug }}">{{ $category }}</a>
                    @endif
                @endforeach
            </div>
        </li>
    @endif

</ul>

<!-- Right Side Of Navbar -->
{{-- <ul class="nav navbar-nav ml-auto font-weight-bold">
    @guest
        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a></li>
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
</ul> --}}