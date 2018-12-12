@extends('layout')

@section('scripts')
  <script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script type="text/javascript">
  tinymce.init({
    selector: 'textarea',
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
  });
  </script>
@endsection

@section('content')
<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<ol class="breadcrumb">
						<li><a href="{{ route('home') }}">Toolcelular</a></li>
						<li><a href="{{ route('all') }}">Categoria</a></li>
						<li class="active">Tema</li>
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
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							@if($post->user_id == Auth::user()->id)
							<h4>
								{{ $post->title }}
								<a href="{{ route('ed_topic', $post->id) }}">
									<span class="label pull-right"> Editar </span>
								</a>
							</h4>
							@else
							<h4>{{ $post->title }}</h4>
							@endif
						</div>
						<div class="panel-body">
							<div class="container-fluid">
								<div class="media">
									<div class="row">
										<div class="col-md-3">
											<div class="media-left">
												@if ($post->user->picture == null)
												<img src="{{ asset('img/avatar.png') }}" class="img-responsive img-thumbnail profile-pic">
												@else
												<img src="{{ asset($post->user->picture) }}" class="img-responsive img-thumbnail profile-pic">
												@endif
												<br>
												<a href="{{ route('profile', [$post->user->user, $post->user->id]) }}" class="btn btn-link btn-post"><h4>{{ $post->user->name }}</h4></a>
												<h5>{{ $post->user->user }}</h5>
												<h5>{{ trans('utils.role.'.$post->user->role) }}</h5>
												<h5>{{ trans('utils.country.'.$post->user->country) }}</h5>
											</div>
										</div>
										<div class="col-md-9 text-center">
											<div class="media-body">
												<blockquote>
														{!! $post->body !!}
													<p>
														@if($post->path != null)
															@if (Auth::guest() || Auth::user()->role == 'member')
																<h5>{{ $post->name }} <small>Para poder descargar archivos debes estar registrado como usuario privilegiado</small></h5>
															@else
																<a href="{{ asset($post->path) }}" class="btn btn-link">{{ $post->name }}</a>
															@endif
														@endif
													</p>
													<footer>
														{!! $post->user->slogan !!}
													</footer>
												</blockquote>
											</div>
										</div>
										<p class="col-md-offset-7 col-md-3">Esta publicaci&oacute;n tiene {{ $post->likes }} me gusta</p>
										@if(count($like) == 0)
										<a href="{{ route('like', $post->id) }}" class="btn btn-primary col-md-1 pull-left">Me gusta <span class="glyphicon glyphicon-thumbs-up"></span></a>
										@endif
									</div>
								</div>
							</div>
						</div>
						@if (count($comments) > 0)
						@foreach ($comments as $comment)
						<hr>
						<div class="panel-body">
							<div class="container-fluid">
								<div class="media">
									<div class="row">
										<div class="col-md-3">
											<div class="media-left">
											@if ($comment->user->picture == null)
												<img src="{{ asset('img/avatar.png') }}" class="img-responsive img-thumbnail comment-pic">
											@else
												<img src="{{ asset($comment->user->picture) }}" class="img-responsive img-thumbnail comment-pic">
											@endif
											<br>
												<a href="{{ route('profile', [$comment->user->user, $comment->user->id]) }}" class="btn btn-link btn-post"><h5>{{ $comment->user->name }}</h5></a>
												<br>
												<p>{{ trans('utils.role.'.$post->user->role) }}</p>
											</div>
										</div>
										<div class="col-md-9">
											<div class="media-body">
												<blockquote>
													<p>
														{!! $comment->comment !!}
													</p>
													<footer>
														{!! $comment->user->slogan !!}
													</footer>
												</blockquote>
											</div>
										</div>
										@if($comment->user_id == Auth::user()->id)
										<h4>
											<a href="{{ route('ed_comment', $comment->id) }}">
												<span class="col-md-1 col-md-offset-7">Editar</span>
											</a>
										</h4>
										@endif
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
							<div class="text-center">
								<p>
									(0) No hay ning&uacute;n comentario todav&iacute;a
								</p>
							</div>
						@endif
					</div>
				</div>
				@if (Auth::check())
				<div class="row">
					<div class="col-md-6 col-md-offset-2">
						<a href="#answer-form" class="btn btn-link" data-toggle="collapse">
							<h4>Agregar un comentario</h4>
						</a>
						<div class="collapse" id="answer-form">
							<div class="well">
								<div class="h5">Comentarios</div>
								<form action="{{ route('newComment', $post->id) }}" method="POST" class="">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
									<div class="form-group">
										<label for="comment" class="sr-only">Escriba su comentario:</label>
										<textarea class="form-control" name="comment" id="comment" placeholder="Introduzca su comentario"></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn-lg form-control btn btn-primary">
											Comentar
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
		@stop