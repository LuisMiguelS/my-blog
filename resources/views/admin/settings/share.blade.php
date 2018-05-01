@extends('layouts.app')

@component('component.content-admin')

    <div class="card shadow-sm">
        <h5 class="card-header bg-white font-weight-bold">Compartir en Redes Sociales</h5>

        <div class="card-body bg-light">

            <div class="alert alert-info" role="alert">
                <ol class="font-weight-bold">
                    <li>
                        Tenga cuidado al ingresar el codigo, para el funcionamento de los anucios. (Usted esta agragando codigo directamente el el proyecto)
                    </li>
                    <li>
                        Despues de que lo ingrese verifique el correcto funcionamiento del mismo visitando una publicacion en la pagina.
                    </li>
                    <li>
                        Registrese y pegue los codigos aqui: <a href="https://platform.sharethis.com/get-the-code">ShareThis</a>
                        o <a href="https://platform.sharethis.com/get-inline-share-buttons">Sitio de configuracion</a>
                    </li>
                </ol>
            </div>

            {{ Form::open(['route' => ['settings.update', 'json' => 'shareThis'], 'method' => 'PUT']) }}

            <div class="form-group row">
                {{ Form::label('share_block', __('Bloque de codigo'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::textarea('share_block', old('share_block', setting()->get('shareThis.share_block')), ['class' => $errors->has('share_block') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                    @if ($errors->has('share_block'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('share_block') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('share_script', __('ShareThis Script'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::textarea('share_script', old('share_script', setting()->get('shareThis.share_script')), ['class' => $errors->has('share_script') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                    @if ($errors->has('share_script'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('share_script') }}</strong>
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