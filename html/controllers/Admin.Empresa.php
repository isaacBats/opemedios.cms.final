<?php 

use utilities\MediaDirectory;
use utilities\Image as Imagen;

class AdminEmpresa extends Controller
{
	private $temaRep;
	private $empresaRepo;
	private $userRepo;
	private $cuentaRepo;

	function __construct()
	{
		$this->temaRep     = new TemaRepository();
		$this->empresaRepo = new EmpresaRepository();
		$this->userRepo    = new UsuarioRepository();
		$this->cuentaRepo  = new CuentaRepository();
	}

	/**
	 * Muestra la lista de los clientes 
	 * @return View 
	 */
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

	/**
	 * Formularion para agregar a un cliente
	 */
	public function addClientView()
	{
		if( isset( $_SESSION['admin'] ) )
		{			
			$this->header_admin('Agrega un cliente - ');
			require $this->adminviews . 'addClientView.php';
			$this->footer_admin();						
		}
		else
		{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	/**
	 * Guarda un cliente
	 */
	public function addClientAction()
	{
		if( isset( $_SESSION['admin'] ) )
		{			
			$imagen = new Imagen();
			$pathLogo = MediaDirectory::LOGO_EMPRESA;
			$json = new stdClass();
			
			$_POST[':color_fondo'] = '#FFF'; 
			$_POST[':color_letra'] = '#FFF';
			$_POST[':fecha_registro'] = date('Y-m-d H:i:s');
			$explode = explode( '.', $_FILES[':logo']['name'] );
			$explode[0] .= '_' .uniqid();
			$_FILES[':logo']['createdName'] = implode( '.', $explode);
			$_POST[':nombre_logo'] = $pathLogo . $_FILES[':logo']['createdName'];

			if( $imagen->saveFile( $_FILES[':logo'], $pathLogo, $_FILES[':logo']['type'] ) )
			{
				if( $save = $this->empresaRepo->create( $_POST )->exito )
				{
					$json->exito = TRUE;
					$json->tipo = 'alert-info';
					$json->mensaje = '<strong>Exito:</strong> Se ha agregado un nuevo cliente!!!';
				}
				else
				{
					$json->exito = FALSE;
					$json->tipo = 'alert-warning';
					$json->mensaje = '<strong>Error:</strong> No se pudo agregar al cliente ' . $_POST['nombre'];	
					$json->error[2] = $save->error;	
				}

			}
			else
			{
				$json->exito = FALSE;
				$json->tipo = 'alert-warning';
				$json->mensaje = '<strong>Error:</strong> No se guardo el logo';		
			}

			$_SESSION['alerts']['clientes'] = $json;
			header( 'Location: /panel/companies');
		}
		else
		{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	/**
	 * Detalle del cliente
	 * @param  Integer $id Id del cliente
	 * @return View
	 */
	public function clientDetail( $id )
	{
		if( isset( $_SESSION['admin'] ) ){

			$client = $this->empresaRepo->get( $id );
			$client = ( $client->exito ) ? $client->rows : $client->error;
			$thems = $this->temaRep->getThemaByEmpresaID( $id );
			if( is_array( $thems ) ){
				$thems = array_map( function( $theme ) use ( $id ){
					$company = $id;
					$theme['contacts'] = $this->userRepo->getContactsByCompanyTheme( $company, $theme['id_tema'] );				
					return $theme;
				}, $thems);				
			}

			$counts = $this->cuentaRepo->getAcountsByCompany( $id );

			$this->header_admin('Detalle - ' . $client['nombre'] . ' - ');
				require $this->adminviews . 'detailClientView.php';
			$this->footer_admin();
					
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function getAcountJsonById($id)
	{
		try {
			$cuenta = $this->cuentaRepo->get($id);
			vdd($cuenta);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		

	}

	/**
	 * Edita una empresa
	 * @param  int $id
	 * @return json
	 */
	public function editCompany( $id )
	{
		if( isset( $_SESSION['admin'] ) )
		{
			$json = new stdClass();
			
			if( $update = $this->empresaRepo->editCompany( $_POST )->exito )
			{
				$json->exito = TRUE;
				$json->class = 'alert-info';
				$json->text = '<strong>Exito:</strong> Se ha editado la cuenta con exito!!!';
			}
			else
			{
				$json->exito = FALSE;
				$json->class = 'alert-warning';
				$json->text = '<strong>Error:</strong> No se pudo editar la cuenta';	
				$json->error = $update->error;	
			}

			header('Content-type: text/json');
	        echo json_encode($json);					
		}
		else
		{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	/**
	 * Cambia el logo de la empresa
	 * @return json
	 */
	public function changeLogoAction()
	{
		if( isset( $_SESSION['admin'] ) )
		{
			$imagen = new Imagen();
			$pathLogo = MediaDirectory::LOGO_EMPRESA;
			$explode = explode( '.', $_FILES['empresa-logo']['name'] );
			$explode[0] .= '_' .uniqid();
			$_FILES['empresa-logo']['createdName'] = implode( '.', $explode);
			$json = new stdClass();

			if( $imagen->saveFile( $_FILES['empresa-logo'], $pathLogo, $_FILES['empresa-logo']['type'] ) )
			{
				$empresa = $_POST['empresaId'];
				$logo = $pathLogo . $_FILES['empresa-logo']['createdName'];

				if( $updateLogo = $this->empresaRepo->updateLogo( $empresa, $logo )->exito )
				{
					$json->exito = TRUE;
					$json->tipo = 'alert-info';
					$json->mensaje = '<strong>Exito:</strong> Logo actualizado!!!';
				}
				else
				{
					$json->exito = FALSE;
					$json->tipo = 'alert-warning';
					$json->mensaje = '<strong>Error:</strong> No se inserto el logo en la base de datos';	
					$json->error[2] = $updateLogo->error;	
				}

			}
			else
			{
				$json->exito = FALSE;
				$json->tipo = 'alert-warning';
				$json->mensaje = '<strong>Error:</strong> No se guardo el logo';		
			}

			$_SESSION['alerts']['empresa'] = $json;
			header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
		}
		else
		{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	/**
	 * Agrega una cuenta a un cliente
	 */
	public function addAccountAction()
	{
		if( isset( $_SESSION['admin'] ) ){
			
			$res = new stdClass();

			$_POST['activo'] = TRUE;
            $_POST['password'] = md5( $_POST['password'] );

			$newAccount = $this->cuentaRepo->create( $_POST );
            
			header('Content-type: text/json');
	        echo json_encode($newAccount);

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	/**
	 * Agrega un tema a monitorear para un cliente
	 */
	public function addThemeAction()
	{
		if( isset( $_SESSION['admin'] ) ){
			
			$res = new stdClass();
			$newTheme = $this->empresaRepo->addTheme( $_POST );
			if( $newTheme->exito ){
				$res->exito = TRUE;
				$res->class = 'alert-info';
				$res->text = 'Se ha agregado el tema con exito!!!';
			}else{
				$res->exito = FALSE;
				$res->class = 'alert-warning';
				$res->text = $newTheme->error;
			}

			header('Content-type: text/json');
	        echo json_encode($res);

		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	/**
	 * Relaciona un tema con una cuenta existente
	 */
	public function relatedAccountThemeAction()
	{
		if( isset( $_SESSION['admin'] ) )
		{
			$company = $_POST['empresaId'];
			$account = $_POST['cuenta'];
			$theme 	 = $_POST['tema'];
			$res = new stdClass();

			if( !$this->validateRelatedAccountTheme( $company, $theme, $account ) )
			{
				$related = $this->empresaRepo->addRelatedCompanyThemeAccount( $company, $theme, $account );
				if( $related->exito ){
					$res->exito = TRUE;
					$res->class = 'alert-info';
					$res->text = '<strong>Exito:</strong> Se ha relacionado la cuenta con exito!!!';
				}
			}
			else
			{
				$res->exito = FALSE;
				$res->class = 'alert-warning';
				$res->text = 'Este tema ya esta relacionado.';
			}

			header('Content-type: text/json');
	        echo json_encode($res);
		}
		else
		{
			header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");	
		}
	}

	private function validateRelatedAccountTheme( $company, $theme, $account )
	{
		$valid = $this->empresaRepo->getVerifiedRelation( $company, $theme, $account );
		
		if( $valid->exito )
		{
			return $valid->exist;
		}

		return FALSE;
	}

	/**
	 * Lista los temas de un cliente 
	 * @param  Integer $id El Id del cliente 
	 * @return JSON     
	 */
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

	public function changeStateAcount()
	{
		if( isset( $_SESSION['admin'] ) ){
			$acount = $_GET['acount'];
			$action = $_GET['action'];
			$res = new stdClass();
			$row = $this->cuentaRepo->changeActive( $acount );
			if( $row->exito ){
				$res->exito = TRUE;
				$res->class = 'alert-info';
				$res->text = 'Se ha ' . $action . ' la cuenta con exito!!!';
			}else{
				$res->exito = FALSE;
				$res->class = 'alert-warning';
				$res->text = $row->error;
			}
			header('Content-type: text/json');
	        echo json_encode($res);		
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
}