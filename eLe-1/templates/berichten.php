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

use \Scrivo\SocialMedia\SocialMediaShareButtons;
use \Scrivo\Request;
use \Scrivo\String;

$id = Request::get("id", Request::TYPE_INTEGER, 0);
$posts = $page->properties->posts->application->items;
$f = new String("");
if (!$id) {
	$f = Request::get("f", Request::TYPE_STRING, $f);
} else {
	$posts = $posts = array($id => $posts[$id]);
}
?>
<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang='<?php echo $page->language->id ?>'>
	<head>
		<?php include "templates/includes/head_common.php"; ?>
		<link rel="stylesheet" href="css/standard.css" type="text/css" media="screen">
	</head>
	<body>
		<?php include "templates/includes/main_menu.php"; ?>
		<div id="body">
			<?php include "templates/includes/path_still.php"; ?>
			<div class="center_clear bgmenu">
				<?php include "templates/includes/submenu.php"; ?>
				<div id="content" class="content">
					<dl class="menu">
<?php 

	foreach ($posts as $item) {
	
		if ($item->properties->type->value->equals($f)) {
			continue;
		}
		
		if ($item->properties->img) {
			echo "<img style=\"margin-left:10px;margin-bottom:10px\" width=\"200\" 
					align=\"right\" src=\"{$item->properties->img->src}\" 
				alt=\"{$item->properties->img->alt}\" 
				title=\"{$item->properties->img->title}\">";
		}
		echo "<h2>{$item->title}</h2>";
		echo $item->properties->text->html;
		if ($item->properties->download->href) {
				echo "<p><a href=\"{$item->properties->download->href}\" 
					target=\"{$item->properties->download->target}\" 
					title=\"{$item->properties->download->title}\">";
			if ($item->properties->download->title) {
				echo $item->properties->download->title;
			} else {
				echo "Download bestand";
			}
			echo "</a></p>";
		}
		echo "<p style=\"clear:both\">";
		
		echo "<div style=\"float:right\">";

		$url = "{$ctx->config->WWW_ROOT}/index.php?p=".PAGE_ID."&id={$item->id}";
		$url = "http://www.eletapas.nl/index.php?p=".PAGE_ID."&id={$item->id}";

		$sb = new SocialMediaShareButtons($url, "nl_NL");

		echo $sb->getFacebookLikeButton(array("action"=>"like"));

		echo "&nbsp;";

		echo $sb->getTwitterTweetButton(array("data-via" => "eletapas", 
			"width" => "100px"));

		echo "</div>";

		echo "Geplaatst op: ".$item->dateOnline->format("d-m-y H:i")."</p>";

		echo "<hr style=\"color:rgb(250, 202, 0);background-color:rgb(250, 202, 0);height:1px;border:none;\">";

	}

?>
					</dl>
				</div>
				<div id="teasers">
					<div class="teaser"><ul>
						<li><a href="index.php?p=<?php echo PAGE_ID?>&f=Optreden">Optredens</a></li>
						<li><a href="index.php?p=<?php echo PAGE_ID?>&f=Workshop">Workshops</a></li>
						<li><a href="index.php?p=<?php echo PAGE_ID?>&f=Les">Lessen</a></li>
						<li><a href="index.php?p=<?php echo PAGE_ID?>&f=Uitje">Uitjes</a></li>
						<li><a href="index.php?p=<?php echo PAGE_ID?>">Alles</a></li>
						</ul>
					</div>
					<?php include "templates/includes/teasers.php"; ?>
				</div>
				<div class="center_clear"></div>
			</div>
		</div>
		<?php include "templates/includes/entries.php"; ?>
		<?php include "templates/includes/footer.php"; ?>
	</body>
</html>