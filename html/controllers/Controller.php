<?php 

use Knp\Snappy\Pdf;

use Knp\Snappy\Image;

require_once __DIR__ . '/../Utilities/Opemedios.php';
require_once __DIR__ . '/../Utilities/Image.php';
require_once __DIR__ . '/../Utilities/Util.php';

require 'helpers.php';


class Controller
{
	public $pdo = null;
	public $bread = array();
	public $views = "views/";
	public $adminviews = "admin/";

	
	function __construct()
	{
		global $_config;
		$this->pdo = new PDO($_config->db["dsn"], $_config->db["nombre_usuario"], $_config->db["password"], $_config->db["opciones"]);
	}

	public function url( $url = ""){
		if( $url == ""){
			return "/".$_SERVER["REQUEST_URI"];
		}else{
			$ur = explode( "/" , $url );
			$url = implode( "/" , array_map( function($s){return urlencode($s); } , $ur ) );
			return "/".$url;
		}

	}

	function describe($database, $table , $value){
		$sql = "SELECT column_name , column_type
		FROM information_schema.columns
		WHERE  table_name = '{$table}'
		   AND table_schema = '{$database}'";
		
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		$fields = $query->fetchAll(\PDO::FETCH_ASSOC);
		$end = "";
		foreach( $fields as $f){

			if( str_replace("varchar", "", $f["column_type"]) != $f["column_type"]){
				$end .= " {$f['column_name']} LIKE '%{$value}%' OR ";	
			}
			
		}
		return $end;
	}

	protected function flashAlerts( $type )
	{
		if( isset( $_SESSION['alerts'][ $type ] ) ){
			$alert = $_SESSION['alerts'][ $type ];

			if( isset( $alert->error ) ){
				$al = '
						<div class="alert '.$alert->tipo.' alert-dismissable">
	                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                        '.$alert->mensaje.'<br />'.$alert->error[2].'
	                    </div>
					 ';
			}else{
				$al = '
						<div class="alert '.$alert->tipo.' alert-dismissable">
	                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                        '.$alert->mensaje.'
	                    </div>
					 ';
			}
		}else{
			$al = '';
		}

		unset( $_SESSION['alerts'][$type] ); 
		return $al;
	}

	public function bread( $lang ){
		$out = "<a href=\"/\">Inicio</a>";
		$size = sizeof( $this->bread );
		$outc = 1;
		foreach( $this->bread  as $step ){
			if( $out != ""){
				$out .= ' <span class="breadPipe">|</span> ';
			}
			if( $size == $outc){
				$out .= $step["label"];
			}else{
				$out .= '<a href="'.$this->url( $lang , $step["url"]).'">'.$step["label"].'</a>';
			}
			$outc++;
		}

		echo $out;
	}

	public function addBread( $array ){
		array_push( $this->bread  , $array );
	}

										

	public function header( $title = "" ){
		
		$titleTab = $this->titleTab($title);
		require $this->views."header.php";
	}


    /**
     * The name the secction
     * @return string  A title
     */
    private function titleTab($title = ""){

    	$title .= " Operadora de Medios Informativos 2016";

    	return $title;
    }

    public function generarPdf($res, $data, $template) {
        $snappy = new Pdf('/usr/bin/wkhtmltopdf');
        $pd = $res->mustache->loadTemplate($template);
        $text = $pd->render($data);
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $data['filename'] . '.pdf"');
        echo $snappy->getOutputFromHtml($text, array(
//            'orientation' => 'landscape',
            'zoom' => 0.5,
//            'page-height' => 10000,
            'encoding' => 'utf-8'
        ));
    }

    public function generarImage( $data, $template ) {
        $snappy = new Image('/usr/bin/wkhtmltoimage');
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename="' . $filename . '.jpg"');
        echo $snappy->getOutputFromHtml($template, array(
//            'orientation' => 'landscape',
            'zoom' => 0.5,
//            'page-height' => 10000,
            'encoding' => 'utf-8'
        ));
    }




	public function footer( $js = ''){
		require  $this->views."footer.php";	
	}

	public function header_admin( $title = '', $styles = '' ){
		$titleTab = $this->titleTab($title);
		$stylesheet = $styles;
		require  $this->adminviews."header.php";	
	}

	public function footer_admin( $js = '' ){
		$javaScripts = $js;
		require  $this->adminviews."footer.php";	
	}

	public function viewMedia( $fuente, $noticia){

		$adjuntoRepository = new AdjuntoRepository();		
		$noticiaRepository = new NoticiasRepository();

		$archivo = $adjuntoRepository->getAdjunto( $noticia );
		$noticia =  $noticiaRepository->getNewById( $noticia );

		// $buffer = explode( '.', $archivo['nombre'] );

		// $title = current( $buffer );
		$title = $noticia['encabezado'];

		$media = '';

		// vdd($archivo);

		switch ( $fuente ) {
			case ( $fuente == 1 || $fuente == 'television'):
				$media = '<embed width="600" height="350" type="' . $archivo['tipo'] . '" src="/assets/data/noticias/' . $fuente . '/' . $archivo['nombre_archivo'] . '" title="' . $title . '" />';
				break;
			case ( $fuente == 2 || $fuente == 'radio'):
				//$media = '<embed type="' . $archivo['tipo'] . '" src="/assets/data/noticias/' . $fuente . '/' . $archivo['nombre_archivo'] . '" title="' . $title . '" />';
				$media = '
							<audio controls preload>
								<source src="/assets/data/noticias/' . $fuente . '/' . $archivo['nombre_archivo'] . '" type="' . $archivo['tipo'] . '" />
								Tu navegador no soporta la caracteristica de escuchar Audio
							</audio>
				';
				break;
			case ( $fuente == 3 || $fuente == 'periodico'):
				$media = '<embed width="850" height="600" src="/assets/data/noticias/' . $fuente . '/' . $archivo['nombre_archivo'] . '" title="' . $title . '" />';
				break;
			case ( $fuente == 4 || $fuente == 'revista'):
				$media = '<embed width="850" height="600" src="/assets/data/noticias/' . $fuente . '/' . $archivo['nombre_archivo'] . '" title="' . $title . '" />';
				break;
			case ( $fuente == 5 || $fuente == 'internet'):
				$media = '<embed width="850" height="600" src="/assets/data/noticias/' . $fuente . '/' . $archivo['nombre_archivo'] . '" title="' . $title . '" />';
				break;
			
			default:
				echo 'No existe esa fuente';
				break;
		}

		require $this->views . 'view_media.php';
	}
		
		
}

	//  AUTOLOAD CONTROLLERS
foreach( scandir( __DIR__ ) as $class ){
	$buffer = explode("." , $class);
	if( end( $buffer ) == "php"){
		require_once( __DIR__.'/'.$class );
	}
}

	// AUTOLOAD REPOSITORIES
foreach( scandir( __DIR__ . '/../Repositories/' ) as $repository ){
	$buffer = explode("." , $repository);
	if( end( $buffer ) == "php"){
		require_once( __DIR__.'/../Repositories/'.$repository );
	}
}