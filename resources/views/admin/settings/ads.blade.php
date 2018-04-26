@extends('layouts.app')

@component('component.content-admin')

    <div class="card shadow-sm">
        <h5 class="card-header bg-white font-weight-bold">Bloque de anucios</h5>

        <div class="card-body bg-light">

            <div class="alert alert-info" role="alert">
                <ol class="font-weight-bold">
                    <li>
                        Tenga cuidado al ingresar el codigo, para el funcionamento de los anucios. (Usted esta agragando codigo directamente el el proyecto)
                    </li>
                    <li>
                        Despues de que lo ingrese verifique el correcto funcionamiento del mismo visitando el inicio de la pagina.
                    </li>
                </ol>
            </div>


            {{ Form::open(['route' => ['settings.update', 'json' => 'ads'], 'method' => 'PUT']) }}

            <div class="form-group row">
                {{ Form::label('ads_top', __('Bloque de anucio Superior'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::textarea('ads_top', old('ads_top', config('ads.ads_top')), ['class' => $errors->has('ads_top') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                    @if ($errors->has('ads_top'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ads_top') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('ads_side', __('Bloque de anucio lateral'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::textarea('ads_side', old('disqus_script', config('ads.ads_side')), ['class' => $errors->has('ads_side') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                    @if ($errors->has('ads_side'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ads_side') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('ads_bottom', __('Bloque de anucio inferior'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::textarea('ads_bottom', old('ads_bottom', config('ads.ads_bottom')), ['class' => $errors->has('ads_bottom') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                    @if ($errors->has('ads_bottom'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ads_bottom') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('ads_script', __('Script del anucio'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">
                    {{ Form::textarea('ads_script', old('ads_script', config('ads.ads_script')), ['class' => $errors->has('ads_script') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                    @if ($errors->has('ads_script'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ads_script') }}</strong>
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