@extends('layouts.app')

@component('component.content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            @isset($search['q'])
                <h1 class="font-weight-bold mb-5" >Resultados de busqueda:  <span class="text-primary">{{ $search['q'] }}</span></h1>
            @endisset

            @if($posts->count())

                @foreach($posts as $post)

                    <div class="card shadow-sm mb-5">
                        <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                            <img class="card-img-top" src="{{ $post->image }}" height="400">
                        </a>

                        <div class="card-body">
                            <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                <h5 class="card-title">{{ $post->title }}</h5>
                            </a>

                            <p class="card-text">
                                {{ $post->excerpt }}
                            </p>

                            <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                <small class="card-text">
                                    Leer mas...
                                </small>
                            </a>

                        </div>
                    </div>

                @endforeach

            @else
                <div class="alert alert-info font-weight-bold" role="alert">
                    No hay Resultados para la busqueda.
                </div>
            @endif


            {{ $posts->links() }}
        </div>
    </div>

@endcomponent

@section('css')
    <style>
        .navbar-brand {
            color: #fff !important;
        }
        .navbar-laravel {
            background-color: #343a40!important;
        }
        .nav-link {
            color: #FFF !important;
        }
        .nav-link:hover,
        .nav-link:focus{
            color: #FFF !important;
            border-bottom: 2px solid #FFF !important;
        }
        .navbar-toggler {
            color: rgba(255,255,255,.5) !important;
            border-color: rgba(255,255,255,.1) !important;
        }
    </style>
@endsection