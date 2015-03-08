$(function() {

	function choosePlayerClass() {
		$(".startGame").click(function(){
			var playerName = $("#playerName").val();
			var playerClass;
			if ($("input[name='playerClass']:checked").length > 0 && playerName.length > 0){
				playerClass = $('input:radio[name=playerClass]:checked').val();
				console.log(playerClass);
			}
			else {
				alert("Fill in your playername and choose type of pianoplayer!");
				return false;
			}
			submitPlayer(playerName, playerClass);
			return false;

		});
	}
	function submitPlayer(Name, Class) {
		$.ajax({
			url: "php/start_game.php",
			dataType: "json",
			data: {
			player_name : Name,
			player_class : Class
			},
			success: function(data) {
				getChallenge(false);
				console.log("submitPlayer Success: ", data);
				},
				error: function(data) {
					console.log("Error: ", data);
			}
		});
	}

	function getChallenge(challengeChoise) {
		$.ajax({
			url: "php/get_challenge.php",
			dataType: "json",
			data: {
				challengeChoise : challengeChoise
			},
			success: function(data) {
				var successPoints = data["playerSuccess"];
				if (successPoints === 0) {
					//gameOver();
				}
				else {
					getChallengeData(data);
					console.log("startGame and get challenge Success: ", data);
				}
			},
			error: function(data) {
				console.log("Error: ", data);
			}
		});
	}

	function getChallengeData(battleData) {
		$(".playerSelect").remove();
		$(".battleInfo").html('');
		$(".battleChoise").html('');
		$(".battleInfo").append("<h3>Info regarding you and your competitors!</h3>");
		$(".battleInfo").append("<p><span class='normal'>Your name: &nbsp;&nbsp;&nbsp;&nbsp;</span>" 
		  + battleData["playerName"] + "<span class='normal'><br>Pianoplayer type: &nbsp;&nbsp;</span>"
		  + battleData["playerClass"] + "<span class='normal'>&nbsp;&nbsp;Succes points: &nbsp;&nbsp;</span>" 
		  + battleData["playerSuccess"] + "</p>");
		$(".battleInfo").append("<p><span class='normal'>Virtualplayer 1: &nbsp;&nbsp;</span>" 
			+ battleData["virtualPlayer1Name"] + "<span class='normal'><br>Pianoplayer type: &nbsp;&nbsp;</span>" 
			+ battleData["virtualPlayer1Class"] + "<span class='normal'>&nbsp;&nbsp;Succes points: &nbsp;&nbsp;</span>" 
			+ battleData["virtualPlayer1Success"] + "</p>");
		$(".battleInfo").append("<p><span class='normal'>Virtualplayer 2: &nbsp;&nbsp;</span>" 
			+ battleData["virtualPlayer2Name"] + "<span class='normal'><br>Pianoplayer type: &nbsp;&nbsp;</span>" 
			+ battleData["virtualPlayer2Class"] + "<span class='normal'>&nbsp;&nbsp;Succes points: &nbsp;&nbsp;</span>" 
			+ battleData["virtualPlayer2Success"] + "</p><br>");
	
		$(".battleInfo").append("<h2>This battlechallenge!</h2>");
		$(".battleInfo").append("<h3> Battlesong: " + battleData["challenge"]["title"] + "</h3>");
		$(".battleInfo").append("<p class='challenge'>"+battleData["challenge"]["description"] +"</p>");
		$(".battleInfo").append("<p><span class='normal'>Skills to have: &nbsp;</span><span class='normal'>Harmony: </span>" 
			+ battleData["challenge"]["skills"]["harmony"] + "<span class='normal'>&nbsp;Scale: </span>" 
			+ battleData["challenge"]["skills"]["scale"] + "<span class='normal'>&nbsp;Rhythm: </span>" 
			+ battleData["challenge"]["skills"]["rhythm"] + "<span class='normal'>&nbsp;Feeling: </span>" 
			+ battleData["challenge"]["skills"]["feeling"] + "</p>");
		$(".battleChoise").append("<h3>Go ahead with this Pianobattlechallenge?</h3>");
		$(".battleChoise").append('<button class="acceptChallengeBtn">Accept challenge!</button>');
		$(".battleChoise").append('<button class="changeChallengeBtn">Change challenge!</button>');

		$(".acceptChallengeBtn").click(function() {
			doChallenge();
			
			return false;
		});
		
		$(".changeChallengeBtn").click(function() {
			battleGo(true);
		
			return false;
		});
	}


choosePlayerClass();
});