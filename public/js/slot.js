var IMAGE_HEIGHT = 160;
var IMAGE_TOP_MARGIN = 5;
var IMAGE_BOTTOM_MARGIN = 5;
var SLOT_SEPARATOR_HEIGHT = 2
var SLOT_HEIGHT = IMAGE_HEIGHT + IMAGE_TOP_MARGIN + IMAGE_BOTTOM_MARGIN + SLOT_SEPARATOR_HEIGHT; // how many pixels one slot image takes
var RUNTIME = 2000; // how long all slots spin before starting countdown
var SPINTIME = 1000; // how long each slot spins at minimum
var ITEM_COUNT = 10 // item count in slots
var SLOT_SPEED = 25; // how many pixels per second slots roll
var DRAW_OFFSET = 75 // how much draw offset in slot display from top

var guests = [];
$.ajax({
	url: 'guests',
	success: function(response) {
		alert(response);
	},
	error: function (response) {
		alert('Something went wrong, please try again later.');
	},
});
var winners = [];
var comments = ['Prizes and Surprises!', 'Look out for more Prizes!', 'Merry Christmas!', 
'Look at your Number!', 'Take care of your prizes!', 'Shoutout to the R&D!',
"You're in luck!", 'Have faith, you might be next!', 'Undeniably Excellent!'];
var comment_index = 0;

function shuffleArray( array ) {
	for (i = array.length - 1; i > 0; i--) {
		var j = parseInt(Math.random() * i)
		var tmp = array[i];
		array[i] = array[j]
		array[j] = tmp;
	}
}

// Images must be preloaded before they are used to draw into canvas
function preloadImages( images, callback ) {
	function _preload( asset ) {
		asset.img = new Image();
		asset.img.src = 'img/' + asset.id+'.PNG';

		asset.img.addEventListener("load", function() {
			_check();
		}, false);

		asset.img.addEventListener("error", function(err) {
			_check(err, asset.id);
		}, false);
	}

	var loadc = 0;
	function _check( err, id ) {
		if ( err ) {
			alert('Failed to load ' + id );
		}
		loadc++;
		if ( images.length == loadc ) 
			return callback()
	}

	images.forEach(function(asset) {
		_preload( asset );
	});
}

function copyArray( array ) {
	var copy = [];
	for( var i = 0 ; i < array.length; i++) {
		copy.push( array[i] );
	}
	return copy;
}

function SlotGame() {
	var game = new Game();

	var items = [ 
	{id: '0'},
	{id: '1'},
	{id: '2'},
	{id: '3'},
	{id: '4'},
	{id: '5'},
	{id: '6'},
	{id: '7'},
	{id: '8'},
	{id: '9'}
	];

	$('canvas').attr('height', IMAGE_HEIGHT * ITEM_COUNT * 2);
	$('canvas').css('height', IMAGE_HEIGHT * ITEM_COUNT * 2);

	game.items = items;

  // load assets and predraw the reel canvases
  preloadImages(items, function() {
		// images are preloaded

		// draws canvas strip
		function _fill_canvas( canvas, items ) {
			ctx = canvas.getContext('2d');
			ctx.fillStyle = '#ddd';

			for (var i = 0 ; i < ITEM_COUNT ; i++) {
				var asset = items[i];
				ctx.save();
				ctx.shadowColor = "rgba(0,0,0,0.5)";
				ctx.shadowOffsetX = 5;
				ctx.shadowOffsetY = 5;
				ctx.shadowBlur = 5;
				ctx.drawImage(asset.img, 3, i * SLOT_HEIGHT + IMAGE_TOP_MARGIN);
				ctx.drawImage(asset.img, 3, (i + ITEM_COUNT) * SLOT_HEIGHT + IMAGE_TOP_MARGIN);
				ctx.restore();
				ctx.fillRect(0, i * SLOT_HEIGHT, 70, SLOT_SEPARATOR_HEIGHT);
				ctx.fillRect(0, (i + ITEM_COUNT)  * SLOT_HEIGHT, 70, SLOT_SEPARATOR_HEIGHT);
			}
		}

		// Draw the canvases with shuffled arrays
		game.items1 = copyArray(items);
		shuffleArray(game.items1);
		_fill_canvas( game.c1[0], game.items1 );
		game.items2 = copyArray(items);
		shuffleArray(game.items2);
		_fill_canvas( game.c2[0], game.items2 );
		game.items3 = copyArray(items);
		shuffleArray(game.items3);
		_fill_canvas( game.c3[0], game.items3 );
		game.items4 = copyArray(items);
		shuffleArray(game.items4);
		_fill_canvas( game.c4[0], game.items4 );
		game.resetOffset =  (ITEM_COUNT + 3) * SLOT_HEIGHT;
		game.loop();
	});

  $(document).on('keypress', function(e) {
  	if(e.which == 13) {
  		if (guests.length == 0) {
  			$('#results').show();
  			$('#multiplier').text('----');
  			$('#status').text('NO MORE GUESTS');
  			$('#name').text('AVAILABLE');
  		} else {
  			$('h1').text('Rolling!');
  			game.restart();
  		}
  	}
  });

  $('#play').click(function(e) {
		// start game on play button click
		if (guests.length == 0) {
			$('#results').show();
			$('#multiplier').text('----');
			$('#status').text('NO MORE GUESTS');
			$('#name').text('AVAILABLE');
		} else {
			$('h1').text('Rolling!');
			game.restart();
		}
	});

  // Show reels for debugging
  // var toggleReels = 1;
  // $('#debug').click(function() {
  // 	toggleReels = 1 - toggleReels;
  // 	if ( toggleReels ) {
  // 		$('#reels').css('overflow', 'hidden' );
  // 	} else {
  // 		$('#reels').css('overflow', 'visible' );
  // 	}
  // });
}

