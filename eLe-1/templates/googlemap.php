<?php
/* Copyright (c) 
 * - 2012, Geert Bergman (geert@scrivo.nl)
 * - 2012, Michiel Meerdink (michiel@yardinternet.nl)
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 * 3. Neither the name of "Scrivo" nor the names of its contributors may be
 *    used to endorse or promote products derived from this software without
 *    specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang='<?php echo $page->language->id ?>'>
	<head>
		<?php include "templates/includes/head_common.php"; ?>
		<link rel="stylesheet" href="css/home.css" type="text/css" media="screen">
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" 
			src="http://maps.google.com/maps/api/js?sensor=false&amp;language=nl&amp;region=NL"></script>
		<script type="text/javascript">

	$(document).ready(function() {
	
	// latitude and longitude
	var eLeLocation = new google.maps.LatLng(52.088278,5.121458);
	// map options
	var mapOptions = {
		zoom: 14,
		center: eLeLocation,
		mapTypeId: google.maps.MapTypeId.ROADMAP, 
		streetViewControl: false
	}
	
	// create map
	var map = new google.maps.Map(document.getElementById("leader"), mapOptions);

	var eLeMarker = new google.maps.Marker({
		map: map, 
		position: eLeLocation, 
		icon: new google.maps.MarkerImage('img/map_marker.png'),
		title: 'Tapas Restaurant eLe', 
		zIndex: 4
	});
  
	var parkingMarker = new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(52.088551,5.119536),
		icon: new google.maps.MarkerImage('img/parking.png'),
		title:"Parkeergarage Springweg",
		zIndex: 1
	});  

	var parkingMarker = new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(52.090186,5.114729),
		icon: new google.maps.MarkerImage('img/parking.png'),
		title:"Parkeergarage Rijnkade",
		zIndex: 1
	});  
 
});
		</script>
	</head>
	<body>
		<?php include "templates/includes/main_menu.php"; ?>
		<div id="home">
			<div id="leader" class="center_clear">
			</div>
			<div id="leader_ds" class="center_clear">
			</div>		
			<div class="center_clear">
				<div id="entries">
					<div class="entry"><a href="index.php?p=<?php 
							echo $ctx->labels->FUERZA?>"><img src="<?php 
								echo $page->path[0]->properties->imgBlock1->src?>"><br>
						<h3><?php echo $page->path[0]->properties->titleBlock1->value?></h3></a>
						<?php echo $page->path[0]->properties->textBlock1->html?></div>
					<div class="entry"><a href="index.php?p=<?php 
							echo $ctx->labels->ACTIVITEITEN?>"><img src="<?php 
								echo $page->path[0]->properties->imgBlock2->src?>"><br>
						<h3><?php echo $page->path[0]->properties->titleBlock2->value?></h3></a>
						<?php echo $page->path[0]->properties->textBlock2->html?></div>
					<div class="entry"><?php include "reservations/reservations_box.php"; ?></div>
				</div>
			</div>
		</div>
		<?php include "templates/includes/footer.php"; ?>
	</body>
</html>