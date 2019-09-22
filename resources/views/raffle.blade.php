<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="interface" content="desktop" />
	<title>Slots</title>
	<link href="https://fonts.googleapis.com/css?family=Lora|Manjari&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('css/slot.css') }}" />
</head>
<body>
	<div id="viewport">
		<div id="container">
			<div id="header">
				<h1>Slots Machine</h1>
				<h3>Play and Win</h3>
			</div>
			<div id="reels">
				<div id="winline"></div>
				<canvas id="canvas1" width="100" height="300"></canvas>
				<canvas id="canvas2" width="100" height="300"></canvas>
				<canvas id="canvas3" width="100" height="300"></canvas>
				<canvas id="canvas4" width="100" height="300"></canvas>
				<div id="results">
					<div id="score">
						<span id="multiplier"></span>
					</div>
					<div id="status"></div>
					<div id="name"></div>
				</div>
			</div>
			<div id="buttons">
				<div id="play" class="button button-default">Play</div>	  
			</div>
		</div>
	</div>
	<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/slot.js') }}"></script>
	<script type="text/javascript">$(function() { SlotGame(); });</script>
</body>
</html>
