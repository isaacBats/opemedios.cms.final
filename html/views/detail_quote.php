<div class="profile">
	<div class="profile_menu">
		
		<h2><?php echo $_SESSION["user"]['nombre'].' '.$_SESSION["user"]['apellidos'] ?></h2>
		<?php require "profile.menu.php"; ?>
	</div>		
	<div class=" profile_form ">
		<?php 
			foreach ($products as $product) {
				$html = '<div class="listado">
							<div class="list-item">
				                <div class="img-listado">
									<a href="'.$this->url($lang,'/product/'.$product['ur']).'">
				                    	<img 
								            alt="'.$product["nombre"].'" 
								            src="http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta2.jpg">
									</a>
				                </div>
				                <div class="texto-listado">
				                    <a href="'.$this->url($lang,'/product/'.$product['ur']).'"><h2>'.$product['nombre'].'</h2></a>
				                    '.$product['ur'].'
				                </div>
				                <br class="clear">
				            </div>
				         </div>';
				echo $html;
			}
		?>		
	</div>
	<br class="clear">
</div>