@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm mb-5">
		<h5 class="card-header bg-white font-weight-bold">
			Editar Perfil
		</h5>
		<div class="card-body bg-light">
			{{ Form::open(['route' => ['profile.update', $profile->id], 'method' => 'PUT', 'files' => true]) }}

			<div class="form-group row">
				{{ Form::label('avatar', __('Avatar'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					<img class="img-thumbnail" src="{{ auth()->user()->avatar }}">
					<br><br>
					{{ Form::file('avatar', ['class' => $errors->has('avatar') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

					@if ($errors->has('avatar'))
						<span class="invalid-feedback">
			            <strong>{{ $errors->first('avatar') }}</strong>
			        </span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('facebook', __('Perfil de Facebook'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('facebook', old('facebook', $profile->facebook ), ['class' => $errors->has('facebook') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

					@if ($errors->has('facebook'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('facebook') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('instragram', __('Perfil de Instragram'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('instragram', old('instragram', $profile->instragram ), ['class' => $errors->has('instragram') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

					@if ($errors->has('instragram'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('instragram') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('twitter', __('Perfil de Twitter'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('twitter', old('twitter', $profile->twitter ), ['class' => $errors->has('twitter') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

					@if ($errors->has('twitter'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('twitter') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('youtube', __('Perfil de YouTube'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('youtube', old('youtube', $profile->youtube), ['class' => $errors->has('youtube') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

					@if ($errors->has('youtube'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('youtube') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			{{-- <div class="form-group row">
				{{ Form::label('google_plus', __('Perfil de Google Plus'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('google_plus', old('google_plus', $profile->google_plus), ['class' => $errors->has('google_plus') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

					@if ($errors->has('google_plus'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('google_plus') }}</strong>
			         </span>
					@endif
				</div>
			</div> --}}

			<div class="form-group row">
				{{ Form::label('about', __('Acerca de ti'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::textarea('about', old('about', $profile->about), ['class' => $errors->has('about') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('about'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('about') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row mb-0">
				<div class="col-md-6 offset-md-4">
					{{ Form::submit(__('Actualizar'), ['class' => 'btn btn-primary font-weight-bold']) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>

	<div class="card shadow-sm">
		<div class="card-header font-weight-bold">
			Cambiar Contraseña
		</div>
		<div class="card-body">
			{{ Form::open(['route' => 'users.change.password', 'method' => 'PUT']) }}

			<div class="form-group row">
				{{ Form::label('password_current', 'Contraseña actual', ['class' => 'col-sm-3 offset-sm-1 col-form-label']) }}
				<div class="col-sm-8">
					{{ Form::password('password_current', ['class' => 'form-control', 'required' => true]) }}
				</div>
				@if ($errors->has('password_current'))
						<span style="color: red">
						<strong>{{ $errors->first('password_current') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group row">
				{{ Form::label('password', 'Nueva contraseña', ['class' => 'col-sm-3 offset-sm-1 col-form-label']) }}
				<div class="col-sm-8">
					{{ Form::password('password', ['class' => 'form-control', 'required' => true]) }}
				</div>

				@if ($errors->has('password'))
					<span style="color: red">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group row">
				{{ Form::label('password_confirmation', 'Confirmar contraseña', ['class' => 'col-sm-3 offset-sm-1 col-form-label']) }}
				<div class="col-sm-8">
					{{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => true]) }}
				</div>
				@if ($errors->has('password_confirmation'))
					<span style="color: red">
						<strong>{{ $errors->first('password_confirmation') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group row">
				<div class="col-sm-8 offset-sm-4">
					{{ Form::submit('Actualizar Contraseña', ['class' => 'btn btn-primary  float-sm-left font-weight-bold']) }}
				</div>
			</div>

			{{ Form::close() }}
		</div>
	</div>
@endcomponent