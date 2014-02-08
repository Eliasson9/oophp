<?php

class CDice {
	
	public $rolls = array();
	
	public function Roll($times) {
		$this->rolls = array();
		
		for($i = 0; $i < $times; $i++){
			$this->rolls[] = rand(1, 6);
		}
	}
	
	public function getTotal() {
		return array_sum($this->rolls);	
	}
}