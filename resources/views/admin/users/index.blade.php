@extends('layouts.app')

@component('admin.component.content')

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
							<td><img class="rounded-circle"  src="{{ optional($user->profile)->avatar }}" alt="{{ $user->name }}" width="50px" height="50px"></td>

							<td>{{ $user->name }}</td>

							<td></td>

							<td>
								{{ Form::open(['url' => $user->url->delete, 'method' => 'DELETE']) }}
									{{ Form::submit(__('Eliminar'), ['class' => 'btn btn-danger btn-sm']) }}
								{{ Form::close() }}
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
		</div>
	</div>

@endcomponent