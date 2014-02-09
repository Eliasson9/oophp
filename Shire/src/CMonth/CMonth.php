<?php

class CMonth{
	/**
	*	Parameters
	*/	
	private $startDay;
	private $numDays;
	protected $date;
	
	/**
	*	Constructor
	*/
	public function __construct(){
		$this->date = getdate();
		$this->numDays = cal_days_in_month(CAL_GREGORIAN, $this->date['mon'], $this->date['year']);
		$this->startDay = getdate(mktime(0, 0, 0, $this->date['mon'], 1, $this->date['year']));
	}
	
	public function getMonth() {
		return $this->date['month'];
	}
	
	public function getNumDays() {
		return $this->numDays;
	}
	
	public function getStartDay() {
		return $this->startDay['wday'];
	}
	
	public function getPreMonthDays($preDays) {
			$preMonthDays = cal_days_in_month(CAL_GREGORIAN, $this->date['mon']-1, $this->date['year']);
			return getdate(mktime(0, 0, 0, $this->date['mon']-1, $preMonthDays-$preDays, $this->date['year']));
	}
	
}