@extends('layouts.app')

@section('content')
	<div class="container">
	@if (!Auth::guest() && Auth::user()->isRole('PNJ') != 'PNJ')
		{!! link_to_route('game.create', 'Créer', [], ['class' => 'btn btn-success pull-right']) !!}<div class="clearfix" style="margin-bottom: 10px;"></div>
	@endif
	@foreach ($games as $game)
	<div class="row">
	<div class="col-sm-12" style="padding: 10px;">
		<div class="media"style="background: white; border:2px black;">
		<div class="col-sm-3" >
		  {!! Html::image('uploads/avatars/'.$game->cov, 'avatar', array('style' => 'max-height:150px; height:150px;', 'class' => 'img-fluid')) !!}
		  </div>
		  <div class="media-body">
		    <h5 class="mt-0"><strong>{!! link_to_route('game.show', $game->title, [$game->slug]) !!}</strong> - <span class="label label-success">{{ $game->status }}</span> - <span class="label label-success">{{$game->pj_current}} / {{$game->pj_limit}}</span></h5>
		    <p>Le {{ Carbon\Carbon::parse($game->when)->format('d/m/Y h:m') }} à {{ $game->where }}
		    </p>
		    <p>{{ $game->summary }}...</p>
		  </div>
		</div>
		</div>
	</div>
	@endforeach
	{!! $games->links() !!}
	</div>
@endsection