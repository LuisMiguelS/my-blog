@extends('layouts.app')

@section('content')
	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading"><b>Edit Blog Settings</b></div>

		<div class="panel-body">
			<form class="" action="{{ route('setting.update') }}" method="POST">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="site_name">Site name</label>
					<input type="text" class="form-control" name="site_name" value="{{ $setting->site_name }}">
				</div>

				<div class="form-group">
					<label for="site_name">Address</label>
					<input type="text" class="form-control" name="address" value="{{ $setting->address }}">
				</div>

				<div class="form-group">
					<label for="site_name">Contact phone</label>
					<input type="text" class="form-control" name="contact_number" value="{{ $setting->contact_number }}">
				</div>

				<div class="form-group">
					<label for="site_name">Contact email</label>
					<input type="text" class="form-control" name="contact_email" value="{{ $setting->contact_email }}">
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Update site settings!</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@stop