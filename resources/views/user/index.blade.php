@extends('layouts.app')

@component('component.content-admin')

	<div class="card">
		<h5 class="card-header">
			<b>Todos los usuarios</b>
			<a class="btn btn-primary" href="{{ route('users.create') }}"> Crear Usuario</a>
		</h5>
		<div class="card-body">
			<table class="table table-hover">
				<thead>
				<th>Avatar</th>
				<th>Nombre</th>
				<th>Rol</th>
				<th>Acciones</th>
				</thead>

				<tbody>
				@if($users->count() > 0)

					@foreach($users as $user)
						<tr>
							<td><img class="rounded-circle"  src="{{ $user->avatar }}" alt="{{ $user->name }}" width="50px" height="50px"></td>

							<td>{{ $user->name }}</td>

							<td>
								{{ $user->role }}
							</td>

							<td>
								<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{ $user->url->edit }}">Editar</a>
									{{ Form::open(['url' => $user->url->delete, 'method' => 'DELETE']) }}
									{{ Form::submit(__('Eliminar'), ['class' => 'dropdown-item']) }}
									{{ Form::close() }}
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