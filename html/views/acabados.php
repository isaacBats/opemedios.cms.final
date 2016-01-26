<div id="content-press">
<?php 

foreach ($acabados as $acabado) {
	echo '
	<article class="item4Col">
	    <a href="'.$this->url($lang, "/catalog/finishes/".$acabado['codigo']).'">
            <img style="width: 0%" 
            alt="'.$acabado["nombre"].'" 
            src="/assets/images/finishes/'.$acabado["imagen"].'">
            <br class="clear">
			<br class="clear">
            '.$acabado["codigo"]. ' ' .$acabado["nombre"].'
        </a>
    </article>
	';
}

?>
</div><!-- #contenido -->
<br class="clear">
