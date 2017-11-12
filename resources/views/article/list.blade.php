@extends('layouts.app')

@section('content')
	<div class="container">
	@if (!Auth::guest() && Auth::user()->isRole('PNJ') != 'PNJ')
		{!! link_to_route('article.create', 'Créer', [], ['class' => 'btn btn-success pull-right']) !!}<div class="clearfix" style="margin-bottom: 10px;"></div>
	@endif
	@foreach ($articles as $article)
		<div class="panel panel-success">
		  <div class="panel-heading">
		    <h3 class="panel-title">
		    {!! link_to_route('article.show', $article->title, [$article->slug]) !!}</h3>
		  </div>
		  <div class="panel-body">{{ $article->summary }}</div>
		  <div class="panel-footer"></div>
		</div>
	@endforeach
	{!! $articles->links() !!}
	</div>
@endsection