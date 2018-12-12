@extends('layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{!! Form::model($user, ['route' => ['change', $user->id], 'method' => 'post']) !!}
					<div class="form-group">
						{!! Form::label('user', 'Nombre del usuario: '.$user->name, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('role', 'Elegir la categoria', ['class' => 'sr-only']) !!}
						{!! Form::select('role', ['member' => 'Miembro', 'privilege' => 'Privilegiado', 'moderator' => 'Moderador', 'support' => 'Soporte', 'admin' => 'Administrador'], null, ['class' => 'form-control', 'placeholder' => 'Elige la categoria para el usuario']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('password', 'Ingresa tu clave:', ['class' => 'sr-only']) !!}
						{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingresa tu clave']) !!}
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info">Guardar cambios</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop