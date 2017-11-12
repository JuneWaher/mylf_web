@extends('layouts.admin')

@section('content')
	<div class="container">
		<h1>Hello Admin {{Auth::user()->name}}</h1>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<h3 class="panel-heading">Articles</h1>
				<div class="panel-body">
					<h2>{{ $articles->count() }} Articles.</h2>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-default">
				<h3 class="panel-heading">Games</h1>
				<div class="panel-body">
					<h2>{{ $games->count() }} Games.</h2>
					<ul>
						<li>{{ $games->where('status', 'ACTIVE')->count() }} Active</li>
						<li>{{ $games->where('status', 'PENDING')->count() }} Pending</li>
						<li>{{ $games->where('status', 'ENDED')->count() }} Ended</li>
						<li>{{ $games->where('status', 'CANCELED')->count() }} Canceled</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-default">
				<h3 class="panel-heading">Users</h1>
				<div class="panel-body">
					<h2>{{ $users->count() }} Users.</h2>
					<ul>
						<li>{{ $users->where('role_id', 2)->count() }} Bureau</li>
						<li>{{ $users->where('role_id', 3)->count() }} MJs</li>
						<li>{{ $users->where('role_id', 4)->count() }} PJs</li>
						<li>{{ $users->where('role_id', 5)->count() }} PNJs</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection