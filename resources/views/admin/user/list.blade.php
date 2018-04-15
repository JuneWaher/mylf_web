@extends('layouts.admin')

@section('content')
	<div class="container">
		<h2>Liste d'Utilisateurs</h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Couverture</th>
				<th>Title</th>
				<th>Summary</th>
				<th>When</th>
				<th>Pjs</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr class="">
					<td>{!! Html::image('uploads/avatars/'.$user->avatar, $user->name, array('class' => 'img-fluid img-circle', 'style' => 'max-height:50px;')) !!}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->role->role }}</td>
					<td>
						@foreach($user->games as $game)
							{!! link_to_route('game.show', $game->title, [$game->slug]) !!}</td>
						@endforeach
					</td>
					
					<td>
						{!! link_to_route('member.show', 'See', [$user->slug], ['class' => 'btn btn-warning btn-sm']) !!}
					</td>
					
					<td>
					{!! Form::open(['route' => ['admin.user.promote', $user], 'method' => 'post']) !!}
						{!! Form::submit('Promote', ['class' => 'btn btn-success btn-sm']) !!}
					{!! Form::close() !!}
					{!! Form::open(['route' => ['admin.user.demote', $user], 'method' => 'post']) !!}
						{!! Form::submit('Demote', ['class' => 'btn btn-danger btn-sm']) !!}
					{!! Form::close() !!}
					</td>
					
					<td>
					{!! Form::open(['route' => ['user.destroy', $user], 'method' => 'delete']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
					{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $users->links() !!}
	</div>
@endsection