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

	public static function ubicationDetail( $ubicacionId )
	{
		
		$ubicacion = [ 
						[ 'id' => 1, 'value' => 'SUPERIOR_IZQUIERDO','image' => '/assets/images/image_ubicacion_rev_per/sup_izquierda.jpg', 'label' => 'Superior Izquierdo', ],
						[ 'id' => 2, 'value' => 'SUPERIOR_DERECHO',  'image' => '/assets/images/image_ubicacion_rev_per/sup_derecha.jpg',   'label' => 'Superior Derecho', ],
						[ 'id' => 3, 'value' => 'CENTRO', 			 'image' => '/assets/images/image_ubicacion_rev_per/centro.jpg',        'label' => 'Central', ],
						[ 'id' => 4, 'value' => 'INFERIOR_IZQUIERDO','image' => '/assets/images/image_ubicacion_rev_per/inf_izquierda.jpg', 'label' => 'Inferior Izquierdo', ],
						[ 'id' => 5, 'value' => 'INFERIOR_DERECHO',  'image' => '/assets/images/image_ubicacion_rev_per/inf_derecha.jpg',   'label' => 'Inferior Derecha', ],
					 ];

		$ub = array_filter( $ubicacion, function( $ubi ) use ( $ubicacionId ){

			return $ubi['value'] ===  $ubicacionId;
		});

		return array_values( $ub )[0];
	}

	public static function ubicationNew( $ubicationId ){
		switch ( $ubicationId ) {
			case 1:
				return 'SUPERIOR_IZQUIERDO';
			case 2:
				return 'SUPERIOR_DERECHO';
			case 3:
				return 'CENTRO';
			case 4:
				return 'INFERIOR_IZQUIERDO';
			case 5:
				return 'INFERIOR_DERECHO';
		}
	}

	public function getUnixDate()
	{
		$fecha = new DateTime();
		return $fecha->getTimestamp();
	}

	/**
	 * Convierte un porcentaje a una fracción 
	 * @param  $percent 
	 * @return string $fraction
	 */
	public function percentToFraction( $percent )
	{
		if( is_nan( $percent ) )
			return 0;
		
		if( is_float( $percent ) )
		{
			$divisor = $percent * 10;
			$dividendo = 1000;
		}
		elseif( is_int( $percent ) )
		{
			$divisor = $percent;
			$dividendo = 100;
		}
		else
			return 0;

		
		$factor_divisor = Util::factor( $divisor );
		$factor_dividendo = Util::factor( $dividendo );

		$factor_comun = array_intersect( $factor_divisor, $factor_dividendo );
		$maximo_factor_comun = end( $factor_comun );
		
		$divisor_aux = $divisor / $maximo_factor_comun;
		$dividendo_aux = $dividendo / $maximo_factor_comun;

		$fraction = $divisor_aux . '/' . $dividendo_aux;

		return $fraction;	
	}


	/**
	 * Calcula los factores de un numero 
	 * @param  int $num 
	 * @return array() $res
	 */
	private function factor( $num )
	{
	    $res = array();

	    for ($i = 1; $i <= $num; $i++) 
	    { 
	    	$mod = $num % $i;
	    	if( $mod == 0 )
	    		array_push( $res, $i );
	    }

	    return $res;
	    
	}
}