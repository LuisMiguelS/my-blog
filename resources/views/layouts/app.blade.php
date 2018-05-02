<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="@yield('author')">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')  {{ setting()->get('blog.site_name') ?? config('app.name','Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">

    @yield('css')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
                <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">
                    {{--<img src="{{ asset('recursos/imagenes/nav-logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">--}}
                    {{ setting()->get('blog.site_name') ?? config('app.name','Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    @if(!$admin_nav)
                        @include('partials.nav-menu')
                    @else
                        @include('partials.nav-menu-admin')
                    @endif
                </div>
        </div>
    </nav>

    @if(!$admin_nav && $hide)
        @include('partials.search')
    @endif



    <main class="py-4">
        @yield('content')
    </main>

    @if($hide)
        @include('partials.footer', ['category' => $category_footer, 'ramdom' => $ramdom_posts])
    @endif

</div>

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>

        $('.deleteConfirmation').click(() => {
            return confirm('¿Estás seguro?, ¡Se eliminaran tambien los registros que dependen de este!');
        });
    </script>

    @if(setting()->get('ads.script'))
        {!! setting()->get('ads.ads_script') !!}
    @endif

    @if(setting()->get('shareThis.share_script') && !$admin_nav)
        {!! setting()->get('shareThis.share_script') !!}
    @endif

    @yield('js')
</body>
</html>