<div class="product-cc">
	
	<div class="product-care-image">
		<img src="/assets/images/<?php echo $care['imagen'] ?>">
	</div>

	<div class="acerca-secundario-quienes">
		<h2>
			<?php echo $this->trans( $lang , strtoupper($care['titulo']) , strtoupper($care['titulo_en'])) ?>
		</h2>

	</div>
	<div class="product-care">
		
		<?php 
			if( $lang == "es"){ 
				echo $care['contenido'];
			}else{
				echo $care['contenido_en'];
		 	}
		?>
	</div>

	
	<p>&nbsp;</p>
</div>         
<br class="clear">

    