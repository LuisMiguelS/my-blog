@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm">
		<h5 class="card-header bg-white font-weight-bold">
			Editar Tag: {{ $tag->tag }}
		</h5>
		<div class="card-body bg-light">
			{{ Form::model($tag,['url' => $tag->url->update, 'method' => 'PUT']) }}

			<div class="form-group row">
				{{ Form::label('tag', __('Nombre del tag'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

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
					{{ Form::submit(__('Editar Tag'), ['class' => 'btn btn-primary']) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>

@endcomponent