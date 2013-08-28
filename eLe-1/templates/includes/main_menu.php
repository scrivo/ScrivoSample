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

?>
		<div id="header">
			<div class="center_clear">

			<div id="social" style="float: right; margin-top: 10px">
<?php
	// Include some social buttons

	$sb = new SocialMediaShareButtons("http://www.facebook.com/eletapas", "nl_NL");

	echo $sb->getFacebookLikeButton(array("action"=>"like"));

	echo "&nbsp;";

	echo $sb->getTwitterTweetButton(array("data-via" => "eletapas", 
		"width" => "100px"));

?> 			</div>

				<a href="/"><img src="img/logo.png"></a>
				<ul>
<?php
	// Print a home menu button...
	echo "<li><a href=\"index.php?p={$page->path[0]->id}\"";
	if (PAGE_ID == $page->path[0]->id) {
		 echo " class=\"sel\"";
	}
	echo ">".$page->path[0]->title->toUpperCase()."</a></li>";

	// ...and the menu of the root page.
	foreach ($page->path[0]->navigableChildren as $itm) {
		if (isset($itm->navigableChildren[0])) {
			echo "<li><a href=\"index.php?p={$itm->navigableChildren[0]->id}\"";
			if (count($page->path)>1 && $page->path[1]->id == $itm->id) {
				 echo " class=\"sel\"";
			}
			echo ">".$itm->title->toUpperCase()."</a></li>";
		}
	}
?>
				</ul>
			</div>
		</div>
