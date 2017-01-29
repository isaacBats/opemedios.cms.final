<?php 

class AdminReports extends Controller
{
	private $empresasRepo;
	private $tipoFuenteRepo;

	function __construct()
	{
		$this->empresasRepo = new EmpresaRepository();
		$this->tipoFuenteRepo = new TipoFuenteRepository();
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
}