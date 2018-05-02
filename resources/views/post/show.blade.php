@extends('layouts.app')

@section('author', optional($post->user)->name)

@section('description', $post->meta_description)

@section('keywords', $post->meta_keywords)

@section('title', $post->title)

@component('component.content')

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

@endcomponent

@section('js')
    {!! setting()->get('disqus.disqus_script') !!}
@endsection

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