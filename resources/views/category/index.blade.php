@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm">
		<h5 class="card-header bg-white font-weight-bold">
			Categorías Publicadas
			<a class="btn btn-outline-primary" href="{{ url('admin/categories/create') }}">
				Crear Categoria
			</a>
		</h5>
		<div class="card-body bg-light">
			<table class="table table-hover">
				<thead>
				<th>Category name</th>
				<th>Fecha de creacion</th>
				<th>Fecha de actualizacion</th>
				<th>Acciones</th>
				</thead>

				<tbody>
				@if($categories->count() > 0)

					@foreach($categories as $category)
						<tr>
							<td>{{ $category->name }}</td>

							<td>{{ $category->created_at->format('l d, F Y') }}</td>

							<td>{{ $category->updated_at->format('l d, F Y') }}</td>

							<td>
								<button class="btn bg-white shadow-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
								</button>
								<div class="dropdown-menu">
									@can('update', $category)
										<a class="dropdown-item" href="{{ url($category->url->edit) }}">Editar</a>
									@endcan

									@can('delete', $category)
										{{ Form::open(['url' => $category->url->delete, 'method' => 'DELETE']) }}
										{{ Form::submit(__('Eliminar'), ['class' => 'dropdown-item deleteConfirmation']) }}
										{{ Form::close() }}
									@endcan
								</div>
							</td>
						</tr>
					@endforeach

				@else
					<tr>
						<th colspan="5" class="text-center">No Categories Yet.</th>
					</tr>
				@endif
				</tbody>
			</table>

			{{ $categories->links() }}
		</div>
	</div>

@endcomponent