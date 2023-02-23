<!DOCTYPE html>
<html lang="">

<head>
    <!-- Google tag (gtag.js) -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-251PCL07C9"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-251PCL07C9');
    </script> --}}
    <title>@yield('title')  {{ setting()->get('blog.site_name') ?? config('app.name','Blog') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="@yield('author')">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:url" content="@yield('url') {{ config('app.url') }}">
    <meta property="og:image" content="@yield('image')">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="304">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="site.webmanifest">
    <!-- favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="icon.png">
    <meta name="theme-color" content="#030303">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link href="{{ asset('front-end/css/styles.css') }}?537a1bbd0e5129401d28" rel="stylesheet">
    <style type="text/css">
        .instagram-sidebar { background: #f09433; 
            background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
            background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
            background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); margin-bottom: 10px; }
        .image-ads { margin: 0 auto !important; display: block !important; }
        .image-ads-full { max-width: 100%; width: 100%; height: auto; -o-object-fit: cover; object-fit: cover; position: relative; }
        .navbar-nav li.active { border-bottom: 2px solid #c00; }
        .navbar-nav li.active a { color: #c00 !important; }
    </style>
    @yield('css')
</head>
<body class="body-box bg-news-image">
    <!-- loading -->
    <div class="loading-container">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <ul class="list-unstyled">
                <li>
                    <img src="{{ asset('images/logo.png') }}" alt="notidigitalrd" height="250" style="width: 250px !important;" />
                </li>

                <li>
                    <div class="spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>
                </li>

                <li>
                    <p>Cargando...</p>
                </li>
            </ul>
        </div>
    </div>
    <!-- End loading -->

    <!-- Header news -->
    <header>
        <!-- Navbar  -->
        <div class="topbar d-none d-sm-block">
            <div class="container ">
                <div class="row">
                    <div class=" col-sm-12 col-md-4 my-auto d-none d-sm-block ">
                        <figure class="mb-0">
                            <a href="/">
                                <img src="{{ asset('images/logo-light.png') }}" alt="notidigitalrd" class="img-fluid" style="height: 100px;">
                            </a>
                        </figure>
                    </div>

                    {{-- <div class="col-sm-12 col-md-5">
                        <div class="topbar-left">
                            <div class="topbar-text">
                                {{ date('l d, F Y') }}
                            </div>
                        </div>
                    </div> --}}

                    {{-- Fecha y hora --}}
                    <div class="col-md-4" style="display: flex; justify-content: center; align-items: center; font-size: 14px;">
                        <span id="clock" class="text-white"></span>
                    </div>

                    <div class="col-sm-12 col-md-4" style="display: flex; justify-content: center; align-items: center;">
                        <div class="list-unstyled topbar-right" style="display: flex; justify-content: end; align-items: center;">
                            <ul class="topbar-link">
                                @guest
                                    <li><a href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a></li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('admin/dashboard') }}" style="color: black;">
                                                {{ __('Dashboard') }}
                                            </a>

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"
                                                style="color: black;">
                                                {{ __('Cerrar sesión') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>

                            {{-- Redes sociales --}}
                            <ul class="topbar-sosmed">
                                @if(setting()->get('blog.blog_facebook'))
                                    <li>
                                        <a href="{{ setting()->get('blog.blog_facebook') }}"><i class="fa fa-facebook"></i></a>
                                    </li>
                                @endif

                                @if(setting()->get('blog.blog_twitter'))
                                    <li>
                                        <a href="{{ setting()->get('blog.blog_twitter') }}"><i class="fa fa-twitter"></i></a>
                                    </li>
                                @endif

                                @if(setting()->get('blog.blog_instagram'))
                                    <li>
                                        <a href="{{ setting()->get('blog.blog_instagram') }}"><i class="fa fa-instagram"></i></a>
                                    </li>
                                @endif

                                @if(setting()->get('blog.blog_youtube'))
                                    <li>
                                        <a href="{{ setting()->get('blog.blog_youtube') }}"><i class="fa fa-youtube"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Navbar  -->

        <!-- logo -->
        <div class="bg-white ">
            <div class="container">
                <div class="row">
                    {{-- <div class=" col-sm-12 col-md-4 my-auto d-none d-sm-block ">
                        <figure class="mb-0">
                            <a href="/">
                                <img src="{{ asset('images/logo.png') }}" alt="notidigitalrd" class="img-fluid">
                            </a>
                        </figure>
                    </div> --}}

                    {{-- Publicidad --}}
                    <div class="col-md-12">
                        @if($anuncio[0]->canShow)
                            <figure class="mt-3">
                                <a href="{{ $anuncio[0]->url }}">
                                    <img src="{{ $anuncio[0]->banner }}" alt="" class="img-fluid image-ads image-ads-full" style="max-height: 100px;">
                                </a>
                            </figure>
                        @endif
                    </div>
                    {{-- end Publicidad --}}

                    {{-- <div class="col-md-4 mt-3">
                        @if($anuncio[1]->canShow)
                            {!! $anuncio[1]->link !!}
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- end logo -->

        <!-- navbar -->
        <div class="navigation-wrap navigation-shadow bg-white">
            <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
                <div class="container">
                    <div class="offcanvas-header">
                        <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                            <span class="navbar-toggler-icon"></span>
                        </div>
                    </div>

                    <figure class="mb-0 mx-auto d-block d-sm-none sticky-logo">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" alt="notidigitalrd" class="img-fluid" style="width: 100px;">
                        </a>
                    </figure>

                    <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                        <ul class="navbar-nav">
                            @include('partials.nav-menu')
                        </ul>

                        @include('partials.search')
                    </div>
                </div>
            </nav>
        </div>
        <!-- End Navbar  -->

        <!-- Tranding News -->
        @yield('tranding')
        <!-- End Tranding News -->
    </header>
    <!-- End Header news -->

    <!-- Popular Content news -->
    <section class="bg-content">
        @yield('content')
    </section>
    <!-- End Popular Content news -->

    <!-- Footer  -->
    @include('partials.footer')
    <!-- End Footer  -->

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="widget__form-search-bar  ">
                        <form action="{{ url('search') }}" method="GET">
                            <div class="row no-gutters">
                                <div class="col">
                                    <input class="form-control border-secondary border-right-0 rounded-0" value="" name="q" id="q" placeholder="Buscar" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="list-group list-group-flush">
                        <ul class="navbar-nav">
                            @guest
                                <li><a href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a></li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('admin/dashboard') }}" style="color: black;">
                                            {{ __('Dashboard') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                            style="color: black;">
                                            {{ __('Cerrar sesión') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest

                            <li class="nav-item @if(Request::path() == '/') active @endif">
                                <a class="nav-link" href="/">Inicio</a>
                            </li>

                            @foreach($categories->all() as $slug => $category)
                                <li class="nav-item @if(Request::path() == $slug) active @endif">
                                    <a class="nav-link" href="{{ url($slug) }}">{{ $category }}</a>
                                    {{-- <li class="nav-item"><a class="nav-link  text-dark" href="#"> Category </a></li> --}}
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>

                <div class="modal-footer">
                    {{-- <p>© 2020 <a href="http://retenvi.com" title="Premium WordPress news &amp; magazine theme">Magzrenvi</a>
                        -
                        Premium template news, blog & magazine &amp;
                        magazine theme by <a href="http://retenvi.com" title="retenvi">RETENVI.COM</a>.
                    </p> --}}
                </div>
            </div>
        </div> <!-- modal-bialog .// -->
    </div> <!-- modal.// -->

    <script type="text/javascript" src="{{ asset('front-end/js/index.bundle.js') }}?537a1bbd0e5129401d28"></script>
    <script>
        function show ()
        {
            const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            const dias_semana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            const fecha = new Date();

            var Digital = new Date()
            var hours = Digital.getHours()
            var minutes = Digital.getMinutes()
            var seconds = Digital.getSeconds()
            var dn = "AM"

            if (hours > 12)
            {
                dn = "PM";
                hours = hours - 12;
            }

            if (hours == 0)
                hours = 12;

            if (minutes <= 9)
                minutes = "0" + minutes;

            if (seconds <= 9)
                seconds = "0" + seconds;

            $('#clock').text(
                dias_semana[fecha.getDay()] + ' ' + fecha.getDate() + ', ' + meses[fecha.getMonth()] + ' ' + fecha.getUTCFullYear() + ' | ' +
                hours + ':' + minutes + ':' + seconds + ' ' + dn
            );

            setTimeout("show()", 1000);
        }

        show();
    </script>

    {{-- enlaces shared --}}
    {!! setting()->get('shareThis.share_script') !!}
</body>
</html>