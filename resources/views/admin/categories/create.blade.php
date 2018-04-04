@extends('layouts.app')

@section('content')
	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading">
			<b>Create a new Category</b>
		</div>

		<div class="panel-body">
			<form class="" action="{{ route('category.store') }}" method="POST">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" placeholder="Name">
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Store category!</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@stop