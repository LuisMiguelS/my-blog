@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row justify-content-center" style="padding-bottom: 5rem">
            <div class="col-md-8">
                @if($carousel->count())
                    @include('partials.carousel', ['carousel' => $carousel])
                @endif
            </div>

            <div class="col-md-4">
                @foreach($sideCarousel as $post)
                    <div class="card card-shadow-light mb-4">
                        <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                            <img class="card-img" src="{{ $post->image }}">
                            <div class="card-img-overlay">
                                <h5 class="card-title text-white font-weight-bold">{{ $post->title }}</h5>
                                <p class="card-text text-white font-weight-bold">{{ optional($post->category)->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                @if($ramdom_posts->count())
                    <h4 class="font-italic font-weight-bold text-center">Ultimas Publicaciones</h4>
                    <hr>
                    @include('partials.card', ['posts' => $lastPost])
                @endif
            </div>

            <div class="col-md-4">
                @if($ramdom_posts->count())
                    <h4 class="font-italic font-weight-bold text-center">Quizas Te Pueda Interesar</h4>
                    <hr>
                    @include('partials.card', ['posts' => $ramdom_posts])
                @endif
            </div>

            <div class="col-md-4">
                @include('partials.sidebar')
            </div>
        </div>
    </div>

@endsection