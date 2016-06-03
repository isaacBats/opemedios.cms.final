<?php 

class Image{

	private $name;

	public function __construct( $name ){

		$this->name = $name;
	}

	public function createImage(){

		
		header("Content-Type: image/png");

		$f1 = imagecreatefrompng('./flags/'.$_GET['f1'].'.png');
		$f2 = imagecreatefrompng('./flags/'.$_GET['f2'].'.png');
		$s1 = $_GET['s1'];
		$s2 = $_GET['s2'];
		$t1 = $_GET['t1'];
		$t2 = $_GET['t2'];
		$bg = imagecreatefrompng('./m'.$_GET['bg'].'.png');


		$fuente = "Futura-Condensed-Bold_Regular.ttf"; 
		$fuente1 = "impact.ttf"; 
		$gris = imagecolorallocate($bg,102,102,102); 
		$gris1 = imagecolorallocate($bg,51,51,51); 

		imagecopy($bg,$f1,75,13,0,0,20,15);
		imagecopy($bg,$f2,305,13,0,0,20,15);
		imagettftext($bg,16,0,100,29,$gris,$fuente,$t1);
		$x = imagettfbbox(16,0,$fuente,$t2); 
		$w = $x[0] - $x[2];
		imagettftext($bg,16,0,$w+298,29,$gris,$fuente,$t2);
		imagettftext($bg,24,0,6,33,$gris1,$fuente1,$s1);
		imagettftext($bg,24,0,360,33,$gris1,$fuente1,$s2);

		imagepng($bg);

		imagedestroy($bg);
		imagedestroy($f1);
		imagedestroy($f2);

	}


}