@extends('layouts.app')

@component('admin.component.content')

<div class='card'>

    <h5 class="card-header">
        <b>Add Permission</b>
    </h5>

    <div class="card-body">
        {{ Form::open(array('url' => 'permissions')) }}

        <div class="form-group row">
            {{ Form::label('name', __('Permiso'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

            <div class="col-md-6">
                {{ Form::text('name', old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                     <strong>{{ $errors->first('name') }}</strong>
                 </span>
                @endif
            </div>
        </div>

        @if(!$roles->isEmpty())
            <div class="form-group row">
                {{ Form::label('name', __('Assignar a algun rol'), ['class' => 'col-md-4 col-form-label text-md-right']) }}
                @foreach ($roles as $role)
                    <div class="col-md-2">
                    {{ Form::checkbox('roles[]',  $role->id ) }}
                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
            </div>
        </div>

        {{ Form::close() }}
    </div>

</div>

@endcomponent