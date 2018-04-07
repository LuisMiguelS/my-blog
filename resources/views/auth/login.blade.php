@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                {{ Form::label('email', __('Correo electrónico'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                                <div class="col-md-6">
                                    {{ Form::text('email', old('email'), ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}

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
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recuérdame') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection