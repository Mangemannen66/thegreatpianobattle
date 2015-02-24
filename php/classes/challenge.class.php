<?php

class Challenge extends Base {
	
	public $id;
	public $title;
	public $description;
	public $challenge;
	public $harmony = 0;
    public $scale = 0;
    public $rhythm = 0;
    public $technique = 0;

	public function __construct($challenge){
	$this->id = $challenge["id"];
    $this->title = $challenge["title"];
    $this->description = $challenge["description"];
    $this->harmony = $challenge["skills"]["harmony"];
    $this->scale = $challenge["skills"]["scale"];
    $this->rhythm = $challenge["skills"]["rhythm"];
    $this->technique = $challenge["skills"]["technique"];

	}




	
}