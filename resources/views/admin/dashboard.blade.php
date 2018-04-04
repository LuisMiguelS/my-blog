@extends('layouts.app')

@section('content')
    <a href="{{ route('posts') }}">
        <div class="col-lg-3">
            <div class="panel panel-info text-center">
               <div class="panel-heading">
                   POSTED
               </div> 
               <div class="panel-body">
                   <h4>{{ $post_count }}</h4>
               </div>
            </div>
        </div>
    </a>

    <a href="{{ route('posts.trashed') }}">
        <div class="col-lg-3">
            <div class="panel panel-danger text-center">
               <div class="panel-heading">
                   TRASHED POSTS
               </div> 
               <div class="panel-body">
                   <h4>{{ $post_trashed_count }}</h4>
               </div>
            </div>
        </div>
    </a>

    <a href="{{ route('users') }}">
        <div class="col-lg-3">
            <div class="panel panel-success text-center">
               <div class="panel-heading">
                   USERS
               </div> 
               <div class="panel-body">
                   <h4>{{ $user_count }}</h4>
               </div>
            </div>
        </div>
    </a>

    <a href="{{ route('categories') }}">
        <div class="col-lg-3">
            <div class="panel panel-info text-center">
               <div class="panel-heading">
                   CATEGORIES
               </div> 
               <div class="panel-body">
                   <h4>{{ $category_count }}</h4>
               </div>
            </div>
        </div>
    </a>

@endsection
