@extends('layouts.app')

@component('component.content-admin')

	<div class="card">
	<h5 class="card-header">
		<b>Posts Eliminados</b>
		<a class="btn btn-primary" href="{{ route('posts.create') }}">Crear Post</a>
		<a class="btn btn-outline-primary" href="{{ route('posts.index') }}">
			Publicaciones
		</a>
	</h5>
	<div class="card-body">
		<div class="table-responsive">
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
							<td><img class="img-thumbnail" src="{{ $trash->image }}" width="100px" height="100"></td>

							<td>{{ $trash->title }}</td>

							<td>{{ optional($trash->user)->name }}</td>

							<td>
								<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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