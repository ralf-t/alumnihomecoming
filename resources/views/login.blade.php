@extends('_layout')

@section('body')
<div class="container-fluid">
	<div class="row justify-content-center mt-5">
		<div class="col-12 col-md-7 col-lg-5">
			<div class="card z-depth-3">
				<div class="card-body mx-4">
					<form method="POST" name="form_login">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<button class="btn btn-success w-100" id="login" type="submit">LOGIN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/status.js') }}"></script>
@endsection