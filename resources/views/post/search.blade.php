@extends('layouts.front-end')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            @isset($search['q'])
                <div class="wrap__search-result">
                    <div class="wrap__search-result-keyword">
                        <h2>
                            Resultados de la búsqueda:
                            <span class="text-primary">
                                {{ $search['q'] }}
                            </span> <br>
                            {{ $posts->total() }} resultados encontrados.
                        </h2>
                    </div>
                </div>
            @endisset

            @if($posts->count())
                <!-- Post Article List -->
                @foreach($posts as $post)
                    <div class="card__post card__post-list card__post__transition mt-30">
                        <div class="row ">
                            <div class="col-md-5">
                                <div class="card__post__transition">
                                    <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                        <img src="{{ $post->image }}" class="img-fluid w-100" alt="{{ $post->title }}">
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-7 my-auto pl-0">
                                <div class="card__post__body ">
                                    <div class="card__post__content  ">
                                        @if(! empty($post->category->name))
                                            <div class="card__post__category ">
                                                {{ $post->category->name }}
                                            </div>
                                        @endif

                                        <div class="card__post__author-info mb-2">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        Publicado por {{ $post->user->name }}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="text-dark text-capitalize">
                                                        {{ $post->created_at->diffForHumans() }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="card__post__title">
                                            <h5>
                                                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h5>
                                            <p class="d-none d-lg-block d-xl-block mb-0">
                                                {{ $post->excerpt }}...
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="div-navigation">
                {{ $posts->appends(['q' => request()->q])->links() }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="sidebar-section">
                @include('partials.sidebar')
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

@endsection


@section('css')
    <style type="text/css">
        .pagination { display: flex; }
        .div-navigation { display: flex; justify-content: center; }
    </style>
@endsection