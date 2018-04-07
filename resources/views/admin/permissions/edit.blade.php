@extends('layouts.app')

@component('admin.component.content')

<div class='card'>


    <h5 class="card-header">
        Edit {{$permission->name}}
    </h5>

    <div class="card-body">
        {{ Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'PUT']) }}

        <div class="form-group">
            {{ Form::label('name', 'Permission Name') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
        <br>
        {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}

        {{ Form::close() }}
    </div>
</div>

@endcomponent