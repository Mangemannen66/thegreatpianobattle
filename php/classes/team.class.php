<?php

class Team extends Character {

	public $team_members = array();
	public $mytools = array();

	protected $harmony;
	protected $scale;
	protected $rhythm;
	protected $feeling;

	public function __construct($name, $player, $team_player) {
		$this->team_members[] = $player;
		$this->team_members[] = $team_player;

		$this->harmony = $player->harmony + $team_player->harmony;
		$this->scale = $player->scale + $team_player->scale;
		$this->rhythm = $player->rhythm + $team_player->rhythm;
		$this->feeling = $player->feeling + $team_player->feeling;

    	for ($i=0; $i < count($this->team_members); $i++) { 
      	for ($j=0; $j < count($this->team_members[$i]->mytools); $j++) { 
        		$this->mytools[] = $this->team_members[$i]->mytools[$j];
      	}
   	}
		parent::__construct($name, "");
	}

	public function looseTool(&$tools) {
		foreach ($this->team_members as $member) {
			$member->looseTool($tools);
		}
	}

}