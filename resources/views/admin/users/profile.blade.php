@extends('layouts.app')

@component('admin.component.content')

	<div class="card">
		<h5 class="card-header">
			<b>Editar tu Perfil</b>
		</h5>
		<div class="card-body">
			{{ Form::open(['route' => ['profile.update', $profile->id], 'method' => 'PUT', 'files' => true]) }}


			<div class="form-group row">
				{{ Form::label('avatar', __('Avatar'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					<img class="img-thumbnail" src="{{ $profile->avatar }}">
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
				{{ Form::label('facebook', __('Perfil de facebook'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('facebook', old('facebook', $profile->facebook ), ['class' => $errors->has('facebook') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('facebook'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('facebook') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('youtube', __('Perfil de youtube'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('youtube', old('youtube', $profile->youtube), ['class' => $errors->has('youtube') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('youtube'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('youtube') }}</strong>
			         </span>
					@endif
				</div>
			</div>

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
					{{ Form::submit(__('Actualizar'), ['class' => 'btn btn-primary']) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endcomponent