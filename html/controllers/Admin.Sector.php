<?php 

include_once(__DIR__.'/../Repositories/SectorRepository.php');

class AdminSector extends Controller{

	private $sectorRepository;
	private $fuente;

	public function __construct(){

		$this->sectorRepository 	= new SectorRepository();
		$this->fuente 				= 'Sector';
	}

	public function add(){
		
		$this->header_admin('Agregar Sector - ' );
		require $this->adminviews . 'addSector.php';
		$this->footer_admin();
		
	}

	public function save(){

		if( !empty($_POST) ){

			if(isset($_POST['activo'])){
				$_POST['activo'] = 1;
			}else{
				$_POST['activo'] = 0;
			}
			
			if($this->sectorRepository->addSector($_POST)){
				header('Location: /panel/sector/show-list');
				// echo 'Se ha agregado un Sector correctamente';
			}else{
				echo 'No se agrego a la tabla sector';
			}
			
		}else{
			header('Location: /panel/sector/add');
		}
	}

	public function showSectors(){

		$this->header_admin('Administrar Sectores - ' );
		$sectores = $this->sectorRepository->allSectors();
		$html = '';
		foreach ($sectores as $sector) {
			$html .= '
					<tr>
                        <td>'.$sector['nombre'].'</td>
                        <td>'.$sector['descripcion'].'</td>
                        <td>
          					<a class="btn btn-default btn-sm" href="javascript:void(0);">Ver</a>
          					<a class="btn btn-danger btn-sm" href="javascript:void(0);">Eliminar</a>
          				</td>
                    </tr>
			';
		}

		require $this->adminviews . 'showSectores.php';
		$this->footer_admin();
	}
}