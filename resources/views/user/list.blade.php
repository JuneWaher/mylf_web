@extends('layouts.app')

@section('content')
	<div class="container">
	@foreach($users as $user)
	<div class="col-sm-2" style="margin-bottom: 10px; max-height: 300px;">
		<div class="card">
		  {!! Html::image('uploads/avatars/'.$user->avatar, 'avatar', array('style' => '', 'class' => 'img-fluid')) !!}
		  <div class="card-block">
		    <h5 class="card-title block">{{ $user->name }}</h5>
		    <p class="card-text {{ $user->role->role == 'ADMIN' ? 'text-warning' : '' }}{{ $user->role->role == 'BUREAU' ? 'text-danger' : '' }}{{ $user->role->role == 'MJ' ? 'text-success' : '' }}{{ $user->role->role == 'PJ' ? 'text-info' : '' }}">
		    	<strong>{{ $user->role->role }}</strong>
		    </p>
		  </div>
			<div class="card-footer">
				{!! link_to_route('member.show', 'Voir le profil', [$user->slug], ['class' => 'btn btn-primary']) !!}
			</div>
		</div>
	</div>
	@endforeach
	<div class="col-sm-12">
		{!! $users->links() !!}
	</div>
	</div>
@endsection
