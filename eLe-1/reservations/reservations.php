<?php

class ReservationCalendar {

	public static function initData() {

		$now = new DateTime("now");
		$end = clone $now;
		$end->add(new DateInterval('P3M'));
	
		$r = new DateTime($now->format("Y")."-".$now->format("m")."-1");
		$k = "";
		$res = new stdClass;
		while ($r <= $end) {
			$nk = $r->format("Y") . $r->format("m");
			if ($nk != $k) {
				$k = $nk;
				$res->$k = "";
			}
			if ($r <= $now) {
				$res->$k .= "0";
			} else if ($r->format("w") == "1") {
				$res->$k .= "0";
			} else {
				$res->$k .= "2";
	 		}		 
			$r->add(new DateInterval('P1D'));
		}
		
		return (object) array(
			"serverTime" => $now->format("Y").", ".
				(intval($now->format("m"))-1).", ".$now->format("d"),
			"endTime" => $end->format("Y").", ".
				(intval($end->format("m"))-1).", ".$end->format("d"),
			"availabeDays" => $res
		);
	}
	
	public static function getTimes() {
		return array(
			"17:30" => "17:30",
			"18:00" => "18:00",
			"18:30" => "18:30",
			"19:00" => "19:00",
			"19:30" => "19:30",
			"20:00" => "20:00",
			"20:30" => "20:30",
			"21:00" => "21:00",
			"21:30" => "21:30"
		);
	}
	
	public static function getStartDay() {
		$now = new DateTime("now");
		$now->add(new DateInterval('P1D'));
		return $now;
	}
}

?>