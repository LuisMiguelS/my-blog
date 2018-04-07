@extends('layouts.app')

@component('admin.component.content')

<div class='card'>
    <h5 class="card-header">
        <b>Edit Role: {{$role->name}}</b>
    </h5>

    <div class="card-body">
        {{ Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) }}

        <div class="form-group row">
            {{ Form::label('name', __('Rol'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

            <div class="col-md-6">
                {{ Form::text('name', old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                     <strong>{{ $errors->first('name') }}</strong>
                 </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('permission', __('Assign Permissions'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

            <div class="col-md-6">
                @foreach ($permissions as $permission)
                    {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                    {{Form::label($permission->name, ucfirst($permission->name)) }}<br>
                @endforeach
                @if ($errors->has('permission'))
                    <span class="invalid-feedback">
                     <strong>{{ $errors->first('permission') }}</strong>
                 </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                {{ Form::submit('Editar', ['class' => 'btn btn-primary']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div>
</div>

@endcomponent