<?php

class Character extends Base{
	
	public $name;
	public $tools = array();
	public $success = 50;
	public $harmony;
    public $scale;
    public $rhythm;
    public $technique;
    public $playerClass;

	public function __construct($name, $playerClass){
		$this->name = $name;
		$this->playerClass = $playerClass;
	}



}