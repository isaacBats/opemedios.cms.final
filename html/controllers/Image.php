<?php 

class Image{

	private $new;
	private $pathFuentes;

	public function __construct( $new ){

		$this->new = $new;
		$this->pathFuentes = 'assets/fonts/font-image/';
	}

	public function createImage(){

		// $file = '/media/daniel/Documentos/DocumentacionApp/opemedios/PruebaImagen.jpg';
		// if( file_exists($file) ){

		// 	$image = imagecreatefromjpeg($file);
		// 	$cBlack  = imagecolorallocate($image, 0, 0, 0);
		// 	$cWhite  = imagecolorallocate($image, 255, 255, 255);

		// 	$string = 'Titulo de la noticia';
		// 	//imagefilledrectangle($image, 100, 80, 300, 110, $cBlack);
		// 	imagestring($image, 5, 105, 87, $string, $cBlack);
		// 	return $image;
		// }
		
		$image = imagecreate( 850, 1050 );
		// $color_fondo = imagecolorallocate($image, 0, 0, 0);
		
		$blanco = imagecolorallocate($image, 255, 255, 255);
		// $gris = imagecolorallocate($image, 128, 128, 128);
		$negro = imagecolorallocate($image, 0, 0, 0);
		
		// imagefilledrectangle($image, 0, 0, 399, 29, $blanco);

		// El texto a dibujar
		$texto = $this->new['seccion'];
		
		$fuente = $this->pathFuentes . 'FreeSans.ttf';

		// Añadir el texto
		// imagettftext($image, 16, 0, 10, 20, $negro, $fuente, $texto);

		//Rectangulos negroa
		imagefilledrectangle($image, 80, 10, 180, 40, $negro);
		imagefilledrectangle($image, 80, 45, 180, 75, $negro);
		imagefilledrectangle($image, 80, 80, 180, 110, $negro);

		imagefilledrectangle($image, 320, 10, 420, 40, $negro);
		imagefilledrectangle($image, 320, 45, 420, 75, $negro);
		imagefilledrectangle($image, 320, 80, 420, 110, $negro);

		imagefilledrectangle($image, 560, 10, 660, 40, $negro);
		imagefilledrectangle($image, 560, 45, 660, 75, $negro);
		imagefilledrectangle($image, 560, 80, 660, 110, $negro);

		//Cabeceras de los rectangulos
		imagestring($image, 5, 86, 17,  'Pag:', $blanco);
		imagestring($image, 5, 86, 52,  'Seccion:', $blanco);
		imagestring($image, 5, 86, 87,  'Cms2:', $blanco);

		imagestring($image, 5, 326, 17,  'Tiraje:', $blanco);
		imagestring($image, 5, 326, 52,  'Impactos:', $blanco);
		imagestring($image, 5, 326, 87,  'Fraccion:', $blanco);

		imagestring($image, 4, 566, 17,  'Porcentaje:', $blanco);
		imagestring($image, 5, 566, 52,  'Costo/cm2:', $blanco);
		imagestring($image, 4, 566, 87,  'Costo nota:', $blanco);

		//Informacion de la imagen
		imagestring($image, 5, 240, 17, $this->new['pagina'], $negro);
		imagestring($image, 4, 186, 52, $this->new['seccion'], $negro);
		imagestring($image, 5, 240, 87, $this->new['cm2'], $negro);

		imagestring($image, 5, 436, 17, $this->new['tiraje'], $negro);
		imagestring($image, 5, 436, 52, $this->new['impactos'], $negro);
		imagestring($image, 5, 436, 87, $this->new['fraccion'], $negro);

		imagestring($image, 4, 680, 17, $this->new['porcentaje'], $negro);
		imagestring($image, 5, 680, 52, $this->new['cost/Cm2'], $negro);
		imagestring($image, 4, 680, 87, $this->new['costoNota'], $negro);

		return $image;

	}
		/*header("Content-Type: image/png");
		imagejpeg($bg);

		imagedestroy($bg);*/


}