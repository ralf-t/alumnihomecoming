@extends('_layout')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/raffle.css') }}">
@endsection

@section('body')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-5 vh-100">
			<div id="reels">
				<!-- <canvas id="digit1"></canvas>
				<canvas id="digit2"></canvas>
				<canvas id="digit3"></canvas>
				<canvas id="digit4"></canvas> -->
				<div id="winline"></div>
			</div>
		</div>
	</div>
</div>
@endsection
