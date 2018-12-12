<div class="modal fade" id="message">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h3 class="modal-title">Redactar Mensaje</h3>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => ['new-message', $user->id, Auth::user()->id], 'method' => 'post']) !!}
					<div class="form-group">
						<label for="user" class="sr-only">
							Escriba el nombre de usuario:
						</label>
						<input type="text" name="user" id="user" class="form-control" placeholder="Ingrese el usuario">
					</div>
					<div class="form-group">
						<label for="message" class="sr-only">
							Escriba el mensaje:
						</label>
						<textarea name="message" id="message" class="form-control" rows="10"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">
						Enviar
					</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>