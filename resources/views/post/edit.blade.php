@extends('layouts.app')

@component('component.post')

	{{ Form::model($post, ['url' => $post->url->update, 'method' => 'PUT', 'files' => true]) }}

	<div class="row">

		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">
						Titulo Del Post
						<small>Este es el título de tu publicacion</small>
					</h6>
					<div class="form-group">
						{{ Form::text('title', old('title'), ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

						@if ($errors->has('title'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('title') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h6 class="card-title">
						Contenido Del Post
					</h6>
					<div class="form-group">
						{{ Form::textarea('body', old('body'), ['class' => $errors->has('body') ? 'form-control is-invalid' : 'form-control', 'required' => true, 'id' => 'body']) }}

						@if ($errors->has('body'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('body') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h6 class="card-title">
						Extracto <small>Pequeña descripción del post</small>
					</h6>
					<div class="form-group">
						{{ Form::textarea('excerpt', old('excerpt'), ['class' => $errors->has('excerpt') ? 'form-control is-invalid' : 'form-control', 'required' => true, 'rows' => 2]) }}

						@if ($errors->has('excerpt'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('excerpt') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-4">

			<div class="card">
				<div class="card-header text-white bg-danger">
					Detalles de publicación
				</div>
				<div class="card-body">
					<div class="form-group">
						{{ Form::label('status', __('Estado Del Post'), ['class' => '']) }}

						{{ Form::select('status', [\App\Post::DRAFT => 'Borrador', \App\Post::PUBLISHED => 'Publicado'], old('status'),  ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control'] ) }}

						@if ($errors->has('status'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('status') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						{{ Form::label('category_id', __('Categoria'), ['class' => '']) }}

						{{ Form::select('category_id', $categories, old('category_id'),  ['class' => $errors->has('category_id') ? 'form-control is-invalid' : 'form-control', 'required' => true] ) }}

						@if ($errors->has('category_id'))
							<span class="invalid-feedback">
							<strong>{{ $errors->first('category_id') }}</strong>
						</span>
						@endif
					</div>

					@if($tags->count())
						<div class="form-group">
							{{ Form::label('tags', __('Tags'), ['class' => '']) }}
							{{ Form::select('tags[]', $tags, old('tags'),  ['class' => $errors->has('tags') ? 'form-control is-invalid' : 'form-control', 'id' => 'tags',  'multiple' => 'multiple'] ) }}

							@if ($errors->has('tags'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('tags') }}</strong>
								</span>
							@endif
						</div>
					@endif
				</div>
			</div>

			<div class="card">
				<div class="card-header text-white bg-success mb-3">
					Imagen Del Post
				</div>
				<div class="card-body">
					<div class="form-group">
						<img src=" {{ $post->image }} " class="img-thumbnail">

						{{ Form::file('image', ['class' => $errors->has('image') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}

						@if ($errors->has('image'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header text-white bg-primary mb-3">
					SEO
				</div>
				<div class="card-body">
					<div class="form-group">
						{{ Form::label('seo_title', __('Titulo SEO'), ['class' => '']) }}

						{{ Form::text('seo_title', old('seo_title'), ['class' => $errors->has('seo_title') ? 'form-control is-invalid' : 'form-control']) }}

						@if ($errors->has('seo_title'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('seo_title') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						{{ Form::label('meta_description', __('Meta Description'), ['class' => '']) }}

						{{ Form::textarea('meta_description', old('meta_description'), ['class' => $errors->has('meta_description') ? 'form-control is-invalid' : 'form-control', 'required' => true, 'rows' => 2]) }}

						@if ($errors->has('meta_description'))
							<span class="invalid-feedback">
			             			<strong>{{ $errors->first('meta_description') }}</strong>
			         			</span>
						@endif
					</div>

					<div class="form-group">
						{{ Form::label('meta_keywords', __('Meta Kewwords'), ['class' => '']) }}

						{{ Form::textarea('meta_keywords', old('meta_keywords'), ['class' => $errors->has('meta_keywords') ? 'form-control is-invalid' : 'form-control', 'required' => true, 'rows' => 2]) }}

						@if ($errors->has('meta_keywords'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('meta_keywords') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>

			<div class="form-group">
				{{ Form::submit(__('Editar Post'), ['class' => 'btn btn-primary  btn-block']) }}
			</div>

		</div>
	</div>
	{{ Form::close() }}

@endcomponent