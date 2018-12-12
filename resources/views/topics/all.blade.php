@extends('layout')

@section('content')
<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<ol class="breadcrumb">
						<li><a href="{{ route('home') }}">Toolcelular</a></li>
						<li class="active">Categor&iacute;as</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-md-offset-1">
					@if(Auth::guest())
					<div class="alert alert-info" role="alert">
						<p>Bienvenido,<a href="{{ route('login') }}" class="btn btn-link"><strong>Inicie sesi&oacute;n</strong></a>para poder interactuar en los foros</p>
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
							<h3>Categor&iacute;as</h3>
						</div>
						<div class="panel-group" id="accordion" role="tablist">
						@foreach ($categories as $category)
						<div class="panel-body">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title category-title">
										<small>
											@if($category->img != null)
										<img src="{{ asset($category->img) }}" class="img-responsive img-thumbnail category-pic">
											@endif
										</small>
										<a href="#{{ $category->id }}" data-toggle="collapse" data-parent="accordion">
											{{ $category->category }}
										</a>
									</h3>
								</div>
								<div class="panel-collapse collapse" id="{{ $category->id }}">
									<ul class="list-group">
									<div class="table-responsive">
										<table class="table table-striped table-bordered">
										@foreach ($category->posts as $post)
										<tr>
											<td><span class="{{ $post->icon($post->type) }}"></span></td>
											<td><span class="{{ $post->isPopular($post->comments) }}"></span></td>
											<td><a href="{{ route('topic', [$post->category->category, $post->id]) }}" class="list-group-item">{{ $post->title }}</a></td>
										</tr>
										@endforeach
										</table>
									</div>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
						</div>
					</div>
					{!! $categories->render() !!}
				</div>
			</div>
		</div>
@stop