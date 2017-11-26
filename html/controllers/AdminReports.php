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

            $assignments = $this->getAssignments($idEmpresa, $temasIds, $tendencia);
            $news = $this->getNews($assignments, $fecha_inicio, $fecha_fin, $tipo_fuente, $fuente, $seccion);
            // vdd($news);
            $encabezados = [
                'temas' =>['Tema', 'No. noticias'],
                'noticias' => ['Medio','Fuente','Encabezado','Síntesis','Tendencia','Costo','Alcance','Fecha', 'Link']
            ];

            // $typeFile = 'Excel2007';
            // $objReader = PHPExcel_IOFactory::createReader($typeFile);
            // $objPHPExcel = $objReader
            //     ->load(__OPEMEDIOS__ . 'assets/templates/template_client.xlsx');
            // $objPHPExcel->getActiveSheet()->setCellValue('B6', 'Nombre de un cliente');
            
            // $objPHPExcel->setActiveSheetIndex(0);
            
            // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Disposition: attachment;filename="Reporte_Clientes_'.date(YmdHis).'.xlsx"');
            // $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, $typeFile);            
            // header('Cache-Control: max-age=0');
            // // If you're serving to IE 9, then the following may be needed
            // header('Cache-Control: max-age=1');
            // // If you're serving to IE over SSL, then the following may be needed
            // header ('Expires: '.gmdate('D, d M Y H:i:s T', time())); 
            // header ('Last-Modified: '.gmdate('D, d M Y H:i:s T', time()));
            // header ('Cache-Control: cache, must-revalidate');
            // header ('Pragma: public');
            // $objWriter->save('php://output');
            // exit;













            // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $typeFile);

		    $reportExcel = new ReportExcel(TipoReporte::REPORTE_CLIENTE);
		    // $data = $this->reportsRepo->reportForClient($empresa, $fecha_inicio, $fecha_fin, $tema, $tendencia, $tipo_fuente, $fuente, $seccion);
    		// $results = array_map(function ($data) {
    			
    		// 	$notiRepo = new NoticiasRepository();
    		// 	$tipoFuente = Util::tipoFuente($data['id_tipo_fuente'] -1);
    		// 	$new_by_type = $notiRepo->getNewById($data['id_noticia'], $tipoFuente['pref']);
    		// 	$link = $_SERVER['HTTP_HOST'].'/media/'.$tipoFuente['url'].'/'.$data['id_noticia'];


    		// 	return ['medio' => $data['tipo_fuente'], 'fuente' => $data['fuente'], 'encabezado' => $data['encabezado'], 'sintesis' => $data['sintesis'], 'tendencia' => $data['tendencia'], 'costo' => $new_by_type['costo'], 'alcance' => $data['alcance'], 'fecha' => $data['fecha'], 'link' => $link, ];

    		// }, $data);

    		$reportExcel->make($news)->download('xlsx');
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

    private function getNews(array $assignments, $finicio, $ffin, $tfuente, $fuente, $seccion)
    {
        $newsId = array_column($assignments, 'id_noticia');
        return $this->noticiasRepo->where([
            'id_noticia' => $newsId, 
            'fecha_inicio' => $finicio, 
            'fecha_fin' => $ffin,
            'id_tipo_fuente' => $tfuente,
            'id_fuente' => $fuente,
            'id_seccion' => $seccion
        ]);
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
