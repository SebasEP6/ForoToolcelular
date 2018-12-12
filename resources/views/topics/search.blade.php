@extends('layout')

@section('content')
<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<ol class="breadcrumb">
						<li><a href="{{ route('home') }}">Toolcelular</a></li>
						<li class="active">B&uacute;squeda</li>
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

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3>B&uacute;squeda</h3>
						</div>
						<div class="panel-body">
							<ul class="list-group">
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
									@foreach ($posts as $post)
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
			</div>
		</div>
@stop