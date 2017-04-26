<?php 

// echo 'Este helper fue echo por Isaac Daniel Batista
//       <br> Twitter: @codeisaac
//       <br> Para <strong>Opemedios</strong> © 2016';

/**
 * Return a format Date "02 de Julio, 2016" in Spanish language
 * @param  String $fecha 
 * @return String 		format Date in spanish language
 */
function getFechaLarga( $fecha ){
    $arreglo_meses = array(
        1=>"Enero",
        2=>"Febrero",
        3=>"Marzo",
        4=>"Abril",
        5=>"Mayo",
        6=>"Junio",
        7=>"Julio",
        8=>"Agosto",
        9=>"Septiembre",
        10=>"Octubre",
        11=>"Noviembre",
        12=>"Diciembre");

    $dia = substr($fecha,8,2);
    $mes = date("n",mktime(00,00,00,substr($fecha,5,2),01,2000));
    $año = substr($fecha,0,4);

    return $dia." de ".$arreglo_meses[$mes].", ".$año;
}


/**
 * Debug
 *
 * @param  * $mixed Mixed data to print
 */
function vdd($mixed) {
    echo "<pre>";
    echo 'With var_dump <br>';
    var_dump($mixed);
    echo '<br>With print_r <br>';
    print_r($mixed);
    die();
}

function cortarTexto($texto, $numMaxCaract = 75){
    $texto = strip_tags($texto);
    if (strlen($texto) <  $numMaxCaract){
        $textoCortado = $texto;
    }else{
        $textoCortado = substr($texto, 0, $numMaxCaract);
        $ultimoEspacio = strripos($textoCortado, " ");
 
        if ($ultimoEspacio !== false){
            $textoCortadoTmp = substr($textoCortado, 0, $ultimoEspacio);
            if (substr($textoCortado, $ultimoEspacio)){
                $textoCortadoTmp .= '...';
            }
            $textoCortado = $textoCortadoTmp;
        }elseif (substr($texto, $numMaxCaract)){
            $textoCortado .= '...';
        }
    }
 
    return $textoCortado;
}

function without_accents ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}


/**
 * Header response type json  
 */
function json_response($mixed)
{
    header('Content-type: text/json');
    echo json_encode($mixed);
}