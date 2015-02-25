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

//destroy old game data
unset($ds->players);
unset($ds->challenges);
unset($ds->tools);
unset($ds->current_challenge);


$player_name = "Magnus Danielsson";
$player_class = "RockPianoPlayer";
$echo_data = $player_class;

echo(json_encode($echo_data));

