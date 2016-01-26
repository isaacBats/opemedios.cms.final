<div class="product">
    <div id="product-image">
        <img src="/assets/images/finishes/<?php echo $acabado['imagen']; ?>">
    </div><!-- #product-image-->
    <div id="product-info">
        <div class="detail-nav">
            <?php echo $this->navegacion($lang,$acabado['codigo']); ?>
            <a href="<?php echo $this->url($lang, '/catalog/finishes'); ?>" class="see-all">Ver Todos</a>
            <br class="clear">
        </div><!-- .detail-nav -->
        <h2 class="product-title"><?php echo $acabado['codigo'].' '.$acabado['nombre']; ?></h2>
        <div class="features">
            <p><b>Nota:</b> 
                <?php echo $acabado['descripcion']; ?>
            </p>
        </div><!-- .features -->
    </div><!-- #product-info -->
    <br class="clear">
</div><!-- .product-->
