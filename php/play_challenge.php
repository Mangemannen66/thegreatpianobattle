<?php

include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "piano_battle",
));


$player = &$ds->player[0];
$virtualPlayers = &$ds->virtualPlayers;
$challenge = &$ds->challenge[0];

if (!isset($_REQUEST["challenge_companion"])) {

  echo(json_encode(false));
  exit();
} 
else {
	$companion = $_REQUEST["challenge_companion"];
	if($companion == "true") {
		$player->success -= 5;
		$winner_list = $player->carryOutChallengeWithCompanion($challenge, $virtualPlayers);
	}
	else {
		// Calling method carryOutChallenge to get results
		$winner_list = $player->carryOutChallenge($challenge, $virtualPlayers);	
	}
	// If you don't win you lose a random tool
	for ($i = 1; $i < count($winner_list); $i++)	{
		$winner_list[$i]->looseTool($tools);
	}
}
// Success points logic
$player_array = array($player);
$all_players = array_merge($player_array, $virtualPlayers);

$return_string = "";
$game_over = false;

for ($i = 0; $i < count($all_players); $i++) {
	$current_player = $all_players[$i];
	if ($current_player->success >= 100) {
		if ($current_player == $player) {
			$game_over = true;
			$return_string = "You have reached 100 success points. Game Over!";
		} else {
			$virtualPlayer_index = array_search($current_player, $virtualPlayers);
			array_splice($virtualPlayers, $virtualPlayer_index, 1);
			$return_string = $current_player->name ." has reached 100 success points!";
		}
	}
	else if ($current_player->success <= 0) {
		if ($current_player == $player) {
			$return_string = "You have reached 0 success points. Game Over!";
			$game_over = true;
		} else {
			$virtualPlayer_index = array_search($current_player, $virtualPlayers);
			array_splice($virtualPlayers, $virtualPlayer_index, 1);
			$return_string = $current_player->name." has reached 0 success points!";
		}
	}
}

if (count($virtualPlayers) <= 0) {
	$return_string = "You have no one else to challenge. Game Over!";
	$game_over = true;
}

// Collect all data needed in an associative array
$return_data = array (
	"returnString" => &$return_string,
	"gameOver" => &$game_over,
	"challenge" => &$challenge,
	"firstPlace" => &$winner_list[0],
	"secondPlace" => &$winner_list[1],
	"thirdPlace" => &$winner_list[2]
);
// Takes array, encodes it to Json & sends it to Ajax
echo(json_encode($return_data));
