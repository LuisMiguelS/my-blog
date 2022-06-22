@extends('layouts.front-end')

@section('author', optional($post->user)->name)
@section('description', $post->meta_description)
@section('keywords', $post->meta_keywords)
@section('title', $post->title)
@section('image', $post->image)
@section('url', url(optional($post->category)->slug .'/'. $post->slug ))

@section('content')

    <section class="bg-white pb-60 pt-0">
        <div class="container">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> Inicio</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="/{{ $post->category->slug }}" class="breadcrumbs__url">{{ $post->category->name }}</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            {{ $post->title }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <!-- Article detail -->
                <div class="col-md-8">
                    <div class="wrap__article-detail">
                        <div class="wrap__article-detail-image">
                            <figure>
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid">
                            </figure>
                        </div>

                        <div class="wrap__article-detail-title">
                            <h1>
                                {{ $post->title }}
                            </h1>
                        </div>
                        <hr>

                        <div class="wrap__article-detail-info">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <figure class="image-profile">
                                        <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="img-fluid img-circle" style="height: 40px; width: 40px;">
                                    </figure>
                                </li>

                                <li class="list-inline-item">
                                    <span>
                                        Publicado por
                                    </span>
                                    <span style="color: #c00;">
                                        {{ $post->user->name }}
                                    </span>
                                </li>

                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        {{ $post->created_at->format('l d, F Y') }}
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="wrap__article-detail-content">
                            {!! $post->body !!}
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    @if($post->tags->count())
                        <div class="blog-tags">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <i class="fa fa-tags">
                                    </i>
                                </li>

                                @foreach($post->tags as $tag)
                                    <li class="list-inline-item">
                                        <a href="{{ url("tags/{$tag->slug}") }}">
                                            #{{ $tag->tag }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Profile author -->
                    <div class="wrap__profile mt-5">
                        <div class="wrap__profile-author">
                            <figure class="mr-0">
                                <img src="{{ $post->user->avatar }}" alt="{{ optional($post->user)->name }}" class="img-fluid rounded-circle" style="height: 100px; width: 100px;">
                            </figure>

                            <div class="wrap__profile-author-detail">
                                <div class="wrap__profile-author-detail-name">Autor</div>
                                <h4>{{ optional($post->user)->name }}</h4>
                                <p>
                                    {{ $post->user->profile->about }}
                                </p>
                                <ul class="list-inline">
                                    @if(optional(optional($post->user)->profile)->facebook)
                                        <li class="list-inline-item">
                                            <a href="{{ $post->user->profile->facebook }}" class="btn btn-social btn-social-o facebook ">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if(optional(optional($post->user)->profile)->twitter)
                                        <li class="list-inline-item">
                                            <a href="{{ $post->user->profile->twitter }}" class="btn btn-social btn-social-o twitter ">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if(optional(optional($post->user)->profile)->instragram)
                                        <li class="list-inline-item">
                                            <a href="{{ $post->user->profile->instragram }}" class="btn btn-social btn-social-o instagram ">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if(optional(optional($post->user)->profile)->youtube)
                                        <li class="list-inline-item">
                                            <a href="{{ $post->user->profile->youtube }}" class="btn btn-social btn-social-o youtube ">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Disqus --}}
                    <div class="card shadow-sm">
                        <div class="card-body">
                            {!! setting()->get('disqus.disqus_bloque') !!}
                        </div>
                    </div>

                    <div class="wrapper__list__article mt-5">
                        <h4 class="border_section">Te podría interesar...</h4>

                        {{-- Noticias relacionadas --}}
                        @include('partials.single-article-show', ['posts' => $lastPost])
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="sidebar-section">
                        @include('partials.sidebar', ['page' => 1])
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


{{-- @component('component.content')

    <div class="row">
        <div class="col-md-12">

            <div class="card shadow-sm mb-5">
                <img class="card-img-top" src="{{ $post->image }}" alt="{{ $post->title }}">
                <div class="card-body">
                    <h4 class="card-title">{{  $post->title }}</h4>

                    <p class="card-text">
                        <small class="text-muted font-weight-bold">{{ $post->created_at->format('l d, F Y') }}</small>
                    </p>

                    <p class="card-text">{!! $post->body !!}</p>
                </div>
                <div class="card-footer bg-white">
                    <p class="card-text"><b>Autor :</b> {{  optional($post->user)->name  }}</p>

                    @if(optional(optional($post->user)->profile)->about)
                        <p class="card-text"><b>Acerca del autor :</b> {{ $post->user->profile->about }} </p>
                    @endif

                    <p class="float-right font-weight-bold">
                            @if(optional(optional($post->user)->profile)->facebook)
                                <a href="{{ $post->user->profile->facebook }}" class="fab fa-facebook-square social-btn-round"></a>
                            @endif

                            @if(optional(optional($post->user)->profile)->instragram)
                                <a href="{{ $post->user->profile->instragram }}" class="fab fa-instagram social-btn-round"></a>
                            @endif

                            @if(optional(optional($post->user)->profile)->twitter)
                                <a href="{{ $post->user->profile->twitter }}" class="fab fa-twitter social-btn social-btn-round shadow-sm"></a>
                            @endif

                            @if(optional(optional($post->user)->profile)->youtube)
                                <a href="{{ $post->user->profile->twitter  }}" class="fab fa-youtube social-btn-round"></a>
                            @endif

                            @if(optional(optional($post->user)->profile)->google_plus)
                                <a href="{{ $post->user->profile->google_plus }}" class="fab fa-google-plus social-btn-round"></a>
                            @endif
                    </p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    {!! setting()->get('disqus.disqus_bloque') !!}
                </div>
            </div>

        </div>
    </div>

@endcomponent --}}

@section('js')
    {!! setting()->get('disqus.disqus_script') !!}
@endsection