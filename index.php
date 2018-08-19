<head>
	<canvas id="c" style="position: fixed; z-index: -1;"></canvas>
	<link rel="stylesheet" href="matrix.css">
	<title>Matrix</title>
</head>

<body onload="refresh()" style="cursor: none;">
<div class="computer" id="computer0" style="margin-left: 22.5%;">
</div>
<div class="computer" id="computer1" style="margin-left: 42.5%;">
</div>
<div class="computer" id="computer2" style="margin-left: 62.5%;">
</div>
<script>
	

	var c = document.getElementById("c");
	var ctx = c.getContext("2d");
	var states = ['Computer', 'Danger', 'CRITICAL!!', 'Disabled'];
	var colors = ['#0F0', 'red', 'red', 'rgb(160,0,0)'];
	var backgrounds = ['rgba(0, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.1)', 'rgba(255, 0, 0, 0.2)', 'black'];

	//making the canvas full screen
	c.height = 1.22*window.innerHeight;
	c.width = window.innerWidth;

	//chinese characters - taken from the unicode charset
	var chinese =
	"田由甲申甴电甶男甸甹町画甼甽甾甿畀畁畂畃畄畅畆畇畈畉畊畋界畍畎畏畐畑田由甲申甴电甶男甸甹町画甼甽甾甿畀畁畂畃畄畅畆畇畈畉畊畋界畍畎畏畐畑ABCDEFGHIJKLMNOPQRSTUVWXYZ012345678901234567890101010101010101010101010101010101010101";
	//converting the string into an array of single characters
	chinese = chinese.split("");

	var font_size = 10;
	var columns = c.width/font_size; //number of columns for the rain
	//an array of drops - one per column
	var drops = [];
	//x below is the x coordinate
	//1 = y co-ordinate of the drop(same for every drop initially)
	for(var x = 0; x < columns; x++) {
		drops[x] = Math.random()*c.height/3;
	}

	//drawing the characters
	function draw() {
		//Black BG for the canvas
		//translucent BG to show trail
		ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
		ctx.fillRect(0, 0, c.width, c.height);
	
		ctx.fillStyle = "#0F0"; //green text
		ctx.font = font_size + "px arial";
		//looping over drops
		for(var i = 0; i < drops.length; i++) {
			//a random chinese character to print
			var text = chinese[Math.floor(Math.random()*chinese.length)];
			//x = i*font_size, y = value of drops[i]*font_size
			ctx.fillText(text, i*font_size, drops[i]*font_size);
		
			//sending the drop back to the top randomly after it has crossed the screen
			//adding a randomness to the reset to make the drops scattered on the Y axis
			if(drops[i]*font_size > c.height && Math.random() > 0.975) {
				drops[i] = 0;
			}
			//incrementing Y coordinate
			drops[i]++;
			
			// Retrieve
			<?php
				$f0 = fopen("status0.php", "r");
				$text0 =  fread($f0, filesize("status0.php"));
				$memory = (explode("\n", $text0));
				fclose($f0);
				$f1 = fopen("status1.php", "r");
				$text1 =  fread($f1, filesize("status1.php"));
				$mastermind = (explode("\n", $text1));
				fclose($f1);
				$f2 = fopen("status2.php", "r");
				$text2 =  fread($f2, filesize("status2.php"));
				$battleship = (explode("\n", $text2));
				fclose($f2);
			?>

			document.getElementById("computer0").innerHTML = states[<?php echo $memory[0]; ?>];
			document.getElementById("computer0").style.color = colors[<?php echo $memory[0]; ?>];
			document.getElementById("computer0").style.borderColor = colors[<?php echo $memory[0]; ?>];
			document.getElementById("computer0").style.backgroundColor = backgrounds[<?php echo $memory[0]; ?>];

			document.getElementById("computer1").innerHTML = states[<?php echo $mastermind[0]; ?>];
			document.getElementById("computer1").style.color = colors[<?php echo $mastermind[0]; ?>];
			document.getElementById("computer1").style.borderColor = colors[<?php echo $mastermind[0]; ?>];
			document.getElementById("computer1").style.backgroundColor = backgrounds[<?php echo $mastermind[0]; ?>];

			document.getElementById("computer2").innerHTML = states[<?php echo $battleship[0]; ?>];
			document.getElementById("computer2").style.color = colors[<?php echo $battleship[0]; ?>];
			document.getElementById("computer2").style.borderColor = colors[<?php echo $battleship[0]; ?>];
			document.getElementById("computer2").style.backgroundColor = backgrounds[<?php echo $battleship[0]; ?>];
		}
	}
	
	setInterval(draw, 33);
</script>
</body>