@extends('layout')

@section('content')
<div class="container">
	@if(count($ads) > 0)
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<td>Logo</td>
							<th>Nombre o descrici&oacute;n</th>
							<th>Fecha de creaci&oacute;n</th>
							<th>Acci&oacute;n</th>
						</tr>
						@foreach($ads as $ad)
						<tr>
							<td><img src="{{ asset($ad->path) }}" class="minimal"></td>
							<td>{{ $ad->text }}</td>
							<td>{{ $ad->date }}</td>
							<td><a href="{{ route('delAd', $ad->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif
	<div class="row">
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
		<div class="col-md-8 col-md-offset-2">
			{!! Form::open(['route' => 'mark', 'method' => 'post', 'files' => 'true']) !!}
				<div class="form-group">
					{!! Form::label('name', 'Introduzca el nombre o descricion', ['class' => 'sr-only']) !!}
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el nombre o descripci&oacute;n']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('link_path', 'Introduzca la direccion a la que se hace referencia', ['class' => 'sr-only']) !!}
					{!! Form::text('link_path', null, ['class' => 'form-control', 'placeholder' => 'Introduzca la direccion a la que se hace referencia']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('logo', 'Seleccione el logo o imagen a mostrar') !!}
					{!! Form::file('logo', ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<button class="btn btn-info pull-right">Guardar</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop