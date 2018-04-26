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
                    {!! config('shareThis.bloque') !!}

                    <h5 class="card-title">{{  $post->title }}</h5>
                    <p class="card-text"><small class="text-muted font-weight-bold">{{ $post->created_at->format('l d, F Y') }}</small>
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
                    {!! config('disqus.bloque') !!}
                </div>
            </div>

        </div>
    </div>

@endcomponent

@section('js')
    {!! config('shareThis.script') !!}
    {!! config('disqus.script') !!}
@endsection