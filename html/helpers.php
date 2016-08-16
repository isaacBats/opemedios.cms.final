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