function Game() {
  // reel canvases
  this.c1 = $('#canvas1');
  this.c2 = $('#canvas2');
  this.c3 = $('#canvas3');
  this.c4 = $('#canvas4');

  // set random canvas offsets
  this.offset1 = -parseInt(Math.random() * ITEM_COUNT ) * SLOT_HEIGHT;
  this.offset2 = -parseInt(Math.random() * ITEM_COUNT ) * SLOT_HEIGHT;
  this.offset3 = -parseInt(Math.random() * ITEM_COUNT ) * SLOT_HEIGHT;
  this.offset4 = -parseInt(Math.random() * ITEM_COUNT ) * SLOT_HEIGHT;
  this.speed1 = this.speed2 = this.speed3 = this.speed4 = 0;
  this.lastUpdate = new Date();

  // Needed for CSS translates
  this.vendor = 
  (/webkit/i).test(navigator.appVersion) ? '-webkit' :
  (/firefox/i).test(navigator.userAgent) ? '-moz' :
  (/msie/i).test(navigator.userAgent) ? 'ms' :
  'opera' in window ? '-o' : '';

  this.cssTransform = this.vendor + '-transform';
  this.has3d = ('WebKitCSSMatrix' in window && 'm11' in new WebKitCSSMatrix())  
  this.trnOpen       = 'translate' + (this.has3d ? '3d(' : '(');
  this.trnClose      = this.has3d ? ',0)' : ')';
  this.scaleOpen     = 'scale' + (this.has3d ? '3d(' : '(');
  this.scaleClose    = this.has3d ? ',0)' : ')';

  // draw the slots to initial locations
  this.draw( true );
}

// Restart the game and determine the stopping locations for reels
Game.prototype.restart = function() {
	this.lastUpdate = new Date();
	this.speed1 = this.speed2 = this.speed3 = this.speed4 = SLOT_SPEED

  // function locates id from items
  function _find( items, id ) {
  	for ( var i=0; i < items.length; i++ ) {
  		if ( items[i].id == id ) return i;
  	}
  }

  // Resets guests list if all have wins
  if (guests.length == 0) {
  	guests = winners;
  	winners = [];
  }

	// Gets random guest id
	var index = Math.floor(Math.random() * guests.length);
	var guest_winner = guests[index];
	comment_index = guest_winner % 9;
	comment_index = Math.floor(comment_index);

	// Removes guest id in guests list and moves to winners
	winners.push(guest_winner);
	var index = guests.indexOf(guest_winner);
	if (index > -1) {
		guests.splice(index, 1);
	}

	// Gets digit of guest_winner
	var digit1 = guest_winner / 1000;
	guest_winner %= 1000;
	digit1 = Math.floor(digit1);
	var digit2 = guest_winner / 100;
	guest_winner %= 100;
	digit2 = Math.floor(digit2);
	var digit3 = guest_winner / 10;
	guest_winner %= 10;
	digit3 = Math.floor(digit3);
	var digit4 = guest_winner / 1;
	digit4 = Math.floor(digit4);

	function _find( items, id ) {
		for ( var i=0; i < items.length; i++ ) {
			if ( items[i].id == id ) return i;
		}
	}

	// Get sequence of guest id winner
	this.result1 = _find(this.items1, digit1.toString());
	this.result2 = _find(this.items2, digit2.toString());
	this.result3 = _find(this.items3, digit3.toString());
	this.result4 = _find(this.items4, digit4.toString());

  // uncomment to get always jackpot
  //this.result1 = _find( this.items1, 'gold-64' );
  //this.result2 = _find( this.items2, 'gold-64' );
  //this.result3 = _find( this.items3, 'gold-64' );

  // get random results
  // this.result1 = parseInt(Math.random() * this.items1.length)
  // this.result2 = parseInt(Math.random() * this.items2.length)
  // this.result3 = parseInt(Math.random() * this.items3.length)
  // this.result4 = parseInt(Math.random() * this.items4.length)

  // Clear stop locations
  this.stopped1 = false;
  this.stopped2 = false;
  this.stopped3 = false;
  this.stopped4 = false;

  // randomize reel locations
  this.offset1 = -parseInt(Math.random( ITEM_COUNT )) * SLOT_HEIGHT;
  this.offset2 = -parseInt(Math.random( ITEM_COUNT )) * SLOT_HEIGHT;
  this.offset3 = -parseInt(Math.random( ITEM_COUNT )) * SLOT_HEIGHT;
  this.offset4 = -parseInt(Math.random( ITEM_COUNT )) * SLOT_HEIGHT;

  $('#results').hide();

  this.state = 1;
}

window.requestAnimFrame = (function(){
	return window.requestAnimationFrame ||
	window.webkitRequestAnimationFrame ||
	window.mozRequestAnimationFrame ||
	window.oRequestAnimationFrame ||
	window.msRequestAnimationFrame ||
	function(/* function */ callback, /* DOMElement */ element){
		window.setTimeout(callback, 1000 / 60);
	};
})();

Game.prototype.loop = function() {
	var that = this;
	that.running = true;
	(function gameLoop() {
		that.update();
		that.draw();
		if (that.running) {
			requestAnimFrame( gameLoop );
		}
	})();
}

Game.prototype.update = function() {
	var now = new Date();
	var that = this;

   // Check slot status and if spun long enough stop it on result
   function _check_slot( offset, result, state ) {
   	if (state == 5) {
   		SPINTIME = 3500;
   	} else {
   		SPINTIME = 1000;
   	}
   	if ( now - that.lastUpdate > SPINTIME ) {
   		var c = parseInt(Math.abs( offset / SLOT_HEIGHT)) % ITEM_COUNT;
   		if ( c == result ) {
   			if ( result == 0 ) {
   				if ( Math.abs(offset + (ITEM_COUNT * SLOT_HEIGHT)) < (SLOT_SPEED * 1.5)) {
						return true; // done
					}
				} else if ( Math.abs(offset + (result * SLOT_HEIGHT)) < (SLOT_SPEED * 1.5)) {
		    	return true; // done
		    }
		  }
		}
		return false;
	}

	function _show_result() {
		$('#results').show();
		$('#header').find('h1').text(comments[comment_index]);
		$('#multiplier').text(guest_id);
		$('#name').text('<Insert Name>');
		$('#status').text('CONGRATULATIONS!');
	}

	switch (this.state) {
    case 1: // all slots spinning
    if (now - this.lastUpdate > RUNTIME) {
    	this.state = 2;
    	this.lastUpdate = now;
    }
    break;

    case 2: // slot 1
    this.stopped1 = _check_slot( this.offset1, this.result1, this.state );
    if ( this.stopped1 ) {
    	this.speed1 = 0;
    	this.state++;
    	this.lastUpdate = now;
    }
    break;

    case 3: // slot 1 stopped, slot 2
    this.stopped2 = _check_slot( this.offset2, this.result2, this.state );
    if ( this.stopped2 ) {
    	this.speed2 = 0;
    	this.state++;
    	this.lastUpdate = now;
    }
    break;

    case 4: // slot 2 stopped, slot 3
    this.stopped3 = _check_slot( this.offset3, this.result3, this.state );
    this.speed4 = this.speed3;
    if ( this.stopped3 ) {
    	this.speed3 = 0;
    	this.state++;
    }
    break;

    case 5: // slot 3 stopped, slot 4
    this.stopped4 = _check_slot( this.offset4, this.result4, this.state );
    if ( this.stopped4 ) {
    	this.speed4 = 0;
    	this.state++;
    }
    break;

    case 6: // slots stopped 
    if ( now - this.lastUpdate > 3000 ) {
    	this.state = 7;
    }
    break;

    case 7: // check results
    var guest_id = 0;

    guest_id = 1000 * parseInt(that.items1[that.result1].id);
    guest_id += 100 * parseInt(that.items2[that.result2].id);
    guest_id += 10 * parseInt(that.items3[that.result3].id);
    guest_id += parseInt(that.items4[that.result4].id);

    setTimeout(_show_result, 2000);
    
    this.state = 8;
    break;

    case 8: // game ends
    break;
    default:
  }
  this.lastupdate = now;
}

Game.prototype.draw = function( force ) {
	if (this.state >= 7 ) return;
  // draw the spinning slots based on current state
  for (var i=1; i <= 4; i++ ) {
  	var resultp = 'result'+i;
  	var stopped = 'stopped'+i;
  	var speedp = 'speed'+i;
  	var offsetp = 'offset'+i;
  	var cp = 'c'+i;
  	if (this[stopped] || this[speedp] || force) {
  		if (this[stopped]) {
  			this[speedp] = 0;
				var c = this[resultp]; // get stop location
				this[offsetp] = -(c * SLOT_HEIGHT);

				if (this[offsetp] + DRAW_OFFSET > 0) {
		    	// reset back to beginning
		    	this[offsetp] = -this.resetOffset + SLOT_HEIGHT * 3;
		    }
		  } else {
		  	this[offsetp] += this[speedp];
		  	if (this[offsetp] + DRAW_OFFSET > 0) {
		    	// reset back to beginning
		    	this[offsetp] = -this.resetOffset + SLOT_HEIGHT * 3 - DRAW_OFFSET;
		    }
		  }
	    // translate canvas location
	    this[cp].css(this.cssTransform, this.trnOpen + '0px, '+(this[offsetp] + DRAW_OFFSET)+'px' + this.trnClose);
	  }
	}
}