<?php
/**
 * A dice with images as graphical representation.
 *
 */
class CDiceImage extends CDice {
 
  	// Properties and methods extending or overriding base class
  	
	const FACES = 6;
  
   	/**
   	* Constructor
   	*
   	*/
	public function __construct() {
		// The constructur of the baseclass
  		parent::__construct(self::FACES);
  	}
	
	public function getRollsAsImageList() {
    	$html = "<ul class='dice'>";
    	foreach($this->rolls as $val) {
      		$html .= "<li class='dice-{$val}'></li>";
    	}
    	$html .= "</ul>";
    	return $html;
  	}
  
}