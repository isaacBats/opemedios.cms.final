<?php 

namespace utilities;

abstract class PHPEnum 
{

    final public function __construct($value) 
    {

        $c = new ReflectionClass($this);
        if (!in_array($value, $c->getConstants()))
        {
            throw IllegalArgumentException();
        }
        $this->value = $value;
    }

    final public function __toString()
    {
        return $this->value;
    }

}

class FontType extends PHPEnum
{
	const FONT_TELEVISION 	= ['key' => 1, 'fuente' => 'Television'];
	const FONT_RADIO 		= ['key' => 2, 'fuente' => 'Radio'];
	const FONT_PERIODICO 	= ['key' => 3, 'fuente' => 'Periodico'];
	const FONT_REVISTA 		= ['key' => 4, 'fuente' => 'Revista'];
	const FONT_INTERNET 	= ['key' => 5, 'fuente' => 'Internet'];

}

class MediaDirectory extends PHPEnum
{
	const MEDIA_TELEVISION   = 'assets/data/noticias/television/';
	const MEDIA_RADIO		 = 'assets/data/noticias/radio/';
	const MEDIA_PERIODICO  	 = 'assets/data/noticias/periodico/';
	const MEDIA_REVISTA 	 = 'assets/data/noticias/revista/';
	const MEDIA_INTERNET 	 = 'assets/data/noticias/internet/';
} 

class AuthorType extends PHPEnum
{
	const AUTHOR_CONDUCTOR   = 1;
	const AUTHOR_INVITADO    = 2;
	const AUTHOR_REPORTERO   = 3;
	const AUTHOR_COLABORADOR = 4;
	const AUTHOR_EDITOR      = 5;
	const AUTHOR_OTRO        = 6;
}

class Tendency extends PHPEnum
{
	const POSITIVA	= 1;
	const NEUTRAL	= 2;
	const NEGATIVA	= 3;
}

class Gender extends PHPEnum
{
	const REPORTAJE			 = 1;
	const ARTÍCULO			 = 2;
	const NOTICIA			 = 3;
	const ENTREVISTA		 = 4;
	const EDITORIAL			 = 5;
	const PUBLIREPORTAJE	 = 6;
	const COLUMNA_POLÍTICA	 = 7;
	const COLUMNA_FINANCIERA = 8;
	const FOTOGRAFÍA		 = 9;
	const OTRO				 = 10;
	const PROMOCIONES		 = 11;
}

class Coverage extends PHPEnum
{
	const LOCAL			= 1;
	const NACIONAL		= 2;
	const INTERNACIONAL	= 3;
}