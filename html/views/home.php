		<div class="homeWrapper">
			<div id="imgHome">
				<img src="/assets/images/<?php echo $gallery['slug']."/".$fondo; ?>">

				<!-- container for the slides -->
				<div class="images">
				<?php foreach ($image as $value) { ?>
					<div><img src="/assets/images/<?php echo $gallery['slug']."/".$value['imagen'] ?>"></div>
				<?php } ?>
				</div>
				  
				<!-- the tabs -->
				<div class="slidetabs">
				<?php foreach ($image as $value) { ?>
					<a href="#"></a>
				<?php } ?>
				</div>
			</div>
		</div>
<br class="clear"/>


	