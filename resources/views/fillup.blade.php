@extends('_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/fillup.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
@endsection

@section('body')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-10">
			<div class="card z-depth-3">
				<div class="card-body">
					<h4 class="card-title mb-3">Fill Up Info Card</h4>
					@include('_form_fillup')
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/fillup.js') }}"></script>
@endsection