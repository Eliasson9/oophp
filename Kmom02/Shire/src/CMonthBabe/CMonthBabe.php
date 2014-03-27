<?php

class CMonthBabe{
	/**
	*	Parameters
	*/	
	private $calendar;
	
	/**
	*	Constructor
	*/
	public function __construct() {
		$this->calendar = new CMonth();	
	}
	
	public function __destruct() {
		$_SESSION['calendar'] = $this->calendar->getDate();
	}
	
	public function getCalendar() {
		return $this->generateCalendar();	
	}
	
	public function generateCalendar() {
		$numDays = $this->calendar->getNumDays();
		$startDay = $this->calendar->getStartDay();
		$preDates = $startDay-1;
		$postDates = 1;
		$date = 1;
		$start = false;
		$html = "";
		for($i = 0; $i < 6; $i++) {
			$html .= "<div class='week'>\n";
			for($j = 0; $j < 7; $j++) {
				if($j == $startDay && !$start) {
					$start = true;	
				}
				if($start && $date != $numDays+1) {
					if($j == 0) {
						$html .= "<div class='day' style='color: #FF0000'>{$date}</div>\n";
					}else {
						$html .= "<div class='day'>{$date}</div>\n";
					}
					$date++;
				} else {
					if($i == 0) {
						$pre = $this->calendar->getPreMonthDays($preDates--);
						$html .= "<div class='day' style='color: #BBBBBB'>{$pre['mday']}</div>\n";
					} else {
						$html .= "<div class='day' style='color: #BBBBBB'>{$postDates}</div>\n";
						$postDates++;
					}
				}
			}
			$html .= "</div>\n";
		}
		return $html;
	}
	
	public function getMonthYear(){
		$date = $this->calendar->getDate();
		return $date['month'].' '.$date['year'];	
	}
	
	public function week() {
		$html = "<div class='week'>";
		$html .= "<div class='weekDay'>SUN</div>";
		$html .= "<div class='weekDay'>MON</div>";
		$html .= "<div class='weekDay'>TUE</div>";
		$html .= "<div class='weekDay'>WED</div>";
		$html .= "<div class='weekDay'>THU</div>";
		$html .= "<div class='weekDay'>FRI</div>";
		$html .= "<div class='weekDay'>SAT</div>";
		$html .= "</div>";
		return $html;
	}
	
}