@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm">
	<h5 class="card-header bg-white font-weight-bold">
		Posts Eliminados
		<a class="btn btn-primary" href="{{ route('posts.create') }}">Crear Post</a>
		<a class="btn btn-outline-secondary" href="{{ route('posts.index') }}">
			Publicaciones
		</a>
	</h5>
	<div class="card-body bg-light">
	<div class="card-body bg-light">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
				<th>Imagen</th>
				<th>Titulo</th>
				<th>Autor</th>
				<th>Fecha de publicacion</th>
				<th>Fecha de actualizacion</th>
				<th>Acciones</th>
				</thead>

				<tbody>
				@if($trashs->count() > 0)

					@foreach($trashs as $trash)
						<tr>
							<td><img class="img-thumbnail" src="{{ $trash->image }}" width="100px" height="100"></td>

							<td>{{ $trash->title }}</td>

							<td>{{ optional($trash->user)->name }}</td>

							<td>{{ $trash->created_at->format('l d, F Y') }}</td>

							<td>{{ $trash->updated_at->format('l d, F Y') }}</td>

							<td>
								<button class="btn bg-white shadow-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
								</button>
								<div class="dropdown-menu">
									@can('only-admin', $trash)
										{{ Form::open(['url' => $trash->url->restore, 'method' => 'POST']) }}
										{{ Form::submit(__('Restaurar'), ['class' => 'dropdown-item']) }}
										{{ Form::close() }}

										{{ Form::open(['url' => $trash->url->kill, 'method' => 'DELETE']) }}
										{{ Form::submit(__('Eliminar Permanentemente'), ['class' => 'dropdown-item']) }}
										{{ Form::close() }}
									@endcan
								</div>
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
		</div>
		{{ $trashs->links() }}
	</div>
</div>

@endcomponent