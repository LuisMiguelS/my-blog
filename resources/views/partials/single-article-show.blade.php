@if($posts->count())
	@foreach($posts as $post)
		@include('partials.single-article-post', ['post' => $post])
	@endforeach
@endif