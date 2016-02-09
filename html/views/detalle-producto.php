<div class="product">
    <div id="product-image">
        <img src="<?php echo $product["imagen"]== "-"?"http://placehold.it/500x600/f4f4f4/807562?text=product":'http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta1.jpg'; ?>">
        
        <!-- <img src="<?php echo $product["imagen"]== "-"?"http://placehold.it/500x600/f4f4f4/807562?text=product":'/assets/images/product/'.$product['imagen'].'' ?>"> -->
    </div><!-- #product-image-->
    <div id="product-info">
        <div class="nav-detalle">
        <?php  //$this->navProduct($lang,$product['id']) ?>
        <a href="<?php echo $this->url($lang,'/catalog') ?>" class="ver-todos"><?php echo $this->trans($lang , "Ver todos" , "Show all") ?></a>
        <br class="clear">
    </div>
        
        <?php 
            if (isset( $match )) {
                $tmp = $product;
                $product = $match;
                require "features.php"; 
                $product = $tmp;
            }
            
            require "features.php"; 

        ?>
        
        <div class="features line">
            <?php if( $lang == "es") {?>
            <p>
                Si desea más información, favor de contactar a nuestra área de 
                <a href="mailto:centro@alfonsomarinaebanista.com"><strong>Servicio al Clientes</strong></a>
            </p>
            <?php }else{ ?>
            <p>
                For more information, please contact 
                <a href="mailto:centro@alfonsomarinaebanista.com"><strong>customer service</strong></a>
            </p>
            <?php } ?>
        </div><!-- .sec-features -->

        <div class="features line">
        <?php if( isset($_SESSION['favoritos']) && in_array($product['id'], $_SESSION['favoritos'])){ ?>
            <a href="javascript:void(0);" id="btn-fav" class="general-btn eliminar" data-id="<?php echo $product['id']; ?>">
                <?php echo $this->trans($lang,"Eliminar de Favoritos","Remove from Favorites"); ?>
            </a>
        <?php } else { ?>
            <a href="javascript:void(0);" id="btn-fav" class="general-btn" data-id="<?php echo $product['id']; ?>">
                <?php echo $this->trans($lang,"Añadir a Favoritos","Add to Favorites"); ?>
            </a>
        <?php } ?>
        </div><!-- Favorites -->
        <?php if( isset($relacionados) ){ ?>
        <div class="features line">
            <p>
                <?php echo $this->trans( $lang , "Productos Relacionados" , "Related Products") ?>
            </p>
            <?php
            foreach ($relacionados as $pro) {
                echo '<a href="'.$this->url($lang, "/product/".$pro['ur']).'" class="rel_product">';
                echo '<img src="'.($pro["imagen"]== "-"?"http://placehold.it/500x600/f4f4f4/807562?text=product":'/assets/images/product/'.$pro['imagen']).'"></a>';
             } 
            ?>
            <br class="clear">
        </div>
        <?php } ?>
        <div class="post-actions">

            <a href="mailto:?body=http://amarinav2.denumeris.com/<?php $this->url($lang); ?> --- <?php echo $product["nombre"] ?>">
            <i class="fa fa-envelope-o fa-lg"></i> <?php echo $this->trans($lang , "Enviar por correo" , "Email it") ?></a>
            <a href="javascript:window.print()"><i class="fa fa-print fa-lg"></i>  <?php echo $this->trans($lang , "Imprimir" , "Print") ?></a>
            <!-- <a href="javascript:void(0);"><i class="fa fa-file-o fa-lg"></i> Imprimir hoja de catálogo</a> -->
        </div><!-- .post-actions -->
        <div class="line share-product">
            <a href="javascript:void(0);" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=http://amarinav2.denumeris.com/<?php echo $this->url($lang); ?>&amp;t=<?php echo $product["nombre"] ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');" ><img src="/assets/images/share-it.png"></a>
            <a href="javascript:void(0);" onclick="window.open('https://twitter.com/intent/tweet?text=<?php echo $product["nombre"] ?>&amp;url=<?php echo $this->url($lang); ?>', 'twitter_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');"  ><img src="/assets/images/tweet-it.png"></a>
            <a href="javascript:void(0);" onclick="window.open('http://pinterest.com/pin/create/button/?url=http://amarinav2.denumeris.com/<?php echo $this->url($lang); ?>&amp;media=http://amarinav2.denumeris.com/<?php echo '/images/product/'.$product['imagen']; ?>&amp;description=<?php echo $product["nombre"] ?>', 'pint_it_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');"  ><img src="/assets/images/pin-it.png"></a>
        </div><!-- .share-product -->

        <div class="features line ">
        <?php if( $lang == "es") {?>
            <p class="small"><strong>NOTA:</strong> Debido a variaciones en los monitores, los colores como se muestran no pueden representar la calidad y el tono exacto.</p>
            <?php }else{ ?>
            <p class="small"><strong>NOTE:</strong> Due to variations in monitors, the colors shown here cannot absolutely represent true quality and hue.</p>
            <?php } ?>
        </div>
    </div><!-- #product-info -->
    <br class="clear">
</div><!-- .product-->