<div id="content-press">
<?php 

foreach ($galleries as $press) {
	echo '
	<article class="item4Col">
	    <a href="/press/'.strtolower( $press["contexto"] ).'/'.$press["slug"].'">
            <img style="width: 0%" 
            alt="'.$press["nombre"].'" 
            src="/images/press/cover/'.$press["imagen"].'">
            <br class="clear">
			<br class="clear">
            '.$press["nombre"].'
        </a>
    </article>
	';
}

?>
</div><!-- #contenido -->
<br class="clear">
