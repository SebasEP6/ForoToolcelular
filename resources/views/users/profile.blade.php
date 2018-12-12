@extends('layout')

@section('content')
<div class="container-fluid">
			<div class="row">
				<div class="col-md-5 col-md-offset-1">
					@if(Auth::guest())
					<div class="alert alert-info" role="alert">
						<p>Bienvenido,<a href="{{ route('login') }}" class="btn btn-link"><strong>Inicie sesi&oacute;n</strong></a>para poder interactuar en los foros, si no tienes una cuenta todav&iacute;a, puedes tambien registrarte <a href="{{ route('register') }}" class="btn btn-link">aqu&iacute;</a></p>
					</div>
					@endif
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li role="presentation" class="active"><a href="{{ route('profile', [$user->user, $user->id]) }}">Perfil</a></li>
						<li role="presentation"><a href="{{ route('personal_topics', [$user->user, $user->id]) }}">Temas</a></li>
						@if (!Auth::guest())
						@if (Auth::user()->id == $user->id)
						<li role="presentation"><a href="{{ route('messages', [$user->user, $user->id]) }}">Mensajes</a></li>
						<li role="presentation"><a href="{{ route('edit-profile', [$user->user, $user->id]) }}">Editar Perfil</a></li>
						@endif
						@endif
					</ul>
					<div class="panel">
						<div class="panel-body">
							<div class="media">
								<div class="media-left">
									@if ($user->picture == null)
									<img src="{{ asset('img/avatar.png') }}" class="img-responsive img-thumbnail profile-pic">
									@else
									<img src="{{ asset($user->picture) }}" class="img-responsive img-thumbnail profile-pic">
									@endif
								</div>
								<div class="media-body">
								<h4 class="text-primary">Informaci&oacute;n Personal</h4>
									<p>Usuario: {{ $user->user }}</p>
									<p>Eslogan: {{ $user->slogan }}</p>
									<p>Rol: {{ trans('utils.role.'.$user->role) }}</p>
									<p>Edad: {{ $user->age }}</p>
									<p>Sexo: {{ trans('utils.sex.'.$user->sex) }}</p>
									<p>Nombre: {{ $user->name }}</p>
									<p>Se registro el: {{ $user->created_at }}</p>
									<hr>
									<h4 class="text-primary">Contacto</h4>
									<p>Direccion Personal: {{ $user->website_url }}</p>
									<p>Correo: {{ $user->email }}</p>
									<p>Ubicaci&oacute;n: {{ trans('utils.country.'.$user->country) }}</p>	
									@if (!Auth::guest())
										@if (Auth::user()->id != $user->id)
									<p><a href="#message" type="button" class="btn btn-link" data-toggle="modal">Enviar Mensaje</a></p>
										@include('partials.message')
										@endif
									@endif
								</div>
							</div>					
						</div>
					</div>
				</div>
			</div>
		</div>
		@stop