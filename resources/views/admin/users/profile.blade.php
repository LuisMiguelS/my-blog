@extends('layouts.app')

@section('content')
	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading"><b>Edit your profile</b></div>

		<div class="panel-body">
			<form class="" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="name">Username</label>
					<input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
				</div>

				<div class="form-group">
					<label for="password">New password</label>
					<input type="password" class="form-control" name="password" placeholder="New password">
				</div>

				<div class="form-group">
					<label for="avatar">Upload new Avatar</label>
					<input type="file" class="form-control" name="avatar">
				</div>

				<div class="form-group">
					<label for="facebook">Facebook profile</label>
					<input type="text" class="form-control" name="facebook" placeholder="Facebook profile" value="{{ $user->profile->facebook }}">
				</div>

				<div class="form-group">
					<label for="youtube">YouTube profile</label>
					<input type="text" class="form-control" name="youtube" placeholder="YouTube profile" value="{{ $user->profile->youtube }}">
				</div>

				<div class="form-group">
					<label for="about">About you!</label>
					<textarea class="form-control" name="about" cols="6" rows="6">{{ $user->profile->about }}</textarea>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Update profile!</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@stop