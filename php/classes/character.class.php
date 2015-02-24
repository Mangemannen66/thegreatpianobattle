<?php

class Character {
	
	public $name;
	public $tools = array();
	public $success = 50;

	public function __construct($name){
		$this->name = $name;
	}


	
}