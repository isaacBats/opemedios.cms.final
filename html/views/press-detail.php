	<div class="prensa">
		<div id="navigation" class="navigation">
			<ul class="thumbs noscript">
				<?php 
					foreach ($images as $img) {
					echo '<li style="float:left;">
							<a href="/assets/images/press/'.$img["imagen"].'" original="/assets/images/press/'.$img["imagen"].'">
								<img src="/assets/images/press/'.$img["imagen"].'" />
							</a>
						</li>';
					}
				?>
				
			</ul>
		</div>
		<div id="controls" class="controls"></div>
	    <div id="gallery">
	        <div style="left: 18%;position: absolute;top:200px;width: 30px;"><a href="#" id="navLeft"><img src="/assets/images/Prev1.png" alt=">>"/></a></div>
	        <div id="slideshow" class="slideshow"></div>
	        <div style="float: right;position: absolute;right: 18%;top:200px;width: 30px;"><a href="#" id="navRight"><img src="/assets/images/Next1.png" alt="<<"/></a></div>
	    </div>

		<br class="clear">
		
</div>