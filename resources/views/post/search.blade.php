@extends('layouts.app')

@component('component.content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            @if($posts->count())

                @foreach($posts as $post)

                    <div class="card mb-3">
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