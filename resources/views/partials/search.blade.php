<!-- Search bar.// -->
<ul class="navbar-nav ">
    <li class="nav-item search hidden-xs hidden-sm ">
        <a class="nav-link" href="#">
            <i class="fa fa-search"></i>
        </a>
    </li>
</ul>

<!-- Search content bar.// -->
<div class="top-search navigation-shadow">
    <div class="container">
        <div class="input-group ">
            <form action="{{ url('search') }}" method="GET">
                <div class="row no-gutters mt-3">
                    <div class="col">
                        <input class="form-control border-secondary border-right-0 rounded-0 {{ $errors->has('q') ? 'form-control is-invalid' : 'form-control' }}"
                        name="q" type="search" value="{{ old('q') }}" placeholder="Buscar...">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <div class="container-fluid bg-white">
    <div class="row" style="border-top: 1px solid #ecf0f1;">
        <div class="col-md-3">
            <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=America%2FSanto_Domingo" width="90%" height="95" frameborder="0" seamless>
            </iframe>
        </div>
        <div class="col-md-6">
            {!! setting()->get('ads.ads_top') !!}
        </div>
        <div class="col-md-3">
            <form class="ml-3 my-auto d-inline w-100" action="{{ url('search') }}" method="get">
                <div class="input-group">
                    <input type="text" class="border-right-0 {{ $errors->has('q') ? 'form-control is-invalid' : 'form-control' }}" name="q" value="{{ old('q') }}" placeholder="BUSQUEDA">
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark border-left-0" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    @if ($errors->has('q'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('q') }}</strong>
                        </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div> --}}