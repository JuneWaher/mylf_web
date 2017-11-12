@extends('layouts.app')

@section('content')
	<div class="container" style="min-height: 100%;">
		<div class="row">
			<div class="col-3">
				<div class="panel panel-default">
					<div class="panel-heading"><h4 class="panel-title">Where</h4></div>
					<div class="panel-body">{{ $game->where }}</div>
					<div class="panel-heading"><h4 class="panel-title">When</h4></div>
					<div class="panel-body">{{ $game->when }}</div>
				</div>
			</div>
			<div class="col-8">
				<div class="panel panel-default">
					<div class="panel-heading"><h4 class="panel-title">
						{{ $game->title }} <span class="label label-{{ $game->status == 'ACTIVE' ? 'success' : 'danger' }} pull-right" style="font-size:1em;">{{ $game->status }}</span></h4>
					</div>
					<div class="panel-body">
					<p class="text-justify">{!! Html::image('uploads/avatars/'.$game->cov, 'avatar', array('style' => 'max-height:150px;', 'class' => 'img-fluid pull-left col-sm-3')) !!}
					{{ $game->synopsis }}</p>
					</div>
					<div class="panel-heading"><h4 class="panel-title">Players<span class="label {{ $game->pj_current < $game->pj_limit ? 'label-success' : 'label-danger'}} pull-right" style="font-size:1em;">{{$game->pj_current}} / {{$game->pj_limit}}</span></h4>
					</div>
					<div class="panel-body">
					@if (empty($game->users))
						<p>No player yet !</p>
					@else
						@foreach ($game->users as $user)
							<div class="col-sm-3">
							<p class="text-center">	{!! Html::image('uploads/avatars/'.$user->avatar, $user->title, array('style' => 'width:100px;height:100px;', 'class' => 'img-fluid img-circle ')) !!}<br>
							{!! link_to_route('member.show', $user->name, [$user->slug], ['class' => 'text-center']) !!}</p>
							</div>
						@endforeach
					@endif
					</div>
					<div class="panel-footer">
						@if (!Auth::guest() && $game->status != 'ACTIVE')
							<strong>Sorry, the game is {{ $game->status }}</strong>
						@elseif (!Auth::guest() && $game->pj_current >= $game->pj_limit)
							<strong>Sorry, no more place :(</strong>
						@elseif (!Auth::guest())
							@if (!! !$game->users->find(Auth::user()->id))
								{!! Form::open(['route' => ['game.sub', $game], 'method' => 'post']) !!}
									{!! Form::submit('Subscribe', ['class' => 'btn btn-success clearfix pull-right']) !!}<div class="clearfix"></div>
								{!! Form::close() !!}
							@else
								{!! Form::open(['route' => ['game.unsub', $game], 'method' => 'post']) !!}
									{!! Form::submit('Unsubscribe', ['class' => 'btn btn-danger pull-right clearfix']) !!}<div class="clearfix"></div>
								{!! Form::close() !!}
							@endif
						@else
							<strong>You must log in to subscribe :)</strong>
						@endif
					</div>
				</div>
			</div>
			@if((!Auth::guest() && $game->user_id == Auth::user()->id) || (!Auth::guest() && Auth::user()->role_id <= 2))
				{!! Form::open(['route' => ['game.edit', $game], 'method' => 'get']) !!}
					{!! Form::submit('Edit', ['class' => 'btn btn-info pull-right clearfix']) !!}<div class="clearfix"></div>
				{!! Form::close() !!}
			@endif
		</div>
	</div>
@endsection