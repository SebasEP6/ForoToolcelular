@extends('layout')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>Mensaje</h3>
				</div>
				<div class="panel-body">
					<div class="container-fluid">
						<div class="media">
							<div class="row">
								<div class="col-md-3">
									<div class="media-left">
										<div class="img-responsive">
										@if ($message->sent->picture == null)
											<img src="{{ asset('img/avatar.png') }}" class="img-responsive img-thumbnail profile-pic">
										@else
											<img src="{{ asset($message->sent->picture) }}" class="img-responsive img-thumbnail profile-pic">
										@endif
										</div>
										<br>
										<a href="{{ route('profile', [$message->sent->user, $message->sent->id]) }}" class="btn btn-link"><h4>{{ $message->sent->user }}</h4></a>
									</div>
								</div>
								<div class="col-md-9 text-center">
									<div class="media-body">
										<p>
											{{ $message->message }}
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop