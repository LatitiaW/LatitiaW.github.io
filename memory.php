<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Memory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Anton'>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="memory.css">
</head>
<body>
	<div class="wrap">
		<div class="game"></div>
	</div><!-- End Wrap -->
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script>
		var matches = 0;

		(function(){
	
	var Memory = {

		init: function(cards){
			this.$game = $(".game");
			this.cardsArray = $.merge(cards, cards);
			this.shuffleCards(this.cardsArray);
			this.setup();
		},

		shuffleCards: function(cardsArray){
			this.$cards = $(this.shuffle(this.cardsArray));
		},

		setup: function(){
			this.html = this.buildHTML();
			this.$game.html(this.html);
			this.$memoryCards = $(".card");
			this.paused = false;
     	this.guess = null;
			this.binding();
		},

		binding: function(){
			this.$memoryCards.on("click", this.cardClicked);
		},
		// kinda messy but hey
		cardClicked: function(){
			var _ = Memory;
			var $card = $(this);
			if(!_.paused && !$card.find(".inside").hasClass("matched") && !$card.find(".inside").hasClass("picked")){
				$card.find(".inside").addClass("picked");
				if(!_.guess){
					_.guess = $(this).attr("data-id");
				} else if(_.guess == $(this).attr("data-id") && !$(this).hasClass("picked")){
					$(".picked").addClass("matched");
					_.guess = null;
					matches += 1;
				} else {
					_.guess = null;
					_.paused = true;
					setTimeout(function(){
						$(".picked").removeClass("picked");
						Memory.paused = false;
					}, 600);
				}
				
				var xhttp = new XMLHttpRequest();
				xhttp.open("GET", "uhh0.php?memory=" + matches, true);
				xhttp.send();
				
				if($(".matched").length == $(".card").length){
					_.win();
				}
			}
		},

		win: function(){
			this.paused = true;
			setTimeout(function(){
				Memory.$game.fadeOut();
			}, 1000);
		},

		// Fisher--Yates Algorithm -- https://bost.ocks.org/mike/shuffle/
		shuffle: function(array){
			var counter = array.length, temp, index;
	   	// While there are elements in the array
	   	while (counter > 0) {
        	// Pick a random index
        	index = Math.floor(Math.random() * counter);
        	// Decrease counter by 1
        	counter--;
        	// And swap the last element with it
        	temp = array[counter];
        	array[counter] = array[index];
        	array[index] = temp;
	    	}
	    	return array;
		},

		buildHTML: function(){
			var frag = '';
			this.$cards.each(function(k, v){
				frag += '<div class="card" data-id="'+ v.id +'"><div class="inside">\
				<div class="front"><img src="'+ v.img +'" style="'+ v.style +'"></div>\
				<div class="back"><img src="https://fanart.tv/fanart/movies/603/hdmovielogo/the-matrix-5190bfebe0bcf.png"\
				style="margin-top: 15%;"></div></div>\
				</div>';
			});
			return frag;
		}
	};

	var cards = [
		{
			name: "php",
			img: "image1",
			id: 1,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "css3",
			img: "image2",
			id: 2,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "html5",
			img: "image3",
			id: 3,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "jquery",
			img: "image4",
			id: 4,
			style: "height: 100%; widht: 100%;"
		}, 
		{
			name: "javascript",
			img: "image5",
			id: 5,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "node",
			img: "image6",
			id: 6,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "photoshop",
			img: "image7",
			id: 7,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "python",
			img: "image8",
			id: 8,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "rails",
			img: "image9",
			id: 9,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "sass",
			img: "image10",
			id: 10,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "sublime",
			img: "image11",
			id: 11,
			style: "height: 100%; widht: 100%;"
		},
		{
			name: "wordpress",
			img: "image12",
			id: 12,
			style: "height: 100%; widht: 100%;"
		},
	];
    
	Memory.init(cards);


})();
	</script>
</body>

</html>