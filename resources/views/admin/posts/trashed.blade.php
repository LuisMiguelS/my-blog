@extends('layouts.app')

@section('content')
	
	<div class="panel panel-default">
		<div class="panel-heading"><b>Trashed Posts</b></div>

		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<th>Image</th>
					<th>Title</th>
					<th>Editing</th>
					<th>Restore</th>
					<th>Kill</th>
				</thead>

				<tbody>
					@if($posts->count() > 0)

						@foreach($posts as $post)
							<tr>
								<td><img src="{{ $post->featured }}" alt="{{ $post->title }}" width="200px"></td>
								
								<td>{{ $post->title }}</td>
								
								<td>
									<a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-info btn-sm">Edit</a>
								</td>

								<td>
									<a href="{{ route('post.restore', ['id' => $post->id]) }}" class="btn btn-success btn-sm">Restore</a>
								</td>

								<td>
									<a href="{{ route('post.kill', ['id' => $post->id]) }}" class="btn btn-danger btn-sm">Kill</a>
								</td>
							</tr>
						@endforeach

					@else
						<tr>
							<th colspan="5" class="text-center">No Trashed Post Yet.</th>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

@stop