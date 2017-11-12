@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2>Edit [{{ $game->title }}]</h2>
				<div class="panel panel-default">
					<div class="panel-heading">Profil</div>
					<div class="panel-body">
						<p>
						{!! Form::model($game, ['route' => ['game.update', $game], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
							<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
								{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
								{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('synopsis') ? 'has-error' : '' !!}">
								{!! Form::textarea('synopsis', null, ['class' => 'form-control', 'placeholder' => 'Synopsis']) !!}
                            	{!! $errors->first('synopsis', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('when') ? 'has-error' : '' !!}">
								{!! Form::date('when', null, ['class' => 'form-control', 'placeholder' => 'When']) !!}
                            	{!! $errors->first('when', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('where') ? 'has-error' : '' !!}">
								{!! Form::text('where', null, ['class' => 'form-control', 'placeholder' => 'Where']) !!}
                            	{!! $errors->first('where', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('pj_limit') ? 'has-error' : '' !!}">
								{!! Form::number('pj_limit', null, ['class' => 'form-control', 'placeholder' => 'Pj Limit']) !!}
                            	{!! $errors->first('pj_limit', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('status') ? 'has-error' : '' !!}">
								{!! Form::select('status', ['ACTIVE' => 'ACTIVE','CANCELED' => 'CANCELED','ENDED' => 'ENDED'], ['class' => 'form-control', 'placeholder' => 'Pj Limit']) !!}
                            	{!! $errors->first('status', '<small class="help-block">:message</small>') !!}
							</div>
							{!! Form::submit('Edit', ['class' => 'btn btn-primary pull-right']) !!}
						{!! Form::close() !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection