<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Toolcelular | Foro</title>
		@yield('styles')
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	</head>
	<body>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="img-responsive text-center">
							<img src="{{ asset('img/toolcelular.png') }}" class="header-logo">
						</div>
					</div>
					<div class="col-md-9">
						<div class="space-box"></div>
						<div class="col-md-2 text-center">
							<h1>Foro</h1>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="pull-right">
					@if (!Auth::guest())
					<h5>Bienvenido, {{ Auth::user()->name }}</h5>
					@endif
				</div>
			</div>
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main">
							<span class="sr-only">Ver</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="{{ route('home') }}" class="navbar-brand">Toolcelular</a>
					</div>
					<div class="collapse navbar-collapse" id="main">
						<ul class="nav navbar-nav pull-right">
							<li><a href="{{ route('all') }}">Temas</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									Buscar Tema
								</a>
								<ul class="dropdown-menu" role="menu" style="width: 300px">
									<li>
										{!! Form::open(['route' => 'srch', 'method' => 'post', 'class' => 'form-inline']) !!}
										<div class="form-group">
											<div class="input-group">
												<input type="text" name="word" placeholder="Ej: Samsung" class="form-control">
												<span class="input-group-btn">
													<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-search"></span></button>
												</span>
											</div>
										</div>
										{!! Form::close() !!}
									</li>
								</ul>
							</li>
							<li><a href="{{ route('members') }}">Miembros</a></li>
							@if (Auth::guest())
								<li><a href="{{ route('login') }}">Ingresar</a></li>
							@else
								<li><a href="{{ route('new', Auth::user()->id) }}">Nuevo Tema</a></li>
								@if (Auth::user()->role == 'admin')
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
										Administrar
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ route('users') }}">Usuarios</a></li>
										<li><a href="{{ route('categories') }}">Categorias</a></li>
									</ul>
								</li>
								<li><a href="{{ route('mark') }}">Publicidad</a></li>
								@endif
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
										{{ Auth::user()->user }}
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ route('profile', [Auth::user()->user, Auth::user()->id]) }}">Perfil</a></li>
										<li><a href="{{ route('messages', [Auth::user()->user, Auth::user()->id]) }}">Mensajes</a></li>
										<li><a href="{{ route('logout') }}">Salir</a></li>
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</nav>
		</header>

		@yield('content')

		<div class="navbar-fixed-bottom">
			<footer>
				<hr/>
				<div class="container">
					<p style="display: inline-block">Todos los derechos Reservados 2016. Desarrollado por <span class="author">Sebasti&aacute;n Escalona</span></p>
					<a href="http://toolcelular.com.ve" class="btn btn-link pull-right" style="display: inline-block">< Volver a la p&aacute;gina principal</a>
				</div>
			</footer>
		</div>

		<script src="{{ asset('js/jquery.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		@yield('scripts')
		@if(Route::currentRouteName() == 'new')
			@include('partials.plupload')
		@endif
	</body>
</html>