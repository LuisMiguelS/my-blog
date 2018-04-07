@extends('layouts.app')

@component('admin.component.post')

	{{ Form::open(['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) }}

	<div class="row">
		<div class="col-md-8">

			<div class="card">
				<div class="card-body">
					<div class="form-group">
						{{ Form::label('title', __('Titulo'), ['class' => '']) }}

						{{ Form::text('title', old('title', $post->title), ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

						@if ($errors->has('title'))
							<span class="invalid-feedback">
			             			<strong>{{ $errors->first('title') }}</strong>
			         			</span>
						@endif
					</div>
				</div>
			</div>

			<br>

			<div class="card">
				<div class="card-body">
					<div class="form-group">

						{{ Form::textarea('content', old('content', $post->content), ['class' => $errors->has('content') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

						@if ($errors->has('content'))
							<span class="invalid-feedback">
			             			<strong>{{ $errors->first('content') }}</strong>
			         			</span>
						@endif
					</div>

					<div class="form-group">
						{{ Form::submit(__('Editar Post'), ['class' => 'btn btn-primary']) }}
					</div>
				</div>
			</div>


		</div>
		<div class="col-md-4">

			<div class="card">
				<div class="card-body">
					<div class="form-group">
						{{ Form::label('thumbnails', __('Imagen del Post'), ['class' => '']) }}

						<img src=" {{ $post->thumbnails }} " class="img-thumbnail">

						<br><br>

						{{ Form::file('thumbnails', ['class' => $errors->has('thumbnails') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

						@if ($errors->has('thumbnails'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('thumbnails') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>

			<br>

			<div class="card">
				<div class="card-body">
					<div class="form-group">
						{{ Form::label('category_id', __('Categoria'), ['class' => '']) }}

						{{ Form::select('category_id', $categories, old('category_id', $post->category_id),  ['class' => $errors->has('category_id') ? 'form-control is-invalid' : 'form-control', 'required' => true] ) }}

						@if ($errors->has('category_id'))
							<span class="invalid-feedback">
							<strong>{{ $errors->first('category_id') }}</strong>
						</span>
						@endif
					</div>
				</div>
			</div>

			<br>

			<div class="card">
				<div class="card-body">
					<div class="form-group">
						{{ Form::label('tags', __('Tags'), ['class' => '']) }}
						{{ Form::text('tags', old('tags', $tags), ['class' => $errors->has('') ? 'form-control is-invalid' : 'form-control', 'data-role' => 'tagsinput', 'required' => true]) }}

						@if ($errors->has('tags'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('tags') }}</strong>
							</span>
						@endif

					</div>
				</div>
			</div>

		</div>
	</div>

	{{ Form::close() }}

@endcomponent

@section('styles')
	<link href="{{ asset('css/tagsinput.css') }}" rel="stylesheet">
@endsection

@section('scripts')
	<script src="{{ asset('js/tagsinput.js') }}"></script>
@endsection