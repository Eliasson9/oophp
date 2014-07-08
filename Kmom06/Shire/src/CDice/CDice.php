<?php

class CDice {
	
	protected $rolls = array();
	private $faces;
	
	/**
   	* Constructor
   	*
   	* @param int $faces the number of faces to use.
   	*/
  	public function __construct($faces=6) {
    	$this->faces = $faces;
  	}
	
	public function __destruct(){
		unset($this);
	}
	
	public function getRolls() {
		return $this->rolls;	
	}
	
	public function getFaces() {
		return $this->faces;
	}
	
	public function roll($times) {
		$this->rolls = array();
		
		for($i = 0; $i < $times; $i++){
			$this->rolls[] = $this->getLastRoll();
		}
	}
	
	public function getLastRoll() {
		return rand(1, 6);
	}
	
	public function getTotal() {
		return array_sum($this->rolls);	
	}
}