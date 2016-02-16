<div id="content-press">
<?php 

foreach ($productList as $product) {

    $product["imagen"] = $product["imagen"]== "null" ?"http://placehold.it/200x200/f4f4f4/ccc?text=product":"/assets/images/product/".$product["imagen"];
    echo '
    <article class="item4Col">
        <a href="'.$this->url($lang, "/product/".$product['ur']).'">
            <div class="imageHolder">
                <img style="width: 100%" 
                alt="'.$product["nombre"].'" 
                src="http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta2.jpg">
            </div>
            <br class="clear">
            <p class="fav">
            '.strtolower( $product["nombre"] ).'
            </p>
            
            ';
    if( isset( $_SESSION["user"] ) && $_SESSION["favoritos"] ){
        echo '<a href="javascript:void(0);" id="btn-fav" class="general-btn half eliminar" data-id="'.$product['id'].'">
                 '.$this->trans($lang,"Eliminar de Favoritos","Remove from Favorites").'
            </a>';
        
        if( isset($_SESSION['cotizacion']) && in_array($product['id'], $_SESSION['cotizacion'])){ 
            echo '<a href="javascript:void(0);" id="btn-fav" class="general-btn half eliminar" data-id="'.$product['id'].'">';
            echo $this->trans($lang,"Eliminar de Cotización","Remove from Quotation");
        }else{
            echo '<a href="javascript:void(0);" id="btn-cot" class="general-btn half btn-cotiza" data-id="'.$product['id'].'">';
            echo $this->trans($lang,"Agregar a Cotización","Add to <br>Quotation");
        }
        echo '</a>';
    }else{
        echo '<a href="javascript:void(0);" id="btn-fav" class="general-btn " data-id="'.$product['id'].'">
                 '.$this->trans($lang,"Eliminar de Favoritos","Remove from Favorites").'
            </a>';
    }
    
    echo '
        </a>
    </article>
    ';
}

?>

</div><!-- #contenido -->
<br class="clear">
