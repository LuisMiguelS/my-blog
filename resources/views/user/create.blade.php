@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm">
		<h5 class="card-header bg-white font-weight-bold">
			Crear un nuevo usuario
		</h5>

		<div class="card-body bg-light">
			{{ Form::open(['route' => 'users.store', 'method' => 'POST']) }}

			<div class="form-group row">
				{{ Form::label('name', __('Nombre'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

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
				{{ Form::label('email', __('Email'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::email('email', old('email'), ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('email'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('role', __('Rol'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::select('role', [\App\User::READER_ROLE => 'Lector', \App\User::AUTHOR_ROLE => 'Autor', \App\User::ADMIN_ROLE => 'Admin'], old('status'),  ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control'] ) }}

					@if ($errors->has('role'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('role') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group row">
				{{ Form::label('password', __('Contraseña'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('password'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('password_confirmation', __('Confirmar contraseña'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::password('password_confirmation', ['class' => $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('password_confirmation'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('password_confirmation') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row mb-0">
				<div class="col-md-8 offset-md-4">
					<button type="submit" class="btn btn-primary">
						{{ __('Crear Usuario') }}
					</button>
				</div>
			</div>

			{{ Form::close() }}
        </div>
    </div>

@endcomponent