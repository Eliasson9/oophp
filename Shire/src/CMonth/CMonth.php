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
		if(isset($_SESSION['calendar'])) {
			$temp = ($_SESSION['calendar']);
			if(isset($_GET['p']) && $_GET['p'] == 'Post') {
				$this->date = getdate(mktime(0, 0, 0, $temp['mon']+1, $temp['mday'], $temp['year']));
				$this->numDays = cal_days_in_month(CAL_GREGORIAN, $this->date['mon'], $this->date['year']);
				$this->startDay = getdate(mktime(0, 0, 0, $this->date['mon'], 1, $this->date['year']));
			} else if (isset($_GET['p']) && $_GET['p'] == 'Pre') {
				$this->date = getdate(mktime(0, 0, 0, $temp['mon']-1, $temp['mday'], $temp['year']));	
				$this->numDays = cal_days_in_month(CAL_GREGORIAN, $this->date['mon'], $this->date['year']);
				$this->startDay = getdate(mktime(0, 0, 0, $this->date['mon'], 1, $this->date['year']));							
			} else {
				$this->date = getdate(mktime(0, 0, 0, $temp['mon'], $temp['mday'], $temp['year']));	
				$this->numDays = cal_days_in_month(CAL_GREGORIAN, $this->date['mon'], $this->date['year']);
				$this->startDay = getdate(mktime(0, 0, 0, $this->date['mon'], 1, $this->date['year']));	
			}
		} else {
			$this->date = getdate();
			$this->numDays = cal_days_in_month(CAL_GREGORIAN, $this->date['mon'], $this->date['year']);
			$this->startDay = getdate(mktime(0, 0, 0, $this->date['mon'], 1, $this->date['year']));
		}	
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function getNumDays() {
		return $this->numDays;
	}
	
	public function getStartDay() {
		return $this->startDay['wday'];
	}
	
	public function getPreMonthDays($preDays) {
		if($this->checkPreYear()) {
			$preMonthDays = cal_days_in_month(CAL_GREGORIAN, 12, $this->date['year']-1);
			return getdate(mktime(0, 0, 0, $this->date['mon']-1, $preMonthDays-$preDays, $this->date['year']-1));
		} else {
			$preMonthDays = cal_days_in_month(CAL_GREGORIAN, $this->date['mon']-1, $this->date['year']);
			return getdate(mktime(0, 0, 0, $this->date['mon']-1, $preMonthDays-$preDays, $this->date['year']));
		}			
	}
	
	public function checkPreYear() {
		if(isset($this->date) && $this->date['mon'] == 1) {
			return true;
		} else {
			return false;
		}
	}	
}