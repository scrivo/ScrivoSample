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

use \Scrivo\Page;

?>
		<div id="entries">
			<div class="center_clear">
				<div>
					<div style="background-image: url(<?php echo $page->path[0]->properties->imgBlock1->src?>)">
						<h3><a href="index.php?p=<?php echo $ctx->labels->FUERZA?>"><?php 
							echo $page->path[0]->properties->titleBlock1->value?></a></h3></div>
					<div style="background-image: url(<?php echo $page->path[0]->properties->imgBlock2->src?>)">
						<h3><a href="index.php?p=<?php echo $ctx->labels->ACTIVITEITEN?>"><?php 
							echo $page->path[0]->properties->titleBlock2->value?></a></h3></div>
					<div style="background-image: url(<?php echo $page->path[0]->properties->imgBlock3->src?>)">
						<h3><a href="index.php?p=<?php 
							echo Page::fetch($ctx, $ctx->labels->TETERIA)->navigableChildren[0]->id?>"><?php 
							echo $page->path[0]->properties->titleBlock3->value?></a></h3></div>
				</div>
			</div>
		</div>
