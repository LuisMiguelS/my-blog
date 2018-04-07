@extends('layouts.app')

@component('admin.component.content')

	<div class="card">
		<h5 class="card-header">
			<b>Create a new User</b>
		</h5>

		<div class="card-body">
			{{ Form::open(['route' => 'users.store', 'method' => 'POST']) }}

			<div class="form-group">
				{{ Form::label('name', 'Name') }}
				{{ Form::text('name', '', array('class' => 'form-control')) }}
			</div>

			<div class="form-group">
				{{ Form::label('email', 'Email') }}
				{{ Form::email('email', '', array('class' => 'form-control')) }}
			</div>

			<div class='form-group'>
				@foreach ($roles as $role)
					{{ Form::checkbox('roles[]',  $role->id ) }}
					{{ Form::label($role->name, ucfirst($role->name)) }}<br>

				@endforeach
			</div>

			<div class="form-group">
				{{ Form::label('password', 'Password') }}<br>
				{{ Form::password('password', array('class' => 'form-control')) }}

			</div>

			<div class="form-group">
				{{ Form::label('password', 'Confirm Password') }}<br>
				{{ Form::password('password_confirmation', array('class' => 'form-control')) }}

			</div>

			{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

			{{ Form::close() }}
        </div>
    </div>

@endcomponent