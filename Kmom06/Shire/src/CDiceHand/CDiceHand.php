<?php

class CDiceHand {
	/**
	 * Properties
	 */
	 private $dice;
	 private $numDices;
	 private $sum;
	 
	 public function __construct() {
	 	$this->numDices = 5;
		$this->dice = new CDice();
	 }
	 
	 /**
	  *  Roll the dices
	  */
	 public function roll() {
	 	$this->sum = array();
	 	for($i = 0; $i < $this->numDices; $i++) {
	 		$this->sum[] = $this->dice->getLastRoll();
		}
	 }
	 
	 /**
	  *  Return the total value
	  */
	 public function getTotal() {
	 	return array_sum($this->sum);
	 }
	 
	 /**
	  *  Display dices as images
	  */
	 public function getRollsAsImages() {
	 	$html = "<ul class='dice'>";
    	foreach($this->sum as $val) {
      		$html .= "<li class='dice-{$val}'></li>";
    	}
    	$html .= "</ul>";
    	return $html;
	 }
	
}
