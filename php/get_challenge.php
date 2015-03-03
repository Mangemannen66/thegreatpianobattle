<?php


//Nodebite black box
include_once("nodebite-swiss-army-oop.php");

//create a new instance of the DBObjectSaver class 
//and store it in the $ds variable
$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "piano_battle",
));
//Plockar fram fysiska spelaren det första vi gör!
$player = &$ds->player[0];
$player_name = $player->name;
$player_class = $player->battleZone;

//Virtuella spelare
$virtualPlayer = &$ds->virtualPlayer;
$virtualPlayer1_name = $virtualPlayer[0]->name;
$virtualPlayer1_battleZone = $virtualPlayer[0]->battleZone;
$virtualPlayer2_name = $virtualPlayer[1]->name;
$virtualPlayer2_battleZone = $virtualPlayer[1]->battleZone;



$random_challenge_nr = rand(0, 5);

$challenge_json_path = "../data/challenge" . $random_challenge_nr . ".json";

// Plocka challenge från json
$challenge_data = file_get_contents($challenge_json_path);

// Om vi inte hitter challenge filen, stoppa scriptet
if (!$challenge_data) {
  echo("Challenge json not found! ".$game_data_path);
  exit();
}

// Gör json till en associative arrays
$challenge = json_decode($challenge_data, true);

if(!$challenge) {
	echo("json_decode failed");
	exit();
}

unset($ds->challenge);

$current_challenge = &$ds->challenge;

$new_challenge = new Challenge($challenge);

$current_challenge[] = $new_challenge;

$player_success = $player->success;
$virtualPlayer1_success = $virtualPlayer[0]->success;
$virtualPlayer2_success = $virtualPlayer[1]->success;

$return_data = array(
  "playerName" => &$player_name,
  "playerClass" => &$player_class,
  "playerSuccess" => &$player_success,
  "challenge" => &$challenge,
  "virtualPlayer1Name" => &$virtualPlayer1_name,
  "virtualPlayer1Class" => &$virtualPlayer1_battleZone,
  "virtualPlayer1Success" => &$virtualPlayer1_success,
  "virtualPlayer2Name" => &$virtualPlayer2_name,
  "virtualPlayer2Class" => &$virtualPlayer2_battleZone,
  "virtualPlayer2Success" => &$virtualPlayer2_success
);


echo(json_encode($return_data));
