
<div id="navigation" class="navigation">
    <ul class="thumbs noscript">
        <?php
        $this->displayTumbs();
        ?>
    </ul>
</div>
<div id="controls" class="controls"></div>
<div id="gallery" class="content">
    <!--  TODO: @Gallery Arreglar error de altura on next slide (1) -->
    <div style="left: 18%;position: absolute;top:50%;margin-top:-15px;width: 30px;"><a href="#" id="navLeft"><img src="/assets/images/Prev1.png" alt=">>"/></a></div>
    <div id="slideshow" class="slideshow"></div>
    <div style="float: right;position: absolute;right: 18%;top:50%;margin-top:-15px;width: 30px;"><a href="#" id="navRight"><img src="/assets/images/Next1.png" alt="<<"/></a></div>
</div>
<div class="gallery-related">
    <!-- <div class="share-product gallery">
        <a href="javascript:void(0);"><i class="fa fa-facebook fa-lg"></i> Share it</a>
        <a href="javascript:void(0);"><i class="fa fa-twitter fa-lg"></i> Tweet it</a>
        <a href="javascript:void(0);"><i class="fa fa-pinterest-p fa-lg"></i> Pin it</a>
    </div> -->
    <div class="share-product gallery">
            <a href="javascript:void(0);" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=http://amarinav2.denumeris.com/<?php echo $this->url($lang); ?>&amp;t=gallery', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');" ><img src="/assets/images/share-it.png"></a>
            <a href="javascript:void(0);" onclick="window.open('https://twitter.com/intent/tweet?text=GalleryAlfonsoMarina&amp;url=<?php echo $this->url($lang); ?>', 'twitter_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');"  ><img src="/assets/images/tweet-it.png"></a>
            <a href="javascript:void(0);" onclick="window.open('http://pinterest.com/pin/create/button/?url=http://amarinav2.denumeris.com/<?php echo $this->url($lang); ?>&amp;media=http://amarinav2.denumeris.com/assets/images/galeria/01_VILLIERS_RS1.jpg&amp;description=Gallery', 'pint_it_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');"  ><img src="/assets/images/pin-it.png"></a>
        </div><!-- .share-product -->
    <div class="gallery-products" id="galleryRelated">
    </div>
    <div class="aux-tools">
            <!-- <a href="javascript:void(0);"><i class="fa fa-envelope-o fa-lg"></i> <?php echo $this->trans($lang, "Enviar por correo", "Send it by e-mail"); ?></a>
            <a href="javascript:void(0);"><i class="fa fa-print fa-lg"></i> <?php echo $this->trans($lang, "Imprimir", "Print"); ?></a> -->
    </div>
</div>
