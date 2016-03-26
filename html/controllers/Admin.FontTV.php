<?php 

require (__DIR__.'/../Repositories/TelevisionRepository.php');
require (__DIR__.'/../Repositories/CoberturaRepository.php');

class AdminFontTV extends Controller{

	public $tvRepository;
	public $coberturaRepository;

	public function __construct(){

		$this->tvRepository = new TelevisionRepository();
		$this->coberturaRepository = new CoberturaRepository();
	}

	public function add(){

		$this->header_admin('Agregar fuente TV - ' );
		require $this->adminviews . "addFontTV.php";
		$this->footer_admin();
	}

	public function save(){

		if( !empty($_POST) ){

			$id_television = $this->tvRepository->idFuenteTV();
			$id_cobertura = $this->coberturaRepository->idCobertura($_POST['cobertura']);

		}

	}
}