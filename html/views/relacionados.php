<div class="gallery-products">
		<!--  Foreach $products  -->
		<?php
			foreach ($products as $key => $value) {
				echo '<a href="'.$this->url($lang, "/product/".$value['ur']).'" class="rel">
						<img 
							alt="'.$value["nombre"].'" 
							src="http://www.alfonsomarinaebanista.com/images/'.$value["ur"].'/'.$value["ur"].'_alta1.jpg"
							whith="80"
							height="80"
						>
						<h2>'.$value['nombre'].'</h2>
					 </a>';
			}  
		?>
</div>