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

	public static function tipoUsuario( $tipo )
	{
		switch ( $tipo ) {
			case 1:
				return 'Administrador';
			case 2:
				return 'Encargado de Area';
			case 3:
				return 'Monitorista';
		}
	}

	public static function tipoFuente( $tipoFuenteId ){
		$tipoFuente = [
						['id' => 1, 'fuente' => 'Televisión', 'icon' => 'fa-television', 'pref' => 'tel', ], 
						['id' => 2, 'fuente' => 'Radio', 	  'icon' => 'fa-microphone', 'pref' => 'rad', ], 
						['id' => 3, 'fuente' => 'Periódico',  'icon' => 'fa-newspaper-o','pref' => 'per', ], 
						['id' => 4, 'fuente' => 'Revista',    'icon' => 'fa-columns', 	 'pref' => 'rev', ], 
						['id' => 5, 'fuente' => 'Internet',   'icon' => 'fa-chrome', 	 'pref' => 'int', ],
					  ];
		return $tipoFuente[ $tipoFuenteId ];
	}
}