	<?php

class Character extends Base {
  protected $name;
  //public $tools = array();
  protected $success = 50;
  protected $harmony;
  protected $scale;
  protected $rhythm;
  protected $feeling;
  protected $battleZone;
  public $mytools = array();

  public function __construct($name, $battleZone){
		$this->name = $name;
		$this->battleZone = $battleZone;
	}

  public function looseTools(&$tools) {
	if (count($this->mytools) < 3) { 
		$random_number = rand(0, count($tools)-1); 
		$random_tool = $tools[$random_number]; 
		//Pushar hjälpmedel till array
		$this->mytools[] = $random_tool; 
		array_splice($tools, $random_number, 1);
		return $random_tool->description;
	}
	else {
		return NULL;
	}
  }

  public function acceptChallenge($challenge, &$tools) { 
   	$new_tool = $this->looseTools($tools);
   	if ($new_tool == NULL) {
   		return $challenge->title." You accepted the challenge! You can't get any more tools. Sorry!";
   	}
   	else { 
   		return $challenge->title." You accepted the challenge! Here's a tool for you: ".$new_tool; 
   	}
 
  }

  public function changeChallenge() {
		$this->success -= 5;
  }

  public function carryOutChallenge($challenge, $virtualPlayers) {
	
		$player_array = array($this);
		$all_players = array_merge($player_array, $virtualPlayers);
		$winner_list = $challenge->play_challenge($all_players);
		
		$winner_list[0]->success += 15;
	
		$winner_list[count($winner_list)-1]->success -= 5;
		
		return $winner_list;
	}

	public function carryOutChallengeWithCompanion($challenge, $virtualPlayers) {
	
		$random_number = rand(0, count($virtualPlayers)-1); 
		$companion = $virtualPlayers[$random_number];
		
		$team = new Team("Team VillageVanguard", $this, $companion);
		
		$team_companion = array_search($companion, $virtualPlayers);
		array_splice($virtualPlayers, $team_companion, 1);

		$all_players = array($team, $virtualPlayers[0]);
		$winner_list = $challenge->play_challenge($all_players);
		if ($winner_list[0] === $team) {
			$team->team_members[0]->success += 9;
			$team->team_members[1]->success += 9;
			$winner_list[count($winner_list)-1]->success -= 5;
		}
		else {

			if ($winner_list[count($winner_list)-1] === $team) {
				$team->team_members[0]->success -= 5;
				$team->team_members[1]->success -= 5;
				$winner_list[0]->success += 15;
			}
		}
		return $winner_list;
	}

	public function get_name() {
		return $this->name;
	}

	public function get_battleZone() {
		return $this->battleZone;
	}

	public function get_success() {
		return $this->success;
	}

	public function get_harmony() {
		return $this->harmony;
	}

	public function get_scale() {
		return $this->scale;
	}

	public function get_rhythm() {
		return $this->rhythm;
	}

	public function get_feeling() {
		return $this->feeling;
	}

	public function set_success($val) {
		// Inte mer än hundra poäng tack
		if ($val < 0) {
			$val = 0;
		}
		else if ($val > 100) {
			$val = 100;
		}		
		$this->success = $val;
	}
public function set_harmony($val) {
		if ($val < 0 || $val > 100) {
			throw new Exception("Harmony skill must be within 0 - 100");
		}
		$this->harmony = $val;
	}

	public function set_scale($val) {
		if ($val < 0 || $val > 100) {
			throw new Exception("Scale skill must be within 0 - 100");
		}
		$this->scale = $val;
	}

	public function set_rhythm($val) {
		if ($val < 0 || $val > 100) {
			throw new Exception("Rhythm skill must be within 0 - 100");
		}
		$this->rhythm = $val;
	}

	public function set_feeling($val) {
		if ($val < 0 || $val > 100) {
			throw new Exception("Feeling skill must be within 0 - 100");
		}
		$this->feeling = $val;
	}


}
