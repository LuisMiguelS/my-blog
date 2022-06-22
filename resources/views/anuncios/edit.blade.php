@extends('layouts.app')

@component('component.content-admin')

	<div class="card shadow-sm">
		<h5 class="card-header bg-white font-weight-bold">
			Editar Anuncio No. {{ $anuncio->id_anuncio }}
		</h5>
		<div class="card-body bg-light">
			{{ Form::open(['url' => route('anuncios.update', $anuncio->id_anuncio), 'method' => 'PUT', 'files' => true]) }}

			<p>{{ $anuncio->descripcion }}</p>

			<div class="form-group">
				<label for="link"><strong>Link:</strong></label> <br>
				
				@if($anuncio->requiere_imagen)
					<span>Indicar una dirección web si deseas que al momento de hacer clic sobre este anuncio, el mismo redireccione a otro sitio web <strong>(esto es opcional)</strong>.</span>
				@else
					<span>Indica en este espacio el código generado por YouTube para compartir el vídeo.</span>
				@endif

				<textarea class="form-control" type="text" name="link" id="link" autocomplete="off" rows="8">{{ $anuncio->link }}</textarea>
			</div>

			@if($anuncio->requiere_imagen)
				<div class="form-group">
					<label for="image"><strong>Imagen: </strong></label> <br>
					<img class="img-thumbnail text-center mb-3" src="{{ $anuncio->banner }}" width="@if($anuncio->lateral) 40% @else 80% @endif" style="display: block; margin: 0 auto;">
					<input class="form-control" type="file" name="image" id="image" autocomplete="off">
				</div>
			@else
				{!! $anuncio->link !!}
			@endif

			<div class="form-group">
				<label for="mostrar"><strong>Mostrar:</strong></label> <br>
				<span>Indica si deseas mostrar este anuncio a los visitantes de la página o simplemente quieres ocultarlo.</span>
				<select class="form-control" name="mostrar" id="mostrar" autocomplete="off">
					<option value="1" @if($anuncio->mostrar) selected="" @endif>Sí</option>
					<option value="0" @if(! $anuncio->mostrar) selected="" @endif>No</option>
				</select>
			</div>

			<div class="form-group row mb-0">
				<div class="col-md-6 offset-md-4">
					{{ Form::submit(__('Actualizar anuncio'), ['class' => 'btn btn-primary']) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>

@endcomponent