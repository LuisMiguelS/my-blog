@extends('layouts.app')

@component('component.content-admin')

	<div class="card">
		<h5 class="card-header">
			<b>Crear Un Nuevo Tag</b>
		</h5>
		<div class="card-body">
			{{ Form::open(['url' => 'admin/tags', 'method' => 'POST']) }}

			<div class="form-group row">
				{{ Form::label('tag', __('Nombre del Tag'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('tag', old('tag'), ['class' => $errors->has('tag') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('tag'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('tag') }}</strong>
			         </span>
					@endif
				</div>
			</div>

			<div class="form-group row mb-0">
				<div class="col-md-6 offset-md-4">
					{{ Form::submit(__('Crear Tag'), ['class' => 'btn btn-primary']) }}
				</div>
			</div>
			{{ Form::close() }}

		</div>
	</div>

@endcomponent