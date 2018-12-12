@extends('layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th>Categor&iacute;a</th>
							<th>Interaccion</th>
						</tr>
						@foreach($categories as $category)
						<tr>
							<td>{{ $category->category }}</td>
							<td>
								<a href="{{ route('modify', $category->id) }}" class="btn btn-link">Editar</a>
								<!-- <a href="" class="btn btn-link">Eliminar</a> -->
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{!! $categories->render() !!}
	</div>
@stop