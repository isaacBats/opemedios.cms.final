<div class="product">
    <div id="product-image">
        <img src="<?php echo $product["imagen"]== "null"?"http://placehold.it/500x600/f4f4f4/807562?text=product":'/images/product/'.$product['imagen'].'' ?>">
    </div><!-- #product-image-->
    <div id="product-info">
        <div class="nav-detalle">
        <?php  //$this->navProduct($lang,$product['id']) ?>
        <a href="<?php echo $this->url($lang,'/catalog') ?>" class="ver-todos">Show all</a>
        <br class="clear">
    </div>
        <h2 class="product-title"><?php echo  $product['nombre'] ?></h2>
        <div class="features">
            <p><strong><?php echo $product['ur'] ?></strong><br>
            <?php  echo '<strong>Medidas cm:</strong> W '.$product['frente'].' D '.$product['fondo'].' H '.$product['altura'].' cm<br>';?>
            <?php echo  '<strong>Medidas in:</strong> W '.$product['frentre_plg'].' D '.$product['fondo_plg'].' H '.$product['altura_plg'].' in<br>';?>
            <strong>Carácter:</strong> <?php echo $product['caracter'] ?><br>
            <strong>Como se muestra:</strong> <?php echo $product['como_se_muestra'] ?><br>
            <strong>Precio:</strong> 
            <?php if( isset( $_SESSION["user"] ) ){ 
                    echo $this->trans( $lang , " $ ".$product["precio"]." MX" , " $ ".$product["_price"]." DLS" );
                }else{ ?>
                    <a href="<?php echo $this->url( $lang , "/login") ?>" class="general-link">Iniciar sesión</a>
            <?php } ?>
            </p>
        </div><!-- .features -->
        <?php if( isset($_SESSION['favoritos']) && in_array($product['id'], $_SESSION['favoritos'])){ ?>
            <a href="javascript:void(0);" id="btn-fav" class="general-btn eliminar" data-id="<?php echo $product['id']; ?>">
            <?php echo $this->trans($lang,"Eliminar de Favoritos","Remove from Favorites"); ?>
        </a>
        <?php } else { ?>
            <a href="javascript:void(0);" id="btn-fav" class="general-btn" data-id="<?php echo $product['id']; ?>">
            <?php echo $this->trans($lang,"Añadir a Favoritos","Add to Favorites"); ?>
        </a>
        <?php } ?>
        <div class="sec-features related">
            <h2>Productos Relacionados</h2>
            <!-- <a href="javascript:void(0);" class="rel"><img src="/images/relacionado1.jpg"></a>
            <a href="javascript:void(0);" class="rel"><img src="/images/relacionado2.jpg"></a>
            <a href="javascript:void(0);" class="rel"><img src="/images/relacionado3.jpg"></a> -->
        </div><!-- .sec-features -->
        <div class="share-product">
            <a href="javascript:void(0);" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=http://amarinav2.denumeris.com/<?php echo $this->url($lang); ?>&amp;t=<?php echo $product["nombre"] ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');" ><img src="/images/share-it.png"></a>
            <a href="javascript:void(0);" onclick="window.open('https://twitter.com/intent/tweet?text=<?php echo $product["nombre"] ?>&amp;url=<?php echo $this->url($lang); ?>', 'twitter_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');"  ><img src="/images/tweet-it.png"></a>
            <a href="javascript:void(0);" onclick="window.open('http://pinterest.com/pin/create/button/?url=http://amarinav2.denumeris.com/<?php echo $this->url($lang); ?>&amp;media=http://amarinav2.denumeris.com/<?php echo '/images/product/'.$product['imagen']; ?>&amp;description=<?php echo $product["nombre"] ?>', 'pint_it_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');"  ><img src="/images/pin-it.png"></a>
        </div><!-- .share-product -->
        <div class="product-note">
            <p><strong>NOTA:</strong> Debido a variaciones en los monitores, los colores como se muestran no pueden representar la calidad y el tono exacto.</p>
            <p>Si desea más información, favor de contactar a nuestra área de Servicio al Clientes.</p>
        </div><!-- .product-note -->
        <div class="post-actions">
            <a href="mailto:?body=http://amarinav2.denumeris.com/<?php $this->url($lang); ?> --- <?php echo $product["nombre"] ?>">
            <i class="fa fa-envelope-o fa-lg"></i> Enviar por correo</a>
            <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i> Imprimir</a>
            <a href="javascript:void(0);"><i class="fa fa-file-o fa-lg"></i> Imprimir hoja de catálogo</a>
        </div><!-- .post-actions -->
    </div><!-- #product-info -->
    <br class="clear">
</div><!-- .product-->;