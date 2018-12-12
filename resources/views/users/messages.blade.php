@extends('layout')

@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li role="presentation"><a href="{{ route('profile', [$user->user, $user->id]) }}">Perfil</a></li>
						<li role="presentation"><a href="{{ route('personal_topics', [$user->user, $user->id]) }}">Temas</a></li>
						<li role="presentation" class="active"><a href="{{ route('messages', [$user->user, $user->id]) }}">Mensajes</a></li>
						@if (!Auth::guest())
							@if (Auth::user()->id == $user->id)
						<li role="presentation"><a href="{{ route('edit-profile', [$user->user, $user->id]) }}">Editar Perfil</a></li>
							@endif
						@endif
					</ul>
					
					<div class="col-md-6">
						<div class="panel panel-primary">
						<div class="panel-heading">
							<h4>Recibidos</h4>
						</div>
						<div class="panel-body">
							<ul class="list-group">
							@foreach($messages as $message)
								@if ($message->receive_id == $user->id)
								<a href="{{ route('message', $message->id) }}" class="list-group-item">
									<h4>{{ $message->sent->user }}</h4>
									<p>{{ $message->message }}</p>
								</a>
								@endif
							@endforeach
							</ul>
						</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-primary">
						<div class="panel-heading">
							<h4>Enviados</h4>
						</div>
						<div class="panel-body">
							<ul class="list-group">
							@foreach($messages as $message)
								@if ($message->sent_id == $user->id)
								<a href="{{ route('message', $message->id) }}" class="list-group-item">
									<h4>{{ $message->receive->user }}</h4>
									<p>{{ $message->message }}</p>
								</a>
								@endif
							@endforeach
							</ul>
						</div>
					</div>
					</div>
				</div>
			</div>
		@stop