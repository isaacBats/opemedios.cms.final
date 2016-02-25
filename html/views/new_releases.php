<div id="content-press">
  <?php foreach ($types as $type) { ?>
  	<div class="tituloSeccion clear"><?php echo $type[$this->trans($lang, "tipo", "_type")] ?></div>
  	<?php foreach ($nuevos as $product) { 
  		 	foreach ($product as $p) { 
  			 	if( $p[$this->trans($lang, "tipo", "_type")] == $type[$this->trans($lang, "tipo", "_type")]){ 
  	?>

					<article class="item4Col">			    	
	  					<a href="/product/<?php echo $p["ur"] ?>">
		  					<div class="imageHolder">
						        <img
						        	alt="<?php echo $p[$this->trans($lang, "nombre", "_name")] ?>"
						            src="<?php echo 'http://www.alfonsomarinaebanista.com/images/' . $p["ur"] . '/' . $p["ur"] . '_alta1.jpg' ?>">
						    </div>
		  					<br class="clear">
		    				<br class="clear">
		  					<p><?php  echo ucwords( $p[$this->trans($lang, "nombre", "_name")] ) ?></p>
		  				</a>
				    </article>

  			<?php } 
  		 	} 
  	 	  } 
   		} 
   			?>
</div>
