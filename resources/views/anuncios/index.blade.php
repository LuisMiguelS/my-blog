@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm">
		<h5 class="card-header bg-white font-weight-bold">
			Configurar Anuncios del Sitio
		</h5>

		<div class="card-body bg-light">
			<table class="table table-hover">
				<thead>
					<th>No.</th>
					<th>Anuncio</th>
					<th>¿Mostrar?</th>
					<th>Acciones</th>
				</thead>
				<tbody>
				@if($anuncios->count() > 0)
					@foreach($anuncios as $anuncio)
						<tr>
							<td>{{ $anuncio->id_anuncio }}</td>

							<td>{{ $anuncio->descripcion }}</td>

							<td>
								@if($anuncio->mostrar == 1)
									<span class="badge badge-pill badge-success" style="padding: 10px 20px;">Sí</span>
								@else
									<span class="badge badge-pill badge-danger" style="padding: 10px 20px;">No</span>
								@endif
							</td>

							<td>
								<button class="btn bg-white shadow-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
								</button>

								<div class="dropdown-menu">
									@can('update', $anuncio)
										<a class="dropdown-item" href="{{ route('anuncios.edit', $anuncio->id_anuncio) }}">Editar</a>
									@endcan

									@if($anuncio->mostrar)
										{{ Form::open(['url' => route('anuncios.destroy', $anuncio->id_anuncio), 'method' => 'DELETE']) }}
										{{ Form::submit(__('No mostrar'), ['class' => 'dropdown-item']) }}
										{{ Form::close() }}
									@else
										{{ Form::open(['url' => route('anuncios.restore', $anuncio->id_anuncio), 'method' => 'UPDATE']) }}
										{{ Form::submit(__('Mostrar'), ['class' => 'dropdown-item']) }}
										{{ Form::close() }}
									@endif
								</div>
							</td>
						</tr>
					@endforeach
				@endif
				</tbody>
			</table>
		</div>
	</div>

@endcomponent