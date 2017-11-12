@extends('layouts.app')

@section('content')
<div class="container">
	<div class="jumbotron jumbotron-fluid" style="background-color: white">
	  <div class="container">
	    <h1 class="display-3">Fluid jumbotron</h1>
	    <p class="lead">This is a modified jumbotron that occupies
	                    the entire horizontal space of its parent.</p>
	  </div>
	</div>
	
	@foreach ($articles as $article)
		<div class="col-sm-3">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>{{$article->title}}</h4></div>
				<div class="panel-body">{{$article->summary}}</div>
				<div class="panel-footer">
					{!! link_to_route('article.show', 'Read', [$article->slug], ['class' => 'btn btn-default']) !!}
				</div>
			</div>
		</div>
	@endforeach

	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Incoming Events</h4></div>
			<div class="panel-body">
				@foreach ($games as $game)
				<ul class="list-group" style="list-style-type:none">
					<li>{!! link_to_route('game.show', $game->title, [$game->slug], []) !!} the {{$game->when}}</li>
				</ul>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection