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

	$imageList = $page->properties->slideShow->application;

	$imgs = array();
	$firstslide = "";
	foreach	($imageList->items as $img) {
		$imgs[] = "[\"{$img->properties->image->src}\", \"\", \"\", \"{$img->title}\"]";
		if (!$firstslide) {
			$firstslide = $img->properties->image->src;
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="<?php echo $page->language->isoCode ?>">
	<head>
		<?php include "templates/includes/head_common.php"; ?>
		<link rel="stylesheet" href="css/home.css" type="text/css" media="screen">
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/fadeslideshow.js"></script>
		<script type="text/javascript">
		
var mygallery=new fadeSlideShow({
	wrapperid: "leader", 
	dimensions: [1000, 388], 
	imagearray: [<?php echo implode(",", $imgs);?>],
	displaymode: {type:'auto', pause:3500, cycles:0, wraparound:false},
	fadeduration: 1000, 
	descreveal: "always"
});

		</script>
		<style type="text/css">
		
#home #entries #rm_search_box  {
	padding: 1em 2em;
	margin: 0px;
}

		</style>		
	</head>
	<body>
		<?php include "templates/includes/main_menu.php"; ?>
		<div id="home">
			<div id="leader" class="center_clear" 
				style="background-image: url(<?php echo $firstslide?>)"></div>
			<div id="leader_ds" class="center_clear"></div>
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
					<div class="entry">
						<?php include "reservations/reservations_box.php"; ?>
					</div>
				</div>
			</div>
		</div>
		<?php include "templates/includes/footer.php"; ?>
	</body>
</html>