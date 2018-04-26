@extends('layouts.app')

@component('component.content-admin')

    <div class="card-deck">
        <div class="card shadow-sm">
            <h5 class="card-header bg-success text-white text-center font-weight-bold">Post</h5>
            <div class="card-body bg-success text-left">
                <a class="text-white font-italic font-weight-bold" href="{{ route('posts.index') }}">
                    <p class="card-text">Publicados:
                        @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() )
                            @php
                                echo $posts->filter(function ($value) {
                                    return $value->status === \App\Post::PUBLISHED;
                                })->count();
                            @endphp
                        @else
                            @php
                                echo $posts->filter(function ($value) {
                                    return $value->status === \App\Post::PUBLISHED && $value->user_id === auth()->id();
                                })->count();
                            @endphp
                        @endif
                    </p>
                </a>

                <a class="text-white font-italic font-weight-bold" href="{{ route('posts.draft') }}">
                    <p class="card-text">Borradores:
                        @php
                            echo $posts->filter(function ($value) {
                                return $value->status === \App\Post::DRAFT && $value->user_id === auth()->id();
                            })->count();
                        @endphp
                    </p>
                </a>

                @can('only-admin')
                    <a class="text-white font-italic font-weight-bold" href="{{ route('posts.index') }}">
                        <p class="card-text">Eliminados: {{ $post_trashed_count }}</p>
                    </a>
                @endcan
            </div>
        </div>

        @can('only-admin')
        <div class="card shadow-sm">
            <h5 class="card-header bg-danger bg-success text-white text-center font-weight-bold">Usuarios</h5>
            <div class="card-body bg-danger">
                <a class="text-white font-italic font-weight-bold" href="{{ route('posts.index') }}">
                    <p class="card-text">Registrados: {{ $user_count }}</p>
                </a>

                <a class="text-white font-italic font-weight-bold" href="">
                    <p class="card-text">Eliminador: {{ $user_trashed_count }}</p>
                </a>

            </div>
        </div>
        @endcan

        <div class="card shadow-sm">
            <h5 class="card-header bg-info bg-success text-white text-center font-weight-bold">Categorias</h5>
            <div class="card-body bg-info">
                <a class="text-white font-italic font-weight-bold" href="{{ route('posts.index') }}">
                    <p class="card-text">Creadas: {{ $category_count }}</p>
                </a>

                @can('only-admin')
                    <a class="text-white font-italic font-weight-bold" href="">
                        <p class="card-text">Eliminadas: {{ $category_trashed_count }}</p>
                    </a>
                @endcan
            </div>
        </div>

        <div class="card shadow-sm">
            <h5 class="card-header bg-secondary text-white text-center font-weight-bold">Tags</h5>
            <div class="card-body bg-secondary">
                <a class="text-white font-italic font-weight-bold" href="{{ route('posts.index') }}">
                    <p class="card-text">Creadas: {{ $tag_count }}</p>
                </a>

                @can('only-admin')
                    <a class="text-white font-italic font-weight-bold" href="">
                        <p class="card-text">Eliminadas: {{ $tag_trashed_count }}</p>
                    </a>
                @endcan

            </div>
        </div>
    </div>

@endcomponent