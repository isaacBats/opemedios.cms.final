<?php 

class AdminEmpresa extends Controller
{
	private $temaRep;
	private $empresaRepo;
	private $userRepo;

	function __construct()
	{
		$this->temaRep = new TemaRepository();
		$this->empresaRepo = new EmpresaRepository();
		$this->userRepo = new UsuarioRepository();
	}

	public function showCompanies()
	{
		if( isset( $_SESSION['admin'] ) ){
			$js = '
					<!-- Libreria jquery-bootpag --> 
					<script src="/admin/js/vendors/bootstrap/jquery.bootpag.min.js"></script>
					<!-- Libreria purl --> 
					<script src="/admin/js/vendors/purl/purl.min.js"></script>
					<!-- Paginador con js --> 
					<script src="/assets/js/panel.paginador.js"></script>
			';

			$css = '

					<!-- panel_paginator CSS -->
				    <link href="/admin/css/panel.main.css" rel="stylesheet">
				    <!-- data tables bootstrap CSS -->
				    <link href="/admin/css/dataTables.bootstrap.css" rel="stylesheet">
			';

			$limit = isset( $_GET['numpp'] ) ? $_GET['numpp'] : 10;
			$page = isset( $_GET['page'] ) ? ( $_GET['page'] * $limit ) - $limit : 0;

			$getClients = $this->empresaRepo->showAllCompanies( $limit, $page);

			if( $getClients->exito ){
				$clients = $getClients->rows;
				$count = $getClients->count;
			}

			$ini = $page + 1;
			$end = ( $page + $limit >= $count ) ? $count : $page + $limit;

			$this->header_admin('Clientes - ', $css);
			require $this->adminviews . 'showClientsView.php';
			$this->footer_admin( $js );

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function clientDetail( $id )
	{
		if( isset( $_SESSION['admin'] ) ){

			$client = $this->empresaRepo->get( $id );
			$client = ( $client->exito ) ? $client->rows : $client->error;
			$thems = $this->temaRep->getThemaByEmpresaID( $id );
			$thems = array_map( function( $theme ) use ( $id ){
				$company = $id;
				$theme['contacts'] = $this->userRepo->getContactsByCompanyTheme( $company, $theme['id_tema'] );
				return $theme;
			}, $thems);
			
			$this->header_admin('Detalle - ' . $client['nombre'] . ' - ');
				require $this->adminviews . 'detailClientView.php';
			$this->footer_admin();
					
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function getIssuesByCompanyId( $id )
	{
		$issues = null;
		if( isset( $_SESSION['admin'] ) ){
			$issues = $this->temaRep->getThemaByEmpresaID( $id );
			header('Content-type: text/json');
	        echo json_encode($issues);		
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
	// TODO: @AdminEmpresa Falta crear el formulario para agregar un cliente.
	// TODO: @AdminEmpresa Falta el metodo para agregar una seccion.
	// TODO: @AdminEmpresa Falta el metodo para agregar una cuenta relacionada a un tema.
}