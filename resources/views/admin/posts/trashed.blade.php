@extends('layouts.app')

@component('admin.component.content')

	<div class="card">
	<h5 class="card-header">
		<b>Posts Eliminados</b>
		<a class="btn btn-primary" href="{{ route('posts.create') }}">Crear Post</a>
		<a class="btn btn-outline-primary" href="{{ route('posts.index') }}">
			Publicaciones
		</a>
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
			@if($trashs->count() > 0)

				@foreach($trashs as $trash)
					<tr>
						<td><img src="{{ $trash->featured }}" alt="{{ $trash->title }}" width="200px"></td>

						<td>{{ $trash->title }}</td>

						<td>
							<a href="{{ route('post.edit', ['id' => $trash->id]) }}" class="btn btn-info btn-sm">Edit</a>
						</td>

						<td>
							<a href="{{ route('post.restore', ['id' => $trash->id]) }}" class="btn btn-success btn-sm">Restore</a>
						</td>

						<td>
							<a href="{{ route('post.kill', ['id' => $trash->id]) }}" class="btn btn-danger btn-sm">Kill</a>
						</td>
					</tr>
				@endforeach

			@else
				<tr>
					<th colspan="5" class="text-center">No hay publicaciones en la papelera</th>
				</tr>
			@endif
			</tbody>
		</table>
		{{ $trashs->links() }}
	</div>
</div>

@endcomponent