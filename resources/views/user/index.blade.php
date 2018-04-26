@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm">
		<h5 class="card-header bg-white">
			<b>Todos los usuarios</b>
			<a class="btn btn-primary" href="{{ route('users.create') }}"> Crear Usuario</a>
		</h5>
		<div class="card-body bg-light">
			<table class="table table-hover">
				<thead>
				<th>Avatar</th>
				<th>Nombre</th>
				<th>Rol</th>
				<th>Acciones</th>
				</thead>

				<tbody>
				@if($users->count())

					@foreach($users as $user)
						<tr>
							<td><img class="rounded-circle"  src="{{ $user->avatar }}" alt="{{ $user->name }}" width="50px" height="50px"></td>

							<td>{{ $user->name }}</td>

							<td>
								{{ $user->role }}
							</td>

							<td>
								<button class="btn bg-white shadow-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
								</button>
								<div class="dropdown-menu">
									@can('update', $user)
										<a class="dropdown-item" href="{{ $user->url->edit }}">Editar</a>
									@endcan

									@can('delete', $user)
										{{ Form::open(['url' => $user->url->delete, 'method' => 'DELETE']) }}
										{{ Form::submit(__('Eliminar'), ['class' => 'dropdown-item']) }}
										{{ Form::close() }}
									@endcan

								</div>
							</td>
						</tr>
					@endforeach

				@else
					<tr>
						<th colspan="5" class="text-center">No Users Yet.</th>
					</tr>
				@endif
				</tbody>
			</table>

			{{ $users->links() }}
		</div>
	</div>

@endcomponent