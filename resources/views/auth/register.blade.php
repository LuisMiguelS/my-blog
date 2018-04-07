@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registro') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                {{ Form::label('name', __('Nombre'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                                <div class="col-md-6">
                                    {{ Form::text('name', old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                         <strong>{{ $errors->first('name') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('email', __('Correo electrónico'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                                <div class="col-md-6">
                                    {{ Form::email('email', old('email'), ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('password', __('Contraseña'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                                <div class="col-md-6">
                                    {{ Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('password-confirm', __('Confirmar contraseña'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                                <div class="col-md-6">
                                    {{ Form::password('password-confirm', ['class' => $errors->has('password-confirm') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

                                    @if ($errors->has('password-confirm'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {{ Form::submit(__('Registrar'), ['class' => 'btn btn-primary']) }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection