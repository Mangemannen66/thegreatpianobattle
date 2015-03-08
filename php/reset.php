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
//if (isset($_REQUEST["startOver"])) {
  unset($ds->player);
  unset($ds->virtualPlayer);
  unset($ds->tools);
  unset($ds->challenge);
//}

echo(json_encode(true));
