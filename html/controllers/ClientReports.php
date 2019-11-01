<?php

use utilities\TipoReporte;
use utilities\Util;

class ClientReports extends Controller
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
		if(isset($_SESSION['user'])){

			//$empresas    = $this->empresasRepo->all();
			$tiposFuente = $this->tipoFuenteRepo->all();
      		$generos     = $this->generoRepo->allGeneros();
			$tiposFuente = is_array($tiposFuente) ? $tiposFuente : [];
      		$sectores    = $this->sectorRepo->allSectors(1);
      		$tiposAutor  = $this->tipoAutorRepo->allAuthors();
			$temas  	 = $this->temaRepo->getThemaByEmpresaID($_SESSION['user']['id_empresa']);
			$js = "<script src='../admin/js/reportScript.js'></script>
					<script src='/assets/bower_components/metisMenu/dist/metisMenu.min.js'></script>
					<script src='/assets/bower_components/moment/min/moment.min.js'></script>
					<script src='../admin/js/jquery-ui.js' type='text/javascript'></script>
					<script type='text/javascript' src='../admin/js/datetimepicker.js'></script>
					<script src='../admin/js/custom.js' ></script>
					<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
					  <script src='../admin/js/jquery.validate.js'></script>
					  <script src='../assets/js/select2.min.js'></script>";

			$css = "<link href='../assets/css/select2.min.css' rel='stylesheet'>
			<link href='/admin/css/jquery-ui.css' rel='stylesheet'>";
      		$this->renderViewClient(
      				'viewReporteCliente', 'Reporte por cliente - ',
      				compact('temas','tiposFuente', 'generos', 'sectores', 'tiposAutor'),$css,$js
      		);
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/sign-in");
        }
	}

	public function getReportClient()
	{
		echo "Not allowed";
		die(0);
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

    /*public function reportTodayView()
    {
        if(isset($_SESSION['user'])){

            $finicio = (isset($_GET['finicio']) && $_GET['finicio'] != '') ? $_GET['finicio'] : date('Y-m-d');
            $ffin = (isset($_GET['ffin']) && $_GET['ffin'] != '') ? $_GET['ffin'] : date('Y-m-d');

            $news = $this->reportsRepo->reportForDay($finicio, $ffin);
            $this->renderViewAdmin('reportTodayView', 'Reporte por día - ', compact('news', 'finicio', 'ffin'));
        }else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/sign-in");
        }
    }*/
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

	
}
