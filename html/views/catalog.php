<div id="content-press">
<?php 

foreach ($productList as $product) {

    $product["imagen"] = $product["imagen"]== "null" ?"http://placehold.it/200x200/f4f4f4/ccc?text=product":"/images/product/".$product["imagen"];
    echo '
    <article class="item4Col">
        <a href="'.$this->url($lang, "/product/".$product['ur']).'">
            <img style="width: 100%" 
            alt="'.$product["nombre"].'" 
            src="'.$product["imagen"].'">
            <br class="clear">
            <br class="clear">
            <p>
            '.$product["nombre"].'
            </p>
        </a>
    </article>
    ';
}

?>
</div><!-- #contenido -->
<br class="clear">
