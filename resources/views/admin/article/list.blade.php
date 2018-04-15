@extends('layouts.admin')

@section('content')
	<div class="container">
		<h2>Article List</h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Couverture</th>
				<th>Title</th>
				<th>Summary</th>
				<th>Voir</th>
				<th>Supprimer</th>
			</tr>
		</thead>
		<tbody>
			@foreach($articles as $article)
				<tr class="">
					<td>{!! Html::image('uploads/avatars/'.$article->avatar, $article->name, array('class' => 'img-fluid img-circle', 'style' => 'max-height:50px;')) !!}</td>
					<td>{{ $article->title }}</td>
					<td>{{ $article->summary }}</td>
					
					<td>
						{!! link_to_route('article.show', 'See', [$article->slug], ['class' => 'btn btn-warning btn-sm']) !!}
					</td>
					
					<td>
					{!! Form::open(['route' => ['article.destroy', $article], 'method' => 'delete']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
					{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $articles->links() !!}
	</div>
@endsection