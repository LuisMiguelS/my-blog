@extends('layouts.app')


@component('component.content-admin')

	<div class="card shadow-sm">
		<h5 class="card-header bg-white font-weight-bold">
			Tag Publicados
			<a class="btn btn-outline-primary" href="{{ url('admin/tags/create') }}"> Crear Tags</a>
		</h5>
		<div class="card-body bg-light">
			<table class="table table-hover">
				<thead>
				<th>Tag</th>
				<th>Acciones</th>
				</thead>

				<tbody>
				@if($tags->count() > 0)

					@foreach($tags as $tag)
						<tr>
							<td>{{ $tag->tag }}</td>

							<td>
								<button class="btn bg-white shadow-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
								</button>
								<div class="dropdown-menu">
									@can('edit', $tag)
										<a href="{{ url($tag->url->edit) }}" class="dropdown-item">Editar</a>
									@endcan

									@can('delete', $tag)
										{{ Form::open(['url' => url($tag->url->delete), 'method' => 'DELETE']) }}
										{{ Form::submit(__('Eliminar'), ['class' => 'dropdown-item']) }}
										{{ Form::close() }}
									@endcan

								</div>
							</td>
						</tr>
					@endforeach

				@else
					<tr>
						<th colspan="5" class="text-center">No Tags Yet.</th>
					</tr>
				@endif
				</tbody>
			</table>

			{{ $tags->links() }}
		</div>
	</div>

@endcomponent