@extends('layouts.app')

@section('content')
	
	<div class="panel panel-default">
		<div class="panel-heading"><b>Registered Users</b></div>

		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<th>Image</th>
					<th>Name</th>
					<th>Permissions</th>
					<th>Delete</th>
				</thead>

				<tbody>
					@if($users->count() > 0)

						@foreach($users as $user)
							<tr>
								<td><img src="{{ $user->profile->avatar }}" alt="{{ $user->name }}" width="90px" height="90px" style="border-radius: 50%"></td>
								
								<td>{{ $user->name }}</td>
								
								<td>
									@if($user->admin)
										<a href="{{ route('user.not-admin', ['id' => $user->id]) }}" class="btn btn-danger btn-sm">Remove permissions</a>
									@else
										<a href="{{ route('user.admin', ['id' => $user->id]) }}" class="btn btn-success btn-sm">Make admin</a>
									@endif
								</td>

								<td>
									@if(Auth::id() !== $user->id)
										<a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-warning btn-sm">Delete</a>
									@endif
								</td>
							</tr>
						@endforeach

					@else
						<tr>
							<th colspan="5" class="text-center">No Users Yet.</th>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

@stop