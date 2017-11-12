@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2>Create New Game or Event :)</h2>
				<div class="panel panel-default">
					<div class="panel-heading">Profil</div>
					<div class="panel-body">
						<p>
						{!! Form::open(['route' => ['game.store'], 'method' => 'post', 'files' => true, 'class' => 'form-horizontal panel', 'enctype' => 'multipart/form-data']) !!}
							<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
								{!! Form::file('cov', null, ['class' => 'form-control', 'placeholder' => 'cov']) !!}
								{!! $errors->first('cov', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
								{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
								{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('synopsis') ? 'has-error' : '' !!}">
								{!! Form::textarea('synopsis', null, ['class' => 'form-control', 'placeholder' => 'Synopsis']) !!}
                            	{!! $errors->first('synopsis', '<small class="help-block">:message</small>') !!}
							</div>
							<!-- <div class="form-group {!! $errors->has('when') ? 'has-error' : '' !!}">
								{!! Form::date('when', \Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => 'When']) !!}
                            	{!! $errors->first('when', '<small class="help-block">:message</small>') !!}
							</div> -->
							<div class="form-group {!! $errors->has('when') ? 'has-error' : '' !!}">
								{!! Form::datetime('when', \Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => 'When']) !!}
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
							{!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}
						{!! Form::close() !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection