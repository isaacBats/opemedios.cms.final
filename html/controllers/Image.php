<?php 

class Image{

	private $name;

	public function __construct( $name ){

		$this->name = $name;
	}

	public function createImage(){

		$file = '/media/daniel/Documentos/DocumentacionApp/opemedios/PruebaImagen.jpg';
		if( file_exists($file) ){

			$image = imagecreatefromjpeg($file);
			$cBlack  = imagecolorallocate($image, 0, 0, 0);
			$cWhite  = imagecolorallocate($image, 255, 255, 255);

			$string = 'Titulo de la noticia';
			imagefilledrectangle($image, 100, 80, 300, 110, $cBlack);

			/*	<table>
					<tr>
						<th>Pag</th>
						<th>Seccion</th>
						<th>Cms</th>	
					</tr>
					<tr>
						<td>1</td>
						<td>Noticias</td>
						<td>23</td>
					</tr>
				</table>
				
			*/
			
			imagestring($image, 2, 105, 87, $string, $cWhite);
			return $image;
		}

	}
		/*header("Content-Type: image/png");
		imagejpeg($bg);

		imagedestroy($bg);*/


}