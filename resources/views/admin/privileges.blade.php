@extends('layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th>Nombre de Usuario</th>
							<th>Usuario</th>
							<th>Tipo</th>
							<th>Interaccion</th>
						</tr>
						@foreach($users as $user)
						<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->user }}</td>
							<td>{{ trans('utils.role.'.$user->role) }}</td>
							<td>
								<a href="{{ route('change', $user->id) }}" class="btn btn-link">Editar</a>
								<!-- <a href="" class="btn btn-link">Eliminar</a> -->
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{!! $users->render() !!}
	</div>
@stop