@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header font-weight-bold">
                    Restablecer la contraseña
                </div>

                <div class="card-body">
                    {{ Form::open(['route' => 'password.email', 'method' => 'POST']) }}

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

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Enviar enlace de restablecimiento de contraseña') }}
                            </button>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
