<?php 

use utilities\TipoReporte;

class AdminReports extends Controller
{
	private $empresasRepo;
	private $tipoFuenteRepo;
	private $reportsRepo;

	function __construct()
	{
		$this->empresasRepo = new EmpresaRepository();
		$this->tipoFuenteRepo = new TipoFuenteRepository();
		$this->reportsRepo = new ReportesRepository();
	}

	public function reportClientView()
	{
		if(isset($_SESSION['admin'])){
			
			$empresas = $this->empresasRepo->all();
			$tiposFuente = $this->tipoFuenteRepo->all();

			$tiposFuente = is_array($tiposFuente) ? $tiposFuente : []; 

			// echo '<pre>'; var_dump($empresas); exit;

			$this->header_admin('Reporte por cliente - ');
			require $this->adminviews . 'reportClienteView.php';
			$this->footer_admin();

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function getReportClient()
	{
		if(isset($_SESSION['admin'])){
			// echo '<pre>'; print_r($_POST);

			$empresa = $_POST['empresa'];
		    $fecha_inicio = $_POST['fecha_inicio'];
		    $fecha_fin = $_POST['fecha_fin'];
		    $tema = $_POST['tema'];
		    $tendencia = $_POST['tendencia'];
		    $tipo_fuente = $_POST['tipo_fuente'];
		    $fuente = isset($_POST['fuente']) ? $_POST['fuente'] : 0;
		    $seccion = isset($_POST['seccion']) ? $_POST['seccion'] : 0;

		    $reportExcel = new ReportExcel(TipoReporte::REPORTE_CLIENTE);

		    $data = $this->reportsRepo->reportForClient($empresa, $fecha_inicio, $fecha_fin, $tema, $tendencia, $tipo_fuente, $fuente, $seccion);
		    if($data->exito){
		    	if(sizeof($data->rows) > 0)
		    		$reportExcel->make($data->rows)->download();
		    	else
		    		throw new Exception("No hubo resultados que procesar");
		    		die();	    				    			    	
		    }
		    else
		    	throw new Exception("Error al procesar el reporte por clientes: <br>" . $data->error);

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
}