@extends('layouts.app')

@component('admin.component.content')

        <div class="card">
            <h5 class="card-header">Post</h5>
            <div class="card-body">
                <h4>{{ $post_count }}</h4>
                <a href="{{ route('posts.index') }}">Click</a>
            </div>
        </div>

        <br>

        <div class="card">
            <h5 class="card-header">Post Eliminados</h5>
            <div class="card-body">
                <h4>{{ $post_trashed_count }}</h4>
                <a href="">Click</a>
            </div>
        </div>

        <br>

        <div class="card">
            <h5 class="card-header">Usuarios</h5>
            <div class="card-body">
                <h4>{{ $user_count }}</h4>
                <a href="{{ route('users.index') }}">Click</a>
            </div>
        </div>

        <br>

        <div class="card">
            <h5 class="card-header">Categorias</h5>
            <div class="card-body">
                <h4>{{ $category_count }}</h4>
                <a href="{{ route('categories.index') }}">Click</a>
            </div>
        </div>

@endcomponent