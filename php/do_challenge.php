<?php

include_once("nodebite-swiss-army-oop.php");

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
$virtualPlayers = &$ds->virtualPlayers;
$virtualPlayer1_name = $virtualPlayers[0]->name;
$virtualPlayer1_battleZone = $virtualPlayers[0]->battleZone;
$virtualPlayer2_name = $virtualPlayers[1]->name;
$virtualPlayer2_battleZone = $virtualPlayers[1]->battleZone;
$challenge = &$ds->challenge[0];
$tools = &$ds->tools;


$accepted_string = $player->acceptChallenge($challenge, $tools);


$player_success = $player->success;
$virtualPlayer1_success = $virtualPlayers[0]->success;
$virtualPlayer2_success = $virtualPlayers[1]->success;
$my_tools = $player->mytools;


$game_data = array(
  "playerName" => &$player_name,
  "playerClass" => &$player_class,
  "playerSuccess" => &$player_success,
  "challenge" => &$challenge,
  "virtualPlayer1Name" => &$virtualPlayer1_name,
  "virtualPlayer1Class" => &$virtualPlayer1_battleZone,
  "virtualPlayer1Success" => &$virtualPlayer1_success,
  "virtualPlayer2Name" => &$virtualPlayer2_name,
  "virtualPlayer2Class" => &$virtualPlayer2_battleZone,
  "virtualPlayer2Success" => &$virtualPlayer2_success,
  "challenge" => &$challenge,
  "mytools" => &$my_tools,	
  "acceptedString" => &$accepted_string  
);
// Takes array, encodes it to Json & sends it to Ajax
echo(json_encode($game_data));
