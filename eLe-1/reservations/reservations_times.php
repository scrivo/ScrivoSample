<?php
include "reservations.php";
echo header("Content-Type:text/html; charset=utf-8");
echo json_encode(array("times" => ReservationCalendar::getTimes()));
?>
