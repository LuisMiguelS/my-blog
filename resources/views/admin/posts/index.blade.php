@extends('layouts.app')

@component('admin.component.content')

	<div class="card">
		<h5 class="card-header">
			<b>Post Publicados</b>
			<a class="btn btn-primary" href="{{ route('posts.create') }}">Crear Post</a>
			<a class="btn btn-secondary" href="">Borrador</a>
			<a class="btn btn-outline-danger" href="">Post Eliminados</a>
		</h5>
		<div class="card-body">
			<table class="table table-hover">
				<thead>
				<th>Image</th>
				<th>Title</th>
				<th>Acciones</th>
				</thead>

				<tbody>
				@if($posts->count() > 0)

					@foreach($posts as $post)
						<tr>
							<td><img class="img-thumbnail" src="{{ $post->thumbnails }}" width="150px"></td>

							<td>{{ $post->title }}</td>

							<td>
								<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
								<div class="dropdown-menu">
									<a  class="dropdown-item" href="{{ route('posts.edit', ['id' => $post->id]) }}" >Editar</a>
									{{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) }}
									{{ Form::submit(__('Eliminar'), ['class' => 'dropdown-item']) }}
									{{ Form::close() }}
								</div>
							</td>
						</tr>
					@endforeach

				@else
					<tr>
						<th colspan="5" class="text-center">No Post Yet.</th>
					</tr>
				@endif
				</tbody>
			</table>
			{{ $posts->links() }}
		</div>
	</div>

@endcomponent