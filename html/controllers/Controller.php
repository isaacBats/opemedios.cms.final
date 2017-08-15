<?php 

use Knp\Snappy\Image;
use Knp\Snappy\Pdf;
use utilities\Util;

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
						<div class="alert '.$alert->tipo.' alert-dismissable alert-controller">
	                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                        '.$alert->mensaje.'<br />'.$alert->error[2].'
	                    </div>
					 ';
			}else{
				$al = '
						<div class="alert '.$alert->tipo.' alert-dismissable alert-controller">
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

										

	public function header($title = "", $css = ''){
		
		$titleTab = $this->titleTab($title);
		require $this->views."header.php";
	}


    /**
     * The name the secction
     * @return string  A title
     */
    private function titleTab($title = ""){

    	$title .= " Opemedios 2016";

    	return $title;
    }

    /**
	 * Create slug for urls
	 * @param  string $str 
	 * @return string
	 */
	public function url_slug($str) 
	{ 
	  return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), 
	  	array('', '-', ''), without_accents($str))); 
	}
  
    /**
     * Render View method
     * @param  string $template Name of template
     * @param  string $title    Title of the page
     * @param  array  $data     Data of the page
     * @param  string $css      Include css's plus
     * @param  string $js       Include JavaScript plus
     */
    public function renderView($template, $title = '', $data = [], $css = '', $js = '') 
    {
        $this->header($title, $css);
		require $this->views . $template . '.php';
		$this->footer($js);
    }

    /**
     * Render View method for Client
     * @param  string $template Name of template
     * @param  string $title    Title of the page
     * @param  array  $data     Data of the page
     * @param  string $css      Include css's plus
     * @param  string $js       Include JavaScript plus
     */
    public function renderViewClient($template, $title = '', $data = [], $css = '', $js = '') 
    {
        extract($data);
        $titleTab = $this->titleTab($title);
		require $this->views."client/header.client.php";
		require $this->views . 'client/'.$template . '.client.php';
		require  $this->views."client/footer.client.php";
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

	public function getMediaHTML ($fontTypeId, $newId)
	{

		$adjuntoRepo = new AdjuntoRepository();
		$adjunto = current($adjuntoRepo->getAdjunto($newId));
		$media['icon'] = '<i class="fa ' . Util::tipoFuente($fontTypeId - 1)['icon'] . '" ></i>';
		$media['file'] = $this->getMedia($adjunto);

		return $media;		
	}

	public function viewMedia( $fuente, $new){

		$adjuntoRepository = new AdjuntoRepository();		
		$noticiaRepository = new NoticiasRepository();
		$fuenteRepo = new FuentesRepository();
		$encabezadoRepo = new EncabezadoRepository();

		$archivo = $adjuntoRepository->getAdjunto($new)[0];
		$noticia =  $noticiaRepository->getNewById($new);
		$encabezado = $encabezadoRepo->findByAdjuntoId($archivo['id_adjunto']);
		$font = $fuenteRepo->getFontById($noticia['fuente_id']);
		$fraccion = unserialize($encabezado['fraccion']);
		$date = new \DateTime();
		$fecha = ($encabezado) ? $date->setTimestamp( $encabezado['fecha'] ) : $date->createFromFormat('Y-m-d', $noticia['fecha']);
		$header = __OPEMEDIOS__ . "views/header_media/header_{$fuente}.php";
		$media = $this->getMedia($archivo);

		require $this->views . 'view_media.php';
	}
	
	protected function getMedia($file)
	{
		$img_allowed = ['jpg', 'png', 'jpeg', 'gif', 'pjpeg'];
		$doc_allowed = ['csv', 'pdf'];
		$media_allowed_old = ['x-ms-wma', 'x-ms-wmv', 'mpeg3', 'mpeg4'];
		$media_allowed = ['webm', 'mp4', 'ogv', 'ogg'];
		$audio_allowed = ['mp3', 'wav', 'x-pn-wav', 'x-wav'];
		$type = end(explode('/', $file['tipo']));
		
		$html = "El sistema no soporta elementos de tipo <strong>{$type}</strong>";
		if(in_array($type, $img_allowed)) {
			$html = "<img class='img-responsive' src='/{$file['carpeta']}{$file['nombre_archivo']}' alt='Opemedios - {$file['nombre']}' />";
		}

		if(in_array($type, $doc_allowed)) {
			$html = "<div class='embed-responsive embed-responsive-16by9'>
		  		<iframe class='embed-responsive-item' src='/{$file['carpeta']}{$file['nombre_archivo']}'></iframe>
			</div>";
		}

		if(in_array($type, $media_allowed_old)) {
			$html = "<div class='embed-responsive embed-responsive-16by9'>
		  		<object class='embed-responsive-item' data='{$file['nombre_archivo']}' type='{$file['tipo']}'>
					   <param name='src' value='/{$file['carpeta']}{$file['nombre_archivo']}'>
					   <param name='autostart' value='0'>
					   <param name='volume' value='0'>
					   <param name='showcontrols' value='1'>
					   <param name='showdisplay' value='1'>
					   <param name='showstatusbar' value='1'>
					   <param name='playcount' value='1'>
		  		</object>
			</div>";
		}

		if(in_array($type, $media_allowed)) {
			$html = "<div class='embed-responsive embed-responsive-16by9'>
				<video class='embed-responsive-item' controls
				  <source
				    src='/{$file['carpeta']}{$file['nombre_archivo']}'
				    type='{$file['tipo']}' />
				  Your browser doesn't support HTML5 video tag.
				</video>
			</div>";
		}

		if(in_array($type, $audio_allowed)) {
			$html = "<div class='embed-responsive embed-responsive-16by9'>
				<audio controls='controls'>
				  <source src='/{$file['carpeta']}{$file['nombre_archivo']}' type='{$file['tipo']}' />
				  Your browser does not support the <code>audio</code> element.
				</audio>
			</div>";
		}

		return $html;
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