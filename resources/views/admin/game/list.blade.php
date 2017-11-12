@extends('layouts.admin')

@section('content')
	<div class="container">
		<h2>Games List</h2>
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
			@foreach($games as $game)
				<tr class="bg-{{$game->status == 'PENDING' ? 'warning' : ''}}{{$game->status == 'ACTIVE' ? 'success' : ''}}{{$game->status == 'ENDED' ? 'danger' : ''}}">
					<td>{!! Html::image('uploads/avatars/'.$game->cov, $game->title, array('class' => 'img-fluid img-circle', 'style' => 'max-height:50px;')) !!}</td>
					<td>{{ $game->title }}</td>
					<td>{{ $game->summary }}</td>
					<td>{{ $game->when }}</td>
					<td>{{ $game->pj_current }} / {{ $game->pj_limit }}</td>
					<td>{{ $game->status }}</td>
					<td>
					{!! link_to_route('game.show', 'See', [$game->slug], ['class' => 'btn btn-warning btn-sm']) !!}</td>
					<td>
						{!! link_to_route('game.edit', 'Edit', [$game->slug], ['class' => 'btn btn-info btn-sm']) !!}</td>
					</td>
					<td>
					{!! Form::open(['route' => ['admin.game.promote', $game], 'method' => 'post']) !!}
						{!! Form::submit('Promote', ['class' => 'btn btn-success btn-sm']) !!}
					{!! Form::close() !!}
					{!! Form::open(['route' => ['admin.game.demote', $game], 'method' => 'post']) !!}
						{!! Form::submit('Demote', ['class' => 'btn btn-danger btn-sm']) !!}
					{!! Form::close() !!}
					</td>
					<td>
					{!! Form::open(['route' => ['game.destroy', $game], 'method' => 'delete']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
					{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $games->links() !!}
	</div>
@endsection