<?php

class Character extends Base{
	
	public $name;
	public $tools = array();
	public $success = 50;
	public $harmony;
    public $scale;
    public $rhythm;
    public $feeling;
    public $battleZone;

	public function __construct($name, $battleZone){
		$this->name = $name;
		$this->battleZone = $battleZone;
	}



}