@extends('layouts.app')

@component('component.content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card mb-3">
                <img class="card-img-top" src="{{ $post->image }}" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{  $post->title }}</h5>

                    <button class="btn bg-secondary btn-sm">Compartir en Facebook</button>
                    <button class="btn bg-secondary btn-sm">Compartir en Twitter</button>
                    <button class="btn bg-secondary btn-sm">Compartir en Otro....</button>
                    <p class="card-text"><small class="text-muted">{{ optional($post->user)->name .' '. $post->created_at }}</small></p>
                    <p class="card-text">{{ $post->body }}</p>

                    <p class="card-text">Autor: {{  optional($post->user)->name  }} Mas siguelo en <br>
                        <button class="btn bg-secondary btn-sm">Facebook</button>
                        <button class="btn bg-secondary btn-sm">Twitter</button>
                        <button class="btn bg-secondary btn-sm">Instagram</button>
                    </p>
                </div>
            </div>

        </div>
    </div>

@endcomponent