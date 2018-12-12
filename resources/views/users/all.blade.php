@extends('layout')

@section('content')
<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<ol class="breadcrumb">
						<li><a href="{{ route('home') }}">Toolcelular</a></li>
						<li class="active">Miembros</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-md-offset-1">
					@if(Auth::guest())
					<div class="alert alert-info" role="alert">
						<p>Bienvenido,<a href="{{ route('login') }}" class="btn btn-link"><strong>Inicie sesi&oacute;n</strong></a>para poder interactuar en los foros, si no tienes una cuenta todav&iacute;a, puedes tambien registrarte <a href="{{ route('register') }}" class="btn btn-link">aqu&iacute;</a></p>
					</div>
					@endif
				</div>
			</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Miembros</h4>
					</div>
					<div class="panel-body">
						<div class="row">
						@foreach ($users as $user)
							<article class="col-md-3 col-xs-12">
								<div class="panel panel-default profiles">
									<div class="panel-heading">
										<h4 class="media-middle">
											<a href="{{ route('profile', [$user->user, $user->id]) }}">{{ $user->name }}</a>
										</h4>
									</div> 
									<div class="panel-body">
										<small>
											{{ $user->user }} <br/>
											{{ trans('utils.role.'.$user->role) }} <br/>
											Temas: {{ $user->quantity($user->posts) }} <br/>
											Ubicaci&oacute;n: {{ trans('utils.country.'.$user->country) }}
										</small>
									</div>
								</div>
							</article>
							@endforeach
					</div>
				</div>
			</div>
			{!! $users->render() !!}
			</div>
		</div>
	</div>
@stop