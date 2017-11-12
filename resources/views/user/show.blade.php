@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="row" style="background-image: url('{{asset('/uploads/style/dark.png')}}');">
		<div class="col-sm-12">
			<h2 style="color:white;">{{$user->name}}'s Profile</h2>
			<div class="row">
			<div class="col-sm-2">
			{!! Html::image('uploads/avatars/'.$user->avatar, $user->title, array('style' => 'width:100px;height:100px;', 'class' => 'img-fluid img-circle')) !!}
			</div>
			<div class="col-sm-8" style="padding-top: 20px;">
				<div class="progress">
				  <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
				  	<span>MJ - Level 5: 70%</span>
				  </div>
				</div>
				<div class="progress">
				  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span><strong>PJ - Level 5 : 25%</strong></span></div>
				</div>
			</div>
			</div>
			@if (!Auth::guest() && $user->id == Auth::user()->id)
				{!! link_to_route('member.show', 'Modifier', [$user->slug], ['class' => 'btn btn-info btn-disabled']) !!}
			@endif
		</div>
	</div>
	<hr>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Informations</h3></div>
			<div class="panel-body">
				<strong>Name :</strong> {{$user->name}}<br/>
				<strong>Mail :</strong> {{$user->email}}<br/>
				<strong>Role :</strong> {{$user->role->role}}<br/>
				<strong>Member Since :</strong> {{$user->created_at}}<br/>
			</div>
		</div>
	</div>
	
	<div class="col-sm-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h3 class="panel-title">Participation</h3></div>
		<div class="panel-body">
			@foreach ($user->games as $game)
			{!! link_to_route('game.show', $game->title, [$game->slug], []) !!} the {{ $game->when }}<br>
			@endforeach
		</div>
	</div>
	</div>

	<div class="col-sm-4">
	<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Organisation</h3></div>
			<div class="panel-body">
				@foreach ($user->games as $game)
					{!! link_to_route('game.show', $game->title, [$game->slug], []) !!} the {{ Carbon\Carbon::parse($game->when)->format('d/m/Y') }}<br>
				@endforeach
			</div>
	</div>
	</div>

	<div class="col-sm-4">
	<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Articles</h3></div>
			<div class="panel-body">
				@foreach ($user->articles as $article)
					{!! link_to_route('article.show', $article->title, [$article->slug], []) !!} the {{ $article->created_at->format('d/m/Y') }}<br>
				@endforeach
			</div>
		</div>
	</div>
	</div>
	</div>
@endsection
