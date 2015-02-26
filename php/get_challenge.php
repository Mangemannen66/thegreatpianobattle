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

$player = &$ds->player[0];
$player_name = $player->name;
$player_class = $player->battleField;


$virtualPlayers = &$ds->virtualPlayers;
$virtualPlayers1_name = $virtualPlayers[0]->name;
$virtualPlayers1_battleField = $virtualPlayers[0]->battleField;
$virtualPlayers2_name = $virtualPlayers[1]->name;
$virtualPlayers2_battleField = $virtualPlayers[1]->battleField;










echo(json_encode($return_data));
