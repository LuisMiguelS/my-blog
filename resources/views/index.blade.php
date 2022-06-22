@extends('layouts.front-end')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <!-- Popular news carousel -->
            @if($carousel->count())
                <div class="card__post-carousel mb-4">
                    @include('partials.carousel', ['carousel' => $carousel->take(5)->all()])
                </div>
            @endif
            <!-- End Popular news carousel -->

            <!-- Publicidad -->
            @if($anuncio[2]->canShow)
                <figure class="mt-4 mb-4">
                    <a href="{{ $anuncio[2]->url }}">
                        <img src="{{ $anuncio[2]->banner }}" alt="" class="img-fluid image-ads image-ads-full">
                    </a>
                </figure>
            @endif
            <!-- End Publicidad -->

            @if($anuncio[3]->canShow)
                <div class="mb-4">
                    {!! $anuncio[3]->link !!}
                </div>
            @endif

            <!-- Category posts -->
            @if(count($categories))
                @include('partials.home', ['categories' => $categories, 'anuncio' => $anuncio])
            @endif
            <!-- end Category posts -->
        </div>
        <!-- End Category news -->

        <div class="col-md-4">
            <aside class="wrapper__list__article">
                <div class="wrapper__list__article-small">
                    @if($anuncio[1]->canShow)
                        <div class="mb-2">
                            {!! $anuncio[1]->link !!}
                        </div>
                    @endif

                    <!-- Post Article -->
                    @foreach($carousel->take(-2)->all() as $post)
                        <div class="article__entry mb-2">
                            <div class="article__image">
                                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                    <img src="{{ $post->image }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="article__content">
                                <div class="article__category">
                                    {{ optional($post->category)->name }}
                                </div>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <span class="text-primary">
                                            Publicado por {{ $post->user->name }}
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span class="text-dark text-capitalize">
                                            {{ $post->created_at->format('l d, F Y') }}
                                        </span>
                                    </li>
                                </ul>
                                <h5>
                                    <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    @endforeach

                    {{-- Corousel articles --}}
                    @if($carousel->count())
                        @foreach($carousel->take(5)->all() as $corousel_post)
                            <div class="mb-3">
                                <div class="card__post card__post-list">
                                    <div class="image-sm">
                                        <a href="{{ url( optional($corousel_post->category)->slug .'/'. $corousel_post->slug ) }}">
                                            <img src="{{ $corousel_post->image }}" class="img-fluid" alt="{{ $corousel_post->title }}">
                                        </a>
                                    </div>

                                    <div class="card__post__body ">
                                        <div class="card__post__content">
                                            <div class="card__post__author-info mb-2">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            Publicado por {{ $corousel_post->user->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{ $corousel_post->created_at->diffForHumans() }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="card__post__title">
                                                <h6>
                                                    <a href="{{ url( optional($corousel_post->category)->slug .'/'. $corousel_post->slug ) }}">
                                                        {{ $corousel_post->title }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{-- end Corousel articles --}}
                </div>
            </aside>

            <div class="sidebar-section">
                @include('partials.sidebar')
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

    @if($lastPost->count())
        <div class="row mt-5">
            <!-- Últimas noticias carousel -->
            <div class="col-md-12">
                <div class="wrapper__list__article">
                    {{-- <h4 class="border_section">Noticias más Recientes</h4> --}}
                    <div class="row ">
                        <div class="col-lg-12 pd-0">
                            <div class="article__entry-carousel-three">
                                @foreach($lastPost as $post)
                                    <div class="item">
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ $post->user->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span>
                                                            {{ $post->created_at->diffForHumans() }}
                                                        </span>
                                                    </li>
                                                </ul>
                                                <h5>
                                                    <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                                        {{ $post->title }}
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Últimas noticias carousel -->
        </div>
    @endif
</div>

@endsection

{{-- Tranding --}}
@section('tranding')
    @if($lastPost->count())
        <div class="bg-white">
            <!-- Tranding News Start -->
            <div class="trending-news pt-4 border-tranding">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="trending-news-inner">
                                <div class="title">
                                    {{-- <i class="fa fa-bolt"></i> --}}
                                    <strong>Últimas Noticias</strong>
                                </div>

                                <div class="trending-news-slider">
                                    @foreach($lastPost->take(-10) as $post)
                                        <div class="item-single">
                                            <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                                                {{ $post->title }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection