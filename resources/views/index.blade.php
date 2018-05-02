@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center" style="padding-bottom: 5rem">
            <div class="col-md-8">
                @if($carousel->count())
                    @include('partials.carousel', ['carousel' => $carousel->take(5)->all()])
                @endif
            </div>

            <div class="col-md-4">
                @foreach($carousel->take(-2)->all() as $post)
                    <div class="card card-shadow-light mb-4">
                        <a href="{{ url( optional($post->category)->slug .'/'. $post->slug ) }}">
                            <img class="card-img" src="{{ $post->image }}">
                            <div class="card-img-overlay">
                                <h5 class="card-title text-white img-title">{{ $post->title }}</h5>
                                <p class="card-text text-white img-tag">{{ optional($post->category)->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @foreach($categories as $index => $category)
                    @include('partials.home', ['category' => $category, 'color' => $index])
                @endforeach
            </div>
            <div class="col-md-4">
                @include('partials.sidebar')
            </div>
        </div>

    </div>

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