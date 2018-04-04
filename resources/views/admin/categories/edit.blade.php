@extends('layouts.app')

@section('content')
	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading">
			<b>Edit Category: {{ $category->name }}</b>
		</div>

		<div class="panel-body">
			<form class="" action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" placeholder="Name" value="{{ $category->name }}">
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Update category!</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@stop