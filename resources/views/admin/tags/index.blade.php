@extends('layouts.app')


@component('admin.component.content')

	<div class="card">
		<h5 class="card-header">
			<b>Tag Publicados</b>
			<a class="btn btn-outline-secondary" href="{{ route('tags.create') }}"> Crear Tags</a>
		</h5>
		<div class="card-body">
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
								<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
								<div class="dropdown-menu">
									<a href="{{ route('tags.edit', ['id' => $tag->id]) }}" class="dropdown-item">Editar</a>
									{{ Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) }}
									{{ Form::submit(__('Eliminar'), ['class' => 'dropdown-item']) }}
									{{ Form::close() }}
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