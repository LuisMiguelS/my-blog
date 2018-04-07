@extends('layouts.app')

@component('admin.component.content')

<div class='card'>
    <h5 class="card-header"> Add Role</h5>
    <div class="card-body">
        {{ Form::open(array('url' => 'roles')) }}

        <div class="form-group row">
            {{ Form::label('name', __('Name'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

            <div class="col-md-6">
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class='form-group row mb-0'>
            {{ Form::label('permissions', __('Assign Permissions'), ['class' => 'col-md-4 col-form-label text-md-right']) }}
            <div class="col-md-6">
                @foreach ($permissions as $permission)
                    {{ Form::checkbox('permissions[]',  $permission->id ) }}
                    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                @endforeach
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div>
</div>

@endcomponent