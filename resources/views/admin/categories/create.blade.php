@extends('layouts.app')

@component('admin.component.content')

		<div class="card">
			<h5 class="card-header">
				<b>Crear Una Nueva Categoria</b>
			</h5>
			<div class="card-body">
				{{ Form::open(['route' => 'categories.store', 'method' => 'POST']) }}

				<div class="form-group row">
					{{ Form::label('name', __('Categoria'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

					<div class="col-md-6">
						{{ Form::text('name', old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

						@if ($errors->has('name'))
							<span class="invalid-feedback">
				             <strong>{{ $errors->first('name') }}</strong>
				         </span>
						@endif
					</div>
				</div>


				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
						{{ Form::submit(__('Crear Categoria'), ['class' => 'btn btn-primary']) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>

@endcomponent