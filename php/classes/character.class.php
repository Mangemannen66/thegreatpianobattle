<?php

class Character extends Base{
	
	public $name;
	public $tools = array();
	public $success = 50;
	public $harmony;
    public $scale;
    public $rhythm;
    public $feeling;
    public $battleField;

	public function __construct($name, $battleField){
		$this->name = $name;
		$this->battleField = $battleField;
	}



}