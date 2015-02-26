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
unset($ds->player);
unset($ds->virtualPlayers);
unset($ds->tools);


$player = &$ds->player;
$virtualPlayers = &$ds->virtualPlayers;
$tools = &$ds->tools;

$tools[] = new Tool("A HarmonyBook",
  array(
    "harmony" => 20
  )
);

$tools[] = new Tool("A ScaleBook.", 
  array(
    "scale" => 30,
  )
);

$tools[] = new Tool("A HanonBook.", 
  array(
    "scale" => 20,
  )
);

$tools[] = new Tool("A Metronome.", 
  array(
    "rhythm" => 15,
  )
);

$tools[] = new Tool("A rhythmbook.", 
  array(
    "rhythm" => 10,
  )
);

$tools[] = new Tool("A Tudor.", 
  array(
    "harmony" => 20,
    "rhythm" => 20,
    "feeling" => 20,
    "scale" => 20,
  )
);

$tools[] = new Tool("A recording device.", 
  array(
    "harmony" => 20,
    "rhythm" => 20,
    "feeling" => 20,
    "scale" => 20,    
  )
);

$tools[] = new Tool("A videocamera.", 
  array(    
  	"harmony" => 20,
    "rhythm" => 20,
    "feeling" => 20,
    "scale" => 20,  
  )
);

$tools[] = New Tool("Spotify", 
  array(
    "harmony" => 20,
    "rhythm" => 20,
    "feeling" => 20,
    "scale" => 20,  
  )
);


$player = new $player_class($player_name, $player_class);

$player[] = $new_player;

$classes = array("RockPianoPlayer" , "PopPianoPlayer" , "JazzPianoPlayer");

$total_classes = array_search($player_class, $classes);
array_splice($classes, $total_classes, 1);

$virtualPlayers[] = new $classes[0]("Herbie Hancock", $classes[0]);
$virtualPlayers[] = new $classes[0]("Chick Corea", $classes[1]);


echo(json_encode($echo_data));

