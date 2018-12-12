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
						<li role="presentation"><a href="{{ route('profile', [$user->user, $user->id]) }}">Perfil</a></li>
						<li role="presentation" class="active"><a href="{{ route('personal_topics', [$user->user, $user->id]) }}">Temas</a></li>
						@if (!Auth::guest())
						@if (Auth::user()->id == $user->id)
						<li role="presentation"><a href="{{ route('messages', [$user->user, $user->id]) }}">Mensajes</a></li>
						<li role="presentation"><a href="{{ route('edit-profile', [$user->user, $user->id]) }}">Editar Perfil</a></li>
						@endif
						@endif
					</ul>
						<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tr>
										<th colspan="3">T&iacute;tulo del tema</th>
										<th>Categor&iacute;a</th>
										<th>Interacciones</th>
										@if (Auth::user()->id == $user->id)
										<th>Acci&oacute;n</th>
										@endif
									</tr>
									@if (count($posts) == 0)
									<tr>
										<td colspan="5">
											<div class="text-center">
												<p>
													Este Usuario aun no ha publicado un tema
												</p>
											</div>
										</td>
									</tr>
									@else
									@foreach ($posts as $post)
									<tr>
										<td><span class="{{ $post->icon($post->type) }}"></span></td>
										<td><span class="{{ $post->isPopular($post->comments) }}"></span></td>
										<td><a href="{{ route('topic', [$post->category->category, $post->id]) }}" class="btn btn-link">{{ $post->title }}</a></td>
										<td>{{ $post->category->category }}</td>
										<td>{{ $post->quantity($post->comments) }}</td>
										@if (Auth::user()->id == $user->id)
										<td><a href="{{ route('delPost', $post->id) }}" class="btn btn-danger" style="width: 100%">
											Eliminar
										</a></td>
										@endif
									</tr>
									@endforeach
									@endif
								</table>
							</div>
				</div>
			</div>
		</div>
		@stop