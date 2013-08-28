<?php
include "reservations.php";

echo header("Content-Type:text/html; charset=utf-8");

$res = array (
	"resName"=> "", "resContact" => "", "resDate" => "", 
	"resPersons" => "", "resTime" => ""
);

$error = array (
	"resName"=> "Geen (of te korte) naam ingevuld", 
	"resContact" => "Geef een geldig e-mailadres of telefoonnummer op AUB!",
	"resDate" => "Geef een geldige datum (dd-mm-yyyy) op AUB!", 
	"resPersons" => "Online kunnen alleen reserveringen gemaakt worden voor %s tot %s personen!", 
	"resTime" => "Geef een geldige tijd op AUB!"
);

foreach ($res as $k=>$v) {
	if (isset($_GET[$k])) {
		$d = trim($_GET[$k]);
		if ($d != strip_tags($d)) {
			echo json_encode(array("error" => "System error"));
			die;
		}
		$res[$k] = $d;
	}
}

if (strlen($res["resName"]) < 4) {
	echo json_encode(array("error" => $error["resName"]));
	die;
}

if (strlen($res["resContact"]) < 7) {
	echo json_encode(array("error" => $error["resContact"]));
	die;
}

$date = null;
if (strlen($res["resDate"]) == 10) {
	$date = new DateTime($res["resDate"]);	
	if ($date->format("d-m-Y") != $res["resDate"]) { 
		$date = null;
	}
}
if (!$date) {
	echo json_encode(array("error" => $error["resDate"]));
	die;
}
$nPers = intval($res["resPersons"]);
$nPersMin = 1;
$nPersMax = 10;
if ($nPers <= $nPersMin || $nPers > $nPersMax) {
	echo json_encode(array("error" => 
		sprintf($error["resPersons"], $nPersMin, $nPersMax)));
	die;
}

$time = null;
foreach(ReservationCalendar::getTimes() as $v=>$name) {
	if ($res["resTime"] == $v) {
		$time = $res["resTime"];
	}
}
if (!$time) {
	echo json_encode(array("error" => $error["resTime"]));
	die;
}

$mailText = "Naam: {$res["resName"]}\n".
	"E-mail/tel: {$res["resContact"]}\n".
	"Datum & tijd: {$date->format("d-m-Y")} {$time}\n".
	"Aantal personen: {$nPers}\n";
	
$headers = 'From: noreply@eletapas.nl' . "\r\n" .
	'Reply-To: me@localhost' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();	
	
mail("me@localhost", "Reserva: {$res["resName"]}, {$date->format("d-m-Y")} {$time}, {$nPers} personas", $mailText, $headers);

echo json_encode(array("message" => "De volgende reservering is voor u gemaakt:\n\n$mailText\nHartelijk dank voor uw reservering.\n¡Nos vemos en eLe!"));

?>