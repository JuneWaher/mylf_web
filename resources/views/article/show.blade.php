@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="col-8">
		<h2>{{$article->title}}</h2>
		{!! Html::image('uploads/avatars/'.$article->cov, $article->title, array('style' => '', 'class' => 'img-fluid pull-left')) !!}
		By : {!! link_to_route('member.show', $article->user->name, [$article->user->slug], []) !!} the {{ $article->created_at }}<br>
		<p class="text-justify">
			{{$article->content}}
		</p>
		</div>
	</div>
@endsection