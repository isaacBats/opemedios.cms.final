<?php

namespace utilities;

class Image
{
	public function imageCreateFromFile( $filename )
	{
		static $image_creators ;

		if (!isset($image_creators)) {
			$image_creators = array(
				1 => "imagecreatefromgif",
				2 => "imagecreatefromjpeg",
				3 => "imagecreatefrompng",
				6 => "imagecreatefromwbmp",
				16 => "imagecreatefromxbm"
				);
		}

		$image_size = getimagesize($filename);
		if (is_array($image_size)) {
			$file_type = $image_size[2];
			if (isset($image_creators[$file_type])) {
				$image_creator = $image_creators[$file_type];
				if (function_exists($image_creator)) {
					return $image_creator($filename);
				}else{
					die("imagecreatefrom: Function $image_creator doesn't exist!");
				}
			}else{
				die("imagecreatefrom: Image type is not supported!");
			}
		}else{
			die("imagecreatefrom: Not an array while calling getimagesize()!");
		}
	}

	public function CreateThumb( $filename = null, $path = '', $name = '', $thumb_width = 0, $thumb_height = 0 )
	{

		$maxwidth = ( $thumb_width > 0 ) ? $thumb_width : 250;
		$maxheight = ( $thumb_height > 0 ) ? $thumb_height : 250;

		if( $filename == null ) // No se encontro esa imagen. Crear una.
		{
			$image = imageCreate($thumb_width,$thumb_height);
			$colorBG = imageColorAllocate($image, 192, 192, 192);
			$colorTXT = imageColorAllocate($image, 0, 0, 255);
			imageString($image, 5, 10, 40, "No Image", $colorTXT);
			imageInterlace($image, 1);
			imagePNG($image);
			imagedestroy($image);
			exit();
		}

		// determinar el tamano de la imagen a abrir 
		list($width, $height) = getimagesize($filename);
		if($width>$height)
		{
			// es mas ancha que alta 
			if($width<$thumb_width) {
				// es mas pequena de lo que queremos 
				$percent = 1;
			}else{
				// calculamos la proporcion 
				$percent = $thumb_width / $width;
			}
		}else{
			// es mas alta que ancha 
			if($height<$thumb_height) {
				// es mas pequena de lo que queremos 
				$percent = 1;
			}else{
				// calculamos la proporcion 
				$percent = $thumb_height / $height;
			}
		}
		
		$newwidth = $width * $percent;
		$newheight = $height * $percent;

		// Crear miniatura y cargar imagen fuente
		$thumb = imagecreate($newwidth, $newheight);
		$source = $this->imageCreateFromFile($filename);

		// copiar la original con nuevas dimensiones
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		// header("Content-type: image/png");
		if($path != '' && $name != ''){
			$imageThumb = imagePNG($thumb, __DIR__ . '/../' . $path.$name.'_thumb.png', 0);			
		}else{
			$imageThumb = imagePNG($thumb);
		}
		return $imageThumb;

	}

	public function saveFile( $file, $pathFile, $type ){

        // $extensiones_permitidas = ['pdf', 'jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'PNG', 'mp4', 'wma', 'wmv', 'mp3', 'avi', 'xlsx', 'csv'];
        $extencionesPermitidas = ['jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'PNG', 'mp4', 'mp3', 'csv'];
        $explode = explode(".", $file["name"]);
        $extension = end($explode);
        if ( ($file["type"] == $type) && in_array($extension, $extencionesPermitidas)){
            if ($file["error"] > 0)
            {
                echo "ERROR: " . $file["error"] . "<br>";
            }
            else
            {
                $path = __DIR__ . '/../' . $pathFile . $file["createdName"];
				$move = move_uploaded_file($file["tmp_name"],$path);

                if(!$move){
                    throw new Exception("Error al mover el archivo", 1);
                }else{
                    return TRUE;
                }
            }
        }

    }

    public function deleteImage(array $files)
    {
    	$errors = new \stdClass();
    	$errors->count = 0;
    	
    	foreach ($files as $file) {
    		if (!unlink(__OPEMEDIOS__ . $file)){
    			$errors->count ++;
    			$errors->file[] = $file;
    		}
    	}

    	if ($errors->count === 0)
    		$errors->exito = true;
    	else
    		$errors->exito = false;

    	return $errors;

    }
	
}
