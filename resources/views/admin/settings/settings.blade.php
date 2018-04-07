@extends('layouts.app')

@component('admin.component.content')

	<div class="card">
		<h5 class="card-header"><b>Edit Blog Settings</b></h5>

		<div class="card-body">

			{{ Form::model($settings,['route' => ['settings.update', $settings->id], 'method' => 'PUT']) }}

			<div class="form-group row">
				{{ Form::label('site_name', __('Nombre del Blog'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('site_name', old('site_name'), ['class' => $errors->has('site_name') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('site_name'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('site_name') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('address', __('Direccion'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('address', old('address'), ['class' => $errors->has('address') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('address'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('address') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('contac_number', __('Numero de contacto'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('contact_number', old('contact_number'), ['class' => $errors->has('contact_number') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('contact_number'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('contact_number') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('contact_email', __('Email de contacto'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('contact_email', old('contact_email'), ['class' => $errors->has('contact_email') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('contact_email'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('contact_email') }}</strong>
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