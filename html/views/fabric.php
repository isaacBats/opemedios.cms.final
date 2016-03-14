<div class="registro">
	<div class="acerca-principal">
		<img src="/assets/images/<?php echo $fabric['imagen'] ?>"/>
		<?php 
			if( $lang == "es"){ 
				echo $fabric['contenido'];
			}else{
				echo $fabric['contenido_en'];
			}
		?>
	</div>
	<!-- .acerca-principal -->
</div> <!--.registro-->        
<br class="clear"/>

