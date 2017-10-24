<?php 

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

	function __construct()
	{
		$this->empresasRepo = new EmpresaRepository();
		$this->tipoFuenteRepo = new TipoFuenteRepository();
        $this->reportsRepo = new ReportesRepository();
        $this->temaRepo = new TemaRepository();
        $this->noticiasRepo = new NoticiasRepository();
		$this->asignaRepo = new AsignaRepository();
	}

	public function reportClientView()
	{
		if(isset($_SESSION['admin'])){
			
			$empresas = $this->empresasRepo->all();
			$tiposFuente = $this->tipoFuenteRepo->all();

			$tiposFuente = is_array($tiposFuente) ? $tiposFuente : []; 

			// echo '<pre>'; var_dump($empresas); exit;
            $this->renderViewAdmin('reportClienteView', 'Reporte por cliente - ', compact('empresas', 'tiposFuente'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function getReportClient()
	{
		if(isset($_SESSION['admin'])){
			// echo '<pre>'; print_r($_POST); exit;

			$idEmpresa = $_POST['empresa'];
		    $fecha_inicio = $_POST['fecha_inicio'];
		    $fecha_fin = $_POST['fecha_fin'];
		    $temasIds = $_POST['tema'];
		    $tendencia = $_POST['tendencia'];
		    $tipo_fuente = $_POST['tipo_fuente'];
		    $fuente = isset($_POST['fuente']) ? $_POST['fuente'] : 0;
		    $seccion = isset($_POST['seccion']) ? $_POST['seccion'] : 0;

            // $empresa = $this->empresasRepo->get($idEmpresa)->rows;
            $firstTheme = current($temasIds);
            
            if ($firstTheme == 0) {
                $allThemes = $this->temaRepo->getThemaByEmpresaID($idEmpresa);
                $temasIds = array_column($allThemes, 'id_tema');
            }

            $news = $this->map_news($this->getAssignments($idEmpresa, $temasIds, $tendencia), $fecha_inicio, $fecha_fin, $tipo_fuente, $fuente, $seccion);

            vdd([$news, $temasIds]);
            $temasInfo = $this->temaRepo->where(['id_tema' => $temas]);
            vdd([$_POST, $temasInfo, $temasIds]);
		    $encabezados = ['Medio','Fuente','Encabezado','Síntesis','Tendencia','Costo','Alcance','Fecha', 'Link'];

		    $reportExcel = new ReportExcel(TipoReporte::REPORTE_CLIENTE);
		    $data = $this->reportsRepo->reportForClient($empresa, $fecha_inicio, $fecha_fin, $tema, $tendencia, $tipo_fuente, $fuente, $seccion);
    		$results = array_map(function ($data) {
    			
    			$notiRepo = new NoticiasRepository();
    			$tipoFuente = Util::tipoFuente($data['id_tipo_fuente'] -1);
    			$new_by_type = $notiRepo->getNewById($data['id_noticia'], $tipoFuente['pref']);
    			$link = $_SERVER['HTTP_HOST'].'/media/'.$tipoFuente['url'].'/'.$data['id_noticia'];


    			return ['medio' => $data['tipo_fuente'], 'fuente' => $data['fuente'], 'encabezado' => $data['encabezado'], 'sintesis' => $data['sintesis'], 'tendencia' => $data['tendencia'], 'costo' => $new_by_type['costo'], 'alcance' => $data['alcance'], 'fecha' => $data['fecha'], 'link' => $link, ];

    		}, $data);

    		$reportExcel->setHeaders($encabezados)
                ->make($results)
                ->download('xlsx');
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
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

    private function map_news(array $assignments, $finicio, $ffin, $tfuente, $fuente, $seccion)
    {
        $newsId = array_column($assignments, 'id_noticia');
        $news = $this->noticiasRepo->where([
            'id_noticia' => $newsId, 
            'fecha_inicio' => $finicio, 
            'fecha_fin' => $ffin,
            'id_tipo_fuente' => $tfuente,
            'id_fuente' => $fuente,
            'id_seccion' => $seccion
        ]);
        vdd($news);
    } 

    public function reportTodayView()
    {
        if(isset($_SESSION['admin'])){

            $finicio = (isset($_GET['finicio']) && $_GET['finicio'] != '') ? $_GET['finicio'] : date('Y-m-d');
            $ffin = (isset($_GET['ffin']) && $_GET['ffin'] != '') ? $_GET['ffin'] : date('Y-m-d');

            $news = $this->reportsRepo->reportForDay($finicio, $ffin);
            $this->renderViewAdmin('reportTodayView', 'Reporte por día - ', compact('news', 'finicio', 'ffin'));
        }else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
    }
}
