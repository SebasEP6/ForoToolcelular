@extends('layout')

@section('content')
<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="collapse" id="alerta">
						<div class="well">
							<div class="alert alert-info" role="alert">
								<button class="close" data-dismiss="alert"><span>&times;</span></button>
								<p>
									Revise su correo para recuperar su contrase&ntilde;a
								</p>			
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-md-offset-3">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4>Recuperar Clave</h4>
						</div>
						<div class="panel-body">
							<form action="#" method="POST">
								<div class="form-group">
									<label for="email" class="sr-only">Introduzca su correo:</label>
									<input type="text" name="email" id="email" class="form-control" placeholder="Ingresa tu correo">
								</div>
								<button type="submit" href="#alerta" class="btn btn-primary pull-right" data-toggle="collapse">
									Recuperar
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		@stop