<div id="content-press">
<?php 
$publicidad = "";
$brochures = "";
foreach ($galleries as $press) {
    if( $press['contexto'] == "publicity" ){
        $publicidad .= '<article class="item4Col">
                        <a href="/press/'.strtolower( $press["contexto"] ).'/'.$press["slug"].'">
                            <img style="width: 0%" 
                            alt="'.$press["nombre"].'" 
                            src="/assets/images/press/cover/'.$press["imagen"].'">
                            <br class="clear">
                            <br class="clear">
                            '.$press["nombre"].'
                        </a>
                    </article>';    
    }
    else{
        $brochures .= '<article class="item4Col">
                        <a href="/press/'.strtolower( $press["contexto"] ).'/'.$press["slug"].'">
                            <img style="width: 0%" 
                            alt="'.$press["nombre"].'" 
                            src="/assets/images/press/cover/'.$press["imagen"].'">
                            <br class="clear">
                            <br class="clear">
                            '.$press["nombre"].'
                        </a>
                    </article>';
    }
	
}

if( $publicidad != ""&& $brochures != "" ){
    echo '<p class="tituloSeccion Publicidad">'.$this->trans($lang,'Publicidad', 'Publicity').'</p>'.$publicidad;    

    echo '<div class="clear"></div><p class="tituloSeccion Publicidad">Brochures</p>'.$brochures;
}else{

    if( $publicidad != ""){
        echo $publicidad;    
    }

    if( $brochures != "" ){
        echo $brochures;
    }
}

?>
</div><!-- #contenido -->
<br class="clear">
