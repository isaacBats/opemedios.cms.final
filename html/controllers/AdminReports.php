<?php
//ini_set('display_errors', '1');

use utilities\TipoReporte;
use utilities\Util;

class AdminReports extends Controller
{
	private $empresasRepo;
	private $tipoFuenteRepo;
	private $reportsRepo;
	private $temaRepo;
	private $noticiasRepo;
	private $asignaRepo;
	private $generoRepo;
	private $sectorRepo;
	private $tipoAutorRepo;
	private $fuentesRepo;
	private $seccionRepo;

	function __construct()
	{
		$this->empresasRepo   	= new EmpresaRepository();
		$this->tipoFuenteRepo 	= new TipoFuenteRepository();
        $this->reportsRepo    	= new ReportesRepository();
        $this->temaRepo 		= new TemaRepository();
	    $this->noticiasRepo 	= new NoticiasRepository();
		$this->asignaRepo 		= new AsignaRepository();
	    $this->generoRepo 		= new GeneroRepository();
	    $this->sectorRepo 		= new SectorRepository();
        $this->tipoAutorRepo  	= new TipoAutorRepository();
		$this->fuentesRepo 		= new FuentesRepository();
		$this->seccionRepo 		= new SeccionRepository();
	}

	public function reportClientView()
	{
		if(isset($_SESSION['admin'])){

			$empresas    = $this->empresasRepo->all();
			$tiposFuente = $this->tipoFuenteRepo->all();
      		$generos     = $this->generoRepo->allGeneros();
			$tiposFuente = is_array($tiposFuente) ? $tiposFuente : [];
      		$sectores    = $this->sectorRepo->allSectors(1);
      		$tiposAutor  = $this->tipoAutorRepo->allAuthors();
			
			$js = "<script src='/admin/js/reportScript.js'></script>";

      		$this->renderViewAdmin(
      				'reportClienteView', 'Reporte por cliente - ',
					  compact('empresas', 'tiposFuente', 'generos', 'sectores', 'tiposAutor'),
					  null, $js);
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function getReportClient()
	{
		if(isset($_SESSION['admin']))
		{
			echo json_encode(["code" => 200, "data" => "this module is no more available"]);
			/*$idEmpresa 		= $_POST['empresa'];
		    $fecha_inicio 	= $_POST['fecha_inicio'];
		    $fecha_fin 		= $_POST['fecha_fin'];
		    $temasIds 		= $_POST['tema'];
			$sector 		= $_POST['sector'];
			$genero 		= $_POST['genero'];
			$tipoAutor 		= $_POST['tipo_autor'];
		    $tendencia 		= $_POST['tendencia'];
		    $tipo_fuente 	= $_POST['tipo_fuente'];
		    $fuente 		= isset($_POST['fuente']) ? $_POST['fuente'] : 0;
		    $seccion 		= isset($_POST['seccion']) ? $_POST['seccion'] : 0;

	        $firstTheme 	= current($temasIds);
	        $filters 		= compact('idEmpresa','fecha_inicio','fecha_fin',
	    					'firstTheme','sector','genero','tipoAutor',
	    					'tendencia','tipo_fuente','fuente','seccion'
	    					);

	        if ($firstTheme == 0) { //if select all themes
	            $allThemes = $this->temaRepo->getThemaByEmpresaID($idEmpresa);
	            $temasIds = array_column($allThemes, 'id_tema');
	        }
	        $assignments = $this->getAssignments($idEmpresa, $temasIds, $tendencia);
			$news 		 = $this->getNews($assignments,$fecha_inicio,$fecha_fin,
									$tipo_fuente,$fuente,$seccion, $sector,
									$genero, $tipoAutor
								);
			print_r($_POST);
			die(0);
	        //vdd($assignments);
	        $encabezados = [
	            'temas' =>['Tema', 'No. noticias'],
	            'noticias' => ['Medio','Fuente','Encabezado','Síntesis','Tendencia','Costo','Alcance','Fecha', 'Link']
	        ];
	        //------------------------------------- START ------------------------------------------
	        $totalPorTipoFuente = $this->reportsRepo->getCountBySourceType($news, $filters);
	        $news 				= $totalPorTipoFuente['noticias']; //ADD PROP fuente
	        $totalPorTipoFuente = $totalPorTipoFuente['totales'];
	        //TODO crear los filtros de : 
	        //totales por Fuente y Seccion
	        //------------------------------------- END ------------------------------------------
	        //TBL otros atributos.
	        //------------------------------------- START ------------------------------------------
	    	//obtener número total de noticias por atributos [Sector, genero, TipoAutor, Tendencia].
	    	$totalPorAtributos = $this->reportsRepo->getTotalByAttributes($news);    
	        //--------------------------------------- END -----------------------------------------
	        //III. TBL Noticias por Tema.
	        //------------------------------------- START ------------------------------------------
	        $totalPorTema 	= $this->reportsRepo->getTotalByTheme($news);
	        $news 			= $totalPorTema['news'];
	        $themeData 		= $totalPorTema['themeData'];
			$totalPorTema 	= $totalPorTema['totalByTheme'];
	        //--------------------------------------- END -----------------------------------------
	        //IV. TBL Detalle de noticias.
	        //------------------------------------- START ------------------------------------------
	        $detalleNoticias = $this->reportsRepo->getDetalleNoticias($news, $themeData, $totalPorTema);
	        //--------------------------------------- END -----------------------------------------

			//echo "Noticias:";
			//echo "<pre>"; print_r($news);
			//die();
		    $reportExcel = new ReportExcel(TipoReporte::REPORTE_CLIENTE);
		    // $data = $this->reportsRepo->reportForClient($empresa, $fecha_inicio, $fecha_fin, $tema, $tendencia, $tipo_fuente, $fuente, $seccion);
			// $results = array_map(function ($data) {

			// 	$notiRepo = new NoticiasRepository();
			// 	$tipoFuente = Util::tipoFuente($data['id_tipo_fuente'] -1);
			// 	$new_by_type = $notiRepo->getNewById($data['id_noticia'], $tipoFuente['pref']);
			// 	$link = $_SERVER['HTTP_HOST'].'/media/'.$tipoFuente['url'].'/'.$data['id_noticia'];


			// 	return ['medio' => $data['tipo_fuente'], 'fuente' => $data['fuente'], 'encabezado' => $data['encabezado'], 'sintesis' => $data['sintesis'], 'tendencia' => $data['tendencia'], 'costo' => $new_by_type['costo'], 'alcance' => $data['alcance'], 'fecha' => $data['fecha'], 'link' => $link, ];

	    		// }, $data);
			
			$data = $this->getStrFilters($filters); //retrive query params.
			//print_r($totalPorAtributos);
			//die("break");
			$params = [ "news"			=> $news,
						"detalle"		=> $detalleNoticias,
						"totalPorTema"  => $totalPorTema,
						"totalPorAtributos"=> $totalPorAtributos,
						"totalPorTipoFuente" => $totalPorTipoFuente,
						"encabezados" 	=> $encabezados,
						"filters" 		=> $data
					];
			//print_r($params);
			//die();
			$reportExcel->fillClientReport($params)->download('xlsx');*/
	    		//$reportExcel->make($news)->download('xlsx');
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

    public function getAssignments($idEmpresa, $idTema, $tendencia)
    {
        $asigna = [
            'id_noticia' => null,
            'id_empresa' => $idEmpresa,
            'id_tema' => $idTema,
            'id_tendencia' => $tendencia
        ];
        return $this->asignaRepo->find($asigna);
    }

    private function getNews(array $assignments, $finicio, $ffin, $tfuente, $fuente, $seccion, $sector, $genero, $tipoAutor)
    {
        $newsId = array_column($assignments, 'id_noticia');
        return $this->noticiasRepo->where([
            'id_noticia' => $newsId,
            'fecha_inicio' => $finicio,
            'fecha_fin' => $ffin,
            'id_tipo_fuente' => $tfuente,
            'id_fuente' => $fuente,
            'id_seccion' => $seccion,

			'id_sector' => $sector,
			'id_genero' => $genero,
			'tipo_autor' => $tipoAutor
        ], "AND", true);
    }

    public function reportTodayView()
    {
        if(isset($_SESSION['admin'])){

            $finicio = (isset($_GET['finicio']) && $_GET['finicio'] != '') ? $_GET['finicio'] : date('Y-m-d');
            $ffin = (isset($_GET['ffin']) && $_GET['ffin'] != '') ? $_GET['ffin'] : date('Y-m-d');

            $news = $this->reportsRepo->reportForDay($finicio, $ffin);
            $this->renderViewAdmin('reportTodayView', 'Reporte por día - ', compact('news', 'finicio', 'ffin'));
        }else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
    }
	/**
	 * Regresa un array con los valores que se deifinieron como filtros en el formulario
	 */
	public function getStrFilters($filters)
	{
		//traemos el cliente ?
		$empresa 	= $this->empresasRepo->getEmpresaById($filters['idEmpresa'])['nombre'];
		$temas 		= ($filters['firstTheme']==0)
									? 'Todos'
									:$this->temaRepo->get($filters['firstTheme'])['nombre'];
		$tipoFuente = ($filters['tipo_fuente']==0)
									? 'Todos'
									: $this->tipoFuenteRepo->get($filters['tipo_fuente'])['descripcion'];
		$fuente 	= ($filters['fuente']==0)
									? 'Todos'
									: $this->fuentesRepo->getFontById($filters['fuente'])['nombre'];
		$seccion 	= ($filters['seccion']==0)
									? 'Todos'
									: $this->seccionRepo->getSeccionById($filters['seccion'])['nombre'];
		$sector 	= ($filters['sector']==0)
									? "Todos"
									: $this->sectorRepo->findById($filters['sector'])['nombre'];
		$genero  	= ($filters['genero']==0)
									? "Todos"
									: $this->generoRepo->findById($filters['genero'])['descripcion'];
		$tipoAutor 	= ($filters['tipoAutor']==0)
									? "Todos"
									: $this->tipoAutorRepo->get($filters['tipoAutor'])['descripcion'];
		$tendencia 	= ($filters['tendencia']==0)
									? "Todos"
									: Util::getTipoTendencia($filters['tendencia']);
		$fechasQry 	= ["fecha_inicio" => $filters['fecha_inicio'],
						"fecha_fin" => $filters['fecha_fin']
					];							
		return ['empresa' => $empresa,'tema' => $temas , 'tipo_fuente' => $tipoFuente, 'fuente' => $fuente, 'seccion' => $seccion,
				'sector' => $sector, 'genero' => $genero,
				'tipo_autor' => $tipoAutor, 'tendencia' => $tendencia, 
				'fechas_reporte' => $fechasQry, 'link' => '' ];
	}

	/**
	 * Muestra la view para consultar las noticias que han sido enviadas a un 
	 * cliente en un tiempo determinado 
	 */
	public function getNewsByClient()
	{
		if(isset($_SESSION['admin'])){

			$empresas    = $this->empresasRepo->all();
			$dev_path = "";
			 $js = "
			 		<script src='{$dev_path}/admin/js/jquery.tabledit.js' ></script>
			 		<script src='https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.js'></script>
			 		";
      		$this->renderViewAdmin('showNewsSent', 'Asignación - Noticias a Clientes - ',
      				compact('empresas'), null, $js 
      		);
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function searchNewsByClient()
	{
		if (isset($_SESSION['admin'])) {

			//validate data.
			$id 		= isset($_POST['id']) ? $_POST['id']: "";
			$start 		= isset($_POST['start']) ? $_POST['start']: "";
			$end 		= isset($_POST['end']) ? $_POST['end']: "";
			$assignments = $this->getAssignments($id, null, null);
			$ANewsIds 	= array_column($assignments, 'id_noticia');
	        $news 		= $this->noticiasRepo->where([
					            'id_noticia' 	=> $ANewsIds,
					            'fecha_inicio' 	=> $start,
					            'fecha_fin' 	=> $end
					        	]);

			//separar las noticias por tema en un arreglo tipo: 
			//news["temaA": array(noticias), "temaB": array(noticias) ]
			$totalPorTema 	= $this->reportsRepo->getTotalByTheme($news);
	       	$news 			= $totalPorTema['news']; //add tema and id_tema props
	        $themeData 		= $totalPorTema['themeData'];	//themData[237:[id=>237,tema=>DEMO]]
			$totalPorTema 	= $totalPorTema['totalByTheme']; //["DEMO": 6]
			//TODO
			//1- Consultar todos los temas que pertenecen a un cliente.
			$temasByClient = $this->temaRepo->getThemaByEmpresaID($id);
			$params = [
						//'ids' 	      		=> array_column($temasByClient, 'id_tema'),
						'temas' 			=> array_column($temasByClient, 'nombre'),
						//'allClientThemes' 	=> $temasByClient,
						'news'  			=> $news,
						//'totalByTheme' 		=> $totalPorTema,
						//'themeData'  		=> $themeData
					];
			//2- Obtener todas las noticias que tiene cada tema (si no tiene temas aun asi se pintara vacio)
			$newsByAllThemes = $this->reportsRepo->getNewsByAllThemes($params);
			$ATheme = [];
			foreach ($temasByClient as $key => $tema) {
				$ATheme[$tema['id_tema']] = $tema['nombre'];
			}
			$response = new stdClass();
			$response->news = $newsByAllThemes;
			$response->temas = $ATheme;
			//$response->trends = $trends;

			header('Content-type: text/json');
			echo json_encode($response);
		} else {
			header( "Localtion: https://{$_SERVER["HTTP_HOST"]}/panel/login" );
		}
	}
}
