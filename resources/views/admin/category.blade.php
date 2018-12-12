@extends('layout')

@section('content')
@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Hey!</strong> Se encontraron algunos problemas.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{!! Form::model($category, ['route' => ['modify', $category->id], 'method' => 'post', 'files' => 'true']) !!}
					<div class="form-group">
						{!! Form::label('category', 'Nombre de la categoria', ['class' => 'form-control']) !!}
						{!! Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Introduce el nombre de la categoria']) !!}
						{!! Form::file('picture') !!}
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info">Guardar cambios</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop