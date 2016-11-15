<?php 

namespace utilities;

class Util
{
	public static function tipoPortada( $tipo )
	{
		switch ( $tipo ) {
			case 1:
				return 'PRIMERAS_PLANAS';
			case 2:
				return 'PORTADA_FINANCIERA';
			case 3:
				return 'CARTON';
		}
	}

	public static function tipoFuente( $tipoFuenteId ){
		$tipoFuente = [
						['id' => 1, 'fuente' => 'Televisión', 'icon' => 'fa-television'], 
						['id' => 2, 'fuente' => 'Radio', 	  'icon' => 'fa-microphone'], 
						['id' => 3, 'fuente' => 'Periódico',  'icon' => 'fa-newspaper-o'], 
						['id' => 4, 'fuente' => 'Revista',    'icon' => 'fa-columns'], 
						['id' => 5, 'fuente' => 'Internet',   'icon' => 'fa-chrome'],
					  ];
		return $tipoFuente[ $tipoFuenteId ];
	}
}