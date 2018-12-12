@extends('layout')

@section('content')
<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<ol class="breadcrumb">
						<li class="active">Foro > Toolcelular</li>
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
			@if (count($ads) > 0)
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="alert alert-info" role="alert">
						<div class="container-fluid">
							@foreach($ads as $ad)
							<div class="col-md-5 ads text-center">
								<a href="{{ $ad->link_path }}" target="blank"><img class="logo-ad" src="{{ asset($ad->path) }}"></img></a>
								<div class="ad-space"></div>
								<h4>{{ $ad->text }}</h4>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@endif
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4>Temas Recientes</h4>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tr>
										<th colspan="3">T&iacute;tulo del tema</th>
										<th>Categor&iacute;a</th>
										<th>Interacciones</th>
										<th>Autor</th>
									</tr>
									@foreach ($posts as $post)
									<tr>
										<td><span class="{{ $post->icon($post->type) }}"></span></td>
										<td><span class="{{ $post->isPopular($post->comments) }}"></span></td>
										<td><a href="{{ route('topic', [$post->category->category, $post->id]) }}" class="btn btn-link">{{ $post->title }}</a></td>
										<td>{{ $post->category->category }}</td>
										<td>{{ $post->quantity($post->comments) }}</td>
										<td><a href="{{ route('profile', [$post->user->user, $post->user->id]) }}" class="btn btn-link">{{ $post->user->user }}</a></td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
			</div>
		</div>
	</div>
</div>
@stop