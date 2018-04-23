@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center" style="padding-bottom: 5rem">
            <div class="col-md-8">
                @include('partials.carousel')
            </div>

            <div class="col-md-4">
                <div class="card card-shadow-light">
                    <img class="card-img" src="https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-138334.jpg" alt="Ads">
                </div>
                <div class="card card-shadow-light">
                    <img class="card-img" src="https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-296623.jpg" alt="Ads">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @include('partials.home')
            </div>

            <div class="col-md-4">
                @include('partials.sidebar')
            </div>
        </div>
    </div>

@endsection