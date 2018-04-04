@extends('layouts.app')

@section('content')
	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading">
			<b>Create a new post</b>
		</div>

		<div class="panel-body">
			<form class="" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" placeholder="Title">
				</div>

				<div class="form-group">
					<label for="featured">Featured image</label>
					<input type="file" class="form-control" name="featured" placeholder="Featured image">
				</div>

				<div class="form-group">
					<label for="category">Select a Category</label>
					<select class="form-control" name="category_id">
						@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="tags">Select Tags</label>
					@foreach($tags as $tag)
						<div class="checkbox">
					    	<label><input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->tag }}</label>
					  	</div>
				  	@endforeach
				</div>

				<div class="form-group">
					<label for="content">Content</label>
					<textarea class="form-control" name="content" id="content" cols="5" rows="5"></textarea>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Store post!</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@stop


@section('styles')
	<!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@stop

@section('scripts')
	<!-- include summernote css/js-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    <script type="text/javascript">
		$(document).ready(function() {
	      $('#content').summernote();
	    });
	</script>
@stop