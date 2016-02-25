 <?php //print_r($nuevo) ?>
<div id="content-press">
        <?php foreach ($nuevos as $key => $product) {
                $tipo = $product[$this->trans($lang, "tipo", "_type")];
        ?>
<div class="tituloSeccion clear"><?php ucfirst(strtolower($tipo)) ?></div>
	<article class="item4Col">
    	<a href="<?php ( $this->url($lang, "/catalog/" . str_ireplace(' ', '-', strtolower($tipo)) . "/" . str_ireplace(' ', '-', $product[$this-trans($lang, "nombre", "_name")])) ) ?>">
	    	<div class="imageHolder">
	            <img
	            	alt="<?php $product[$this-trans($lang, "nombre", "_name")] ?>"
	                src="<?php echo 'http://www.alfonsomarinaebanista.com/images/' . $product["ur"] . '/' . $product["ur"] . '_alta1.jpg' ?>">
	        </div>
	        <br class="clear">
	        <br class="clear">
	        <p><?php ucwords($product[$this-trans($lang, "nombre", "_name")]) ?></p>
        </a>
    </article>
      <?php }  ?>
</div>
</div><!-- .product-list -->";