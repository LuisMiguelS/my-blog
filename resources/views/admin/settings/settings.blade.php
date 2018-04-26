@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm">
		<h5 class="card-header bg-white font-weight-bold">Configuracion Basica</h5>

		<div class="card-body bg-light">

			{{ Form::open(['route' => ['settings.update', 'json' => 'blog'], 'method' => 'PUT']) }}

			<div class="form-group row">
				{{ Form::label('site_name', __('Nombre del Blog'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

				<div class="col-md-6">
					{{ Form::text('site_name', old('site_name', config('blog.name')), ['class' => $errors->has('site_name') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

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
					{{ Form::text('address', old('address', config('blog.address')), ['class' => $errors->has('address') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

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
					{{ Form::text('contact_number', old('contact_number', config('blog.contact_number')), ['class' => $errors->has('contact_number') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

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
					{{ Form::text('contact_email', old('contact_email', config('blog.contact_email')), ['class' => $errors->has('contact_email') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

					@if ($errors->has('contact_email'))
						<span class="invalid-feedback">
			             <strong>{{ $errors->first('contact_email') }}</strong>
			         </span>
					@endif
				</div>
			</div>

            <div class="form-group row">
                {{ Form::label('blog_facebook', __('Facebook Del Blog'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::text('blog_facebook', old('blog_facebook', config('blog.facebook')), ['class' => $errors->has('blog_facebook') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

                    @if ($errors->has('blog_facebook'))
                        <span class="invalid-feedback">
			             <strong>{{ $errors->first('blog_facebook') }}</strong>
			         </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('blog_instagram', __('Instagram Del Blog'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::text('blog_instagram', old('blog_instagram', config('blog.instagram')), ['class' => $errors->has('blog_instagram') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

                    @if ($errors->has('blog_instagram'))
                        <span class="invalid-feedback">
			             <strong>{{ $errors->first('blog_instagram') }}</strong>
			         </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('blog_twitter', __('Twitter Del Blog'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::text('blog_twitter', old('blog_twitter', config('blog.twitter')), ['class' => $errors->has('blog_twitter') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

                    @if ($errors->has('blog_twitter'))
                        <span class="invalid-feedback">
			             <strong>{{ $errors->first('blog_twitter') }}</strong>
			         </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('blog_youtube', __('Youtube Del Blog'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::text('blog_youtube', old('blog_youtube', config('blog.youtube')), ['class' => $errors->has('blog_youtube') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

                    @if ($errors->has('blog_youtube'))
                        <span class="invalid-feedback">
			             <strong>{{ $errors->first('blog_youtube') }}</strong>
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