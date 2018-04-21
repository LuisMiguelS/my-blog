@extends('layouts.app')

@component('admin.component.content')

	<div class="card">
		<h5 class="card-header">
			<b>Posts Publicados</b>
			<a class="btn btn-primary" href="{{ route('posts.create') }}">Crear Post</a>
			<a class="btn btn-outline-primary" href="{{ route('posts.draft') }}">
				Borradores
                @if($drafts > 0)
                    ({{$drafts}})
                @endif
            </a>
			<a class="btn btn-outline-danger" href="{{ route('posts.trashed') }}">Post Eliminados</a>
		</h5>
		<div class="card-body">
			<table class="table table-hover">
				<thead>
				<th>Imagen</th>
				<th>Titulo</th>
				<th>Autor</th>
				<th>Acciones</th>
				</thead>

				<tbody>
				@if($posts->count() > 0)

					@foreach($posts as $post)
						<tr>
							<td><img class="img-thumbnail" src="{{ $post->image }}" width="100px" height="100"></td>

							<td>{{ $post->title }}</td>

							<td>{{ $post->user->name }}</td>

							<td>
								<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
								</button>
								<div class="dropdown-menu">
									@can('update', $post)
										<a  class="dropdown-item" href="{{ $post->url->edit }}" >Editar</a>
									@endcan

									@can('delete', $post)
										{{ Form::open(['url' => $post->url->delete, 'method' => 'DELETE']) }}
										{{ Form::submit(__('Eliminar'), ['class' => 'dropdown-item']) }}
										{{ Form::close() }}
									@endcan
								</div>
							</td>
						</tr>
					@endforeach

				@else
					<tr>
						<th colspan="5" class="text-center">Sin publicaciones aún.</th>
					</tr>
				@endif
				</tbody>
			</table>
			{{--{{ $posts->links() }}--}}
		</div>
	</div>

@endcomponent