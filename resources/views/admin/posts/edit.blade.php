@extends('layouts.app')

@section('content')
	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading">
			<b>Edit Post: {{ $post->title }}</b>
		</div>

		<div class="panel-body">
			<form class="" action="{{ route('post.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" placeholder="title" value="{{ $post->title }}">
				</div>

				<div class="form-group">
					<label for="featured">Featured new image</label>
					<input type="file" class="form-control" name="featured" placeholder="Featured image">
				</div>

				<div class="form-group">
					<label for="category">Select a new Category</label>
					<select class="form-control" name="category_id">
						@foreach($categories as $category)
							<option value="{{ $category->id }}"

								@if($post->category->id == $category->id)
									selected=""
								@endif

							>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="tags">Select Tags</label>
					@foreach($tags as $tag)
						<div class="checkbox">
					    	<label><input type="checkbox" name="tags[]" value="{{ $tag->id }}"

					    		@foreach($post->tags as $t)
					    			@if($tag->id == $t->id)
					    				checked="" 
					    			@endif
					    		@endforeach

					    	>{{ $tag->tag }}</label>
					  	</div>
				  	@endforeach
				</div>

				<div class="form-group">
					<label for="content">Content</label>
					<textarea class="form-control" name="content" id="content" cols="5" rows="5">{!! $post->content !!}</textarea>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Update post!</button>
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