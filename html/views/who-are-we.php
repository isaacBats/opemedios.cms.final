<div class="registro">
	<div class="acerca-principal-quienes quienes-somos"><img src="/assets/images/<?php echo $about['imagen'] ?>">
		<?php 
			if( $lang == "es"){ 
				echo $about['comentario']; 
			}else{
				echo $about['coment'];
			} 
		?>
	</div>

	<div class="acerca-secundario-quienes">
		<?php if( $lang == "es"){ ?>
		<h2><?php echo $about['titulo'] ?></h2>
			<?php echo $about['contenido']; 
			 }else{ ?>
		<h2><?php echo $about['titulo_en'] ?></h2>
			<?php echo $about['contenido_en']; 
			 }?>
	</div>
	<!-- .acerca-secundario-quienes -->
	<p>&nbsp;</p>
</div>         
<br class="clear">