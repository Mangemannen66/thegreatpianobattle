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
		$(".playerSelect").html('');
		$(".battleInfo").html('');
		$(".battleChoise").html('');
		$(".battleInfo").append("<h3>Info regarding you and your competitors!</h3>");
		$(".battleInfo").append("<p>Your name: &nbsp;&nbsp;" + battleData["playerName"] + "&nbsp;&nbsp;Pianoplayer type: &nbsp;&nbsp;" + battleData["playerClass"] + "Succes points: &nbsp;&nbsp;" + battleData["playerSuccess"] + "</p>");
		$(".battleInfo").append("<p>Virtualplayer 1: &nbsp;&nbsp;" + battleData["virtualPlayer1Name"] + "&nbsp;&nbsp;Pianoplayer type: &nbsp;&nbsp;" + battleData["virtualPlayer1Class"] + "Succes points: &nbsp;&nbsp;" + battleData["virtualPlayer1Success"] + "</p>");
		$(".battleInfo").append("<p>Virtualplayer 2: &nbsp;&nbsp;" + battleData["virtualPlayer2Name"] + "&nbsp;&nbsp;Pianoplayer type: &nbsp;&nbsp;" + battleData["virtualPlayer2Class"] + "Succes points: &nbsp;&nbsp;" + battleData["virtualPlayer2Success"] + "</p>");
	

	}


choosePlayerClass();
});