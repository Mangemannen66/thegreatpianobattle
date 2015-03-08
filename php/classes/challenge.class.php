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
    $sum= 0;
    $max = 0;
    $challenge_skills = array(
      "harmony" => $this->harmony,
      "scale" => $this->scale,
      "rhythm" => $this->rhythm,
      "feeling" => $this->feeling
    );

    foreach ($challenge_skills as $skill => $challenge_skill_points) {

      $player_skill_points = $player->{$skill};
      if (count($player->mytools) > 0) { 
        for ($i = 0; $i < count($player->mytools); $i++) {
          foreach ($player->mytools[$i]->skills as $tool_skill => $tool_skill_points) {
            if ($tool_skill == $skill) {
              $player_skill_points += $tool_skill_points;
            }
          }
        } 
      }

      $sum += $has > $needToHave ? $needToHave : $has;
      $max += $needToHave;
    }
    return $sum/$max;
  }

  public function playChallenge($players){
    $matches = array();
   
    foreach ($players as $player) {
      $matches[] = array(
        "success_rate" => $this->matchingToChallenge($player),
        "player" => $player,
      );
    }

    $winners = array();
    $last_match = 0;
    foreach ($matches as $match) {

      if ($match["success_rate"] > $last_match) {

        array_unshift($winners, $match["player"]);
        $last_match = $match["success_rate"];
      } else {
        $winners[] = $match["player"];
      }
    }
    
    return $winners;
  }
	
}