<?php

class Challenge extends Base {
	
	public $id;
	public $title;
	public $description;
	public $challenge;
	public $harmony = 0;
    public $scale = 0;
    public $rhythm = 0;
    public $feeling = 0;

	public function __construct($challenge){
	$this->id = $challenge["id"];
    $this->title = $challenge["title"];
    $this->description = $challenge["description"];
    $this->harmony = $challenge["skills"]["harmony"];
    $this->scale = $challenge["skills"]["scale"];
    $this->rhythm = $challenge["skills"]["rhythm"];
    $this->feeling = $challenge["skills"]["feeling"];

	}


  public function matchingToChallenge($player){
    //total points a player has
    $sum= 0;
    //total points possible for this challenge
    $max = 0;

    //calculate how good of a match a player is to this challenge
    foreach($this->skills as $skill => $points){
      //by checking how many skillpoints the challenge requires
      $needToHave = $points;
      //and by checking how many skillpoints a player has
      $has = $player->{$skill.'Skill'}; 

      //check if a player has any tools
      if (count($player->tools) > 0) {
        //if they do, go through them
        for ($i = 0; $i < count($player->tools); $i++) {
          //and for each skill the tool has
          foreach ($player->tools[$i]->skills as $toolSkill => $value) {
            //if a toolSkill matches the skill we are currently calculating
            if ($toolSkill == $skill) {
              //add the toolSkill points 
              $has += $value;
            }
          }
        } 
      }

      //if a player has more points than needToHave, only count the points needToHave (to preserve our percentage)
      //else count the skillpoints a player has
      $sum += $has > $needToHave ? $needToHave : $has;
      $max += $needToHave;
    }

    //return the percentage of skill points they have
    return $sum/$max;
  }

  public function playChallenge($players){
    $matches = array();
    //get chances to win for each player
    foreach ($players as $player) {
      $matches[] = array(
        "success_rate" => $this->matchingToChallenge($player),
        "player" => $player,
      );
    }

    //then find out who won
    $winners = array();
    $last_match = 0;
    foreach ($matches as $match) {
      //if higher score than current 1st place
      if ($match["success_rate"] > $last_match) {
        //add first in winners array
        array_unshift($winners, $match["player"]);
        $last_match = $match["success_rate"];
      } else {
        //add last in winners array
        $winners[] = $match["player"];
      }
    }
    
    return $winners;
  }
	
}