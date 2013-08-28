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
<html lang="<?php echo $page->language->isoCode ?>">
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
					<?php echo $page->properties->content->html ?>
				</div>
				<div id="teasers">
					<?php include "templates/includes/teasers.php"; ?>
				</div>
				<div class="center_clear"></div>
			</div>
		</div>
		<?php include "templates/includes/entries.php"; ?>
		<?php include "templates/includes/footer.php"; ?>
	</body>
</html>
