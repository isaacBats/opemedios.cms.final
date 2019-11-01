<?php

namespace utilities;

class Util
{

	private static $pathsLocked = [
		'1' => ["except" => [] ], //Admin
		'2' => ["except" => ["clientes"] ], //Encargado
		'3' => ["except" => ["usuarios", "clientes"] ], //Monitorista
	];	

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

	public static function tipoColumna( $tipo )
	{
		switch ( $tipo )
		{
			case 1:
				return 'COLUMNA_POLITICA';
			case 2:
				return 'COLUMNA_FINANCIERA';
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
						['id' => 1, 'url' => 'television', 'fuente' => 'Televisión', 'icon' => 'fa-television', 'pref' => 'tel', ],
						['id' => 2, 'url' => 'radio',      'fuente' => 'Radio', 	  'icon' => 'fa-microphone', 'pref' => 'rad', ],
						['id' => 3, 'url' => 'periodico',  'fuente' => 'Periódico',  'icon' => 'fa-newspaper-o','pref' => 'per', ],
						['id' => 4, 'url' => 'revista',    'fuente' => 'Revista',    'icon' => 'fa-columns', 	 'pref' => 'rev', ],
						['id' => 5, 'url' => 'internet',   'fuente' => 'Internet',   'icon' => 'fa-chrome', 	 'pref' => 'int', ],
					  ];
		// TODO: @Util Verificar si en todos los lugares donde se invoca regresa el valor correcto ya que regresava indices equivocados -- 31012017
		return $tipoFuente[ $tipoFuenteId ];
	}

	public static function pathMediaNews ($tipoFuenteId)
	{
		switch ($tipoFuenteId)
		{
			case 1:
				return MediaDirectory::MEDIA_TELEVISION;
			case 2:
				return MediaDirectory::MEDIA_RADIO;
			case 3:
				return MediaDirectory::MEDIA_PERIODICO;
			case 4:
				return MediaDirectory::MEDIA_REVISTA;
			case 5:
				return MediaDirectory::MEDIA_INTERNET;

		}
	}

	public static function tipoReporte( $tipoFuenteId ){
		$tipoReporte = [
						['id' => 1, 'filename' => 'reporte_por_cliente', 'titulo' => 'Reporte por Ciente', 'descripcion' => 'Este reporte genera la información de las noticias por cliente', 'tema' => 'Reporte Excel', ],
						['id' => 2, 'filename' => 'reporte_por_area', 'titulo' => 'Reporte por Area', 	  'descripcion' => 'Este reporte genera la información por area en Opemedios', 'tema' => 'Reporte Excel', ],
						['id' => 3, 'filename' => 'reporte_por_fuente', 'titulo' => 'Reporte por Fuente',  'descripcion' => 'Este reporte genera la información de una fuente dada','tema' => 'Reporte Excel', ],
						['id' => 4, 'filename' => 'reporte_por_monitorista', 'titulo' => 'Reporte por Monitorista',    'descripcion' => 'Este reporte genera la información  de las notas que ha capturado un monitorista', 	 'tema' => 'Reporte Excel', ],
						['id' => 5, 'filename' => 'reporte_del_dia', 'titulo' => 'Reporte del Día',   'descripcion' => 'Este reporte genera la información del dia actual ha la hora pedida', 	 'tema' => 'Reporte Excel', ],
					  ];

		$tp = array_filter($tipoReporte, function($tr) use ($tipoFuenteId){

			return $tr['id'] ===  $tipoFuenteId;
		});

		return array_values($tp)[0];
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
		$fecha = new \DateTime();
		return $fecha->getTimestamp();
	}

	/**
	 * Convierte un porcentaje a una fracción
	 * @param  $percent
	 * @return string $fraction
	 */
	public function percentToFraction( $percent )
	{
		$percent = Util::getNumeric( $percent );

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

	public static function getTipoTendencia($id){
		if ($id>3) { return false; }
		$tendencias = array("1"=>"Positiva","2"=>"Neutral","3"=>"Negativa");
		return $tendencias[$id];
	}

	/**
	 * Valida si el argumento string es un numero y lo convierte al tipo de numero que es
	 * @param   &$val
	 * @return $val ( Tipo de numero que es ) FALSE si no es numerico
	 */
	private function getNumeric( &$val )
	{
	  if( is_numeric( $val ) )
	    return $val + 0;

	  return 0;
	}

	public static function clearHtmlData($val)
	{
		if (!isset($val) || is_null($val)) {
			return "";
		}
		return strip_tags(trim($val));
	}

	/**
	 * Render a icon file with type of attached file
	 * @param  String Type of file  attached 
	 * @return String       HTML tag
	 */
	public static function renderFileIcon($attachedFile)
	{
		$htmlFiles		= "";
		$img_allowed 	= ['jpg', 'png', 'jpeg', 'gif', 'pjpeg'];
		$doc_allowed 	= ['csv', 'pdf'];
		$media_allowed_old = ['x-ms-wma', 'x-ms-wmv', 'mpeg3', 'mpeg4'];
		$media_allowed 	= ['webm', 'mp4', 'ogv', 'ogg'];
		$audio_allowed 	= ['mp3', 'wav', 'x-pn-wav', 'x-wav'];
		
		//foreach ($attachedFiles as $key => $attached) {
		$aType = (isset($attachedFile['tipo']) && !empty($attachedFile['tipo']) ) ? explode("/", $attachedFile['tipo']): [" "," "];
		$tipo = $aType[1];
		
		switch (true) {
			case (in_array($tipo, $img_allowed)):
				$htmlFiles = "<label class='icon-attached'><i class='fas fa-file-image'></i></label>";
				break;
			case (in_array($tipo, $doc_allowed)):
				$htmlFiles = "<label class='icon-attached'><i class='far fa-file-alt'></i></label>";
				break;
			case (in_array($tipo, $media_allowed_old) || 
					in_array($tipo, $media_allowed) ):
				$htmlFiles = "<label class='icon-attached'><i class='far fa-file-video'></i></label>";
				break;
			case (in_array($tipo, $audio_allowed)):
				$htmlFiles = "<label class='icon-attached'><i class='far fa-file-audio'></i></label>";
				break;
			default:
				$htmlFiles = "<label class='icon-attached'><i class='fal fa-file-exclamation'></i></label>";
		}
		//}
		return $htmlFiles;
	}

	public static function getDayOfWeek()
	{
		$daysOfWeek = [
			'lunes','martes','miercoles','jueves','viernes','sabado','domingo'
		];
		return $daysOfWeek[ (intval(date('N')) - 1) ];
	}

	public static function getCurrentMonth()
	{
		$months = [
			'enero','febrero','marzo','abril','mayo','junio','julio',
			'agosto','septiembre','octubre','noviembre','diciembre'
		];
		return $months[(intval(date('n')) - 1)];
	}

	public static function getNewsletterColorsConfig() 
	{
		return ['#1976D2','#F44336','#4CAF50','#512DA8','#795548','#EF6C00'];
	}

	public static function byPass($section = "") 
	{
		$userPathsLocked = self::$pathsLocked[$_SESSION['admin']['id_tipo_usuario']]['except'];
		return in_array($section, $userPathsLocked) ? false: true;
	}
}
