@extends('layouts.app')

@component('component.content-admin')

    <div class="card shadow-sm">
        <h5 class="card-header bg-white font-weight-bold">Disqus Comentarios</h5>

        <div class="card-body bg-light">

            <div class="alert alert-info" role="alert">
                <ol class="font-weight-bold">
                    <li>
                        Tenga cuidado al ingresar el codigo, para el funcionamento de disqus. (Usted esta agragando codigo directamente el el proyecto)
                    </li>
                    <li>
                        Despues de que lo ingrese verifique el correcto funcionamiento del mismo accediendo a una publicacion.
                    </li>
                    <li>
                        Siga los pasos de instalacion de <a href="https://disqus.com/">disqus</a>: <a href="https://help.disqus.com/installation/universal-embed-code">Ejemplo de instalacion de disqus</a>
                    </li>
                </ol>
            </div>


            {{ Form::open(['route' => ['settings.update', 'json' => 'disqus'], 'method' => 'PUT']) }}

            <div class="form-group row">
                {{ Form::label('disqus_bloque', __('Disqus Bloque'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::textarea('disqus_bloque', old('disqus_bloque', config('disqus.bloque')), ['class' => $errors->has('disqus_bloque') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                    @if ($errors->has('disqus_bloque'))
                        <span class="invalid-feedback">
			             <strong>{{ $errors->first('disqus_bloque') }}</strong>
			         </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('disqus_script', __('Disqus Script'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::textarea('disqus_script', old('disqus_script', config('disqus.script')), ['class' => $errors->has('disqus_script') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                    @if ($errors->has('disqus_script'))
                        <span class="invalid-feedback">
			             <strong>{{ $errors->first('disqus_script') }}</strong>
			         </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    {{ Form::submit(__('Actualizar'), ['class' => 'btn btn-primary']) }}
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endcomponent