@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2>Création d'un nouvel article</h2>
				<div class="panel panel-default">
					<div class="panel-heading">Profil</div>
					<div class="panel-body">
						<p>
						{!! Form::open(['route' => ['article.store'], 'method' => 'post', 'files' => true, 'class' => 'form-horizontal panel', 'enctype' => 'multipart/form-data']) !!}
							<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
								{!! Form::file('cov', null, ['class' => 'form-control', 'placeholder' => 'cov']) !!}
								{!! $errors->first('cov', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
								{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titre de votre article']) !!}
								{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
							</div>
							<div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
								{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Contenu']) !!}
                            	{!! $errors->first('content', '<small class="help-block">:message</small>') !!}
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