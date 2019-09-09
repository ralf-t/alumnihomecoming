<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Raffle</title>
	@include('_styles')
	@yield('styles')
</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-11 p-0">
				@yield('body')
			</div>
		</div>
	</div>

	@include('_scripts')
	@yield('scripts')
</body>
</html>