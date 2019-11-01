<?php

use utilities\MediaDirectory;
use utilities\Image as Imagen;
use utilities\Util;
// TODO: @Empresas validar que el email de la nueva empresa sea unico
// TODO: @Cuenta Validar que en la tabla de cuentas el mail y el username sean unicos.
class AdminEmpresa extends Controller
{
	/**
	 * TemaRepository
	 * @var pdo
	 */
	private $temaRep;

	/**
	 * EmpresaRepository
	 * @var pdo
	 */
	private $empresaRepo;

	/**
	 * UserRepository
	 * @var pdo
	 */
	private $userRepo;

	/**
	 * CuentaRepository
	 * @var pdo
	 */
	private $cuentaRepo;

	/**
	 * EmpresaTemaCuentaRepository
	 * @var pdo
	 */
	private $empresaTemaCuentaRepo;

	function __construct()
	{
		$this->temaRep     = new TemaRepository();
		$this->empresaRepo = new EmpresaRepository();
		$this->userRepo    = new UsuarioRepository();
		$this->cuentaRepo  = new CuentaRepository();
		$this->empresaTemaCuentaRepo = new EmpresaTemaCuentaRepository();
		if(!Util::byPass("clientes")){
			header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/news");
		}
	}

	/**
	 * Muestra la lista de los clientes
	 * @return View
	 */
	public function showCompanies()
	{
		if( isset( $_SESSION['admin'] ) ){

			$js = "
					<!-- Libreria jquery-bootpag --> 
					<script src='/admin/js/vendors/bootstrap/jquery.bootpag.min.js'></script>
					<!-- Libreria purl --> 
					<script src='/admin/js/vendors/purl/purl.min.js'></script>
					<!-- Paginador con js --> 
					<script src='/assets/js/panel.paginador.js'></script>
					<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
					<!-- Data Tables -->
                    <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
			";

			$css = "

					<!-- panel_paginator CSS -->
				    <link href='/admin/css/panel.main.css' rel='stylesheet'>
				    <!-- data tables bootstrap CSS -->
				    <link href='/admin/css/dataTables.bootstrap.css' rel='stylesheet'>
				    <!-- Data Tables --> 
                    <link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet'>
			";
			/*
			$limit = isset( $_GET['numpp'] ) ? $_GET['numpp'] : 10;
			$page = isset( $_GET['page'] ) ? ( $_GET['page'] * $limit ) - $limit : 0;
			*/
			$getClients = $this->empresaRepo->showAllCompanies( $limit, $page);

			if( $getClients->exito ){
				$clients = $getClients->rows;
				$count = $getClients->count;
			}

			$ini = $page + 1;
			$end = ( $page + $limit >= $count ) ? $count : $page + $limit;

			$this->renderViewAdmin('showClientsView', 'Clientes - ', compact('ini', 'end', 'count', 'clients', 'page', 'limit'), $css, $js);

		}else{
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function deleteClient($id)
	{
		$deletes = array();
		// Obtengo las cuentas para despues eliminarlas
		$cuentas = $this->empresaTemaCuentaRepo->getCuentasByEmpresa($id);
		// eliminar de empresa_tema_cuenta
		$deletes['empresaTemaCuenta'] = $this->empresaTemaCuentaRepo->deleteFromEmpresa($id);
		// eliminar de tema
		$deletes['tema'] = $this->temaRep->deleteFromEmpresa($id);
		// eliminar de cuenta
		// $deletes['cuenta'] = $this->cuentaRepo->deleteFromEmpresa($id);
		$deletes['cuenta'] = $this->cuentaRepo->deleteById($cuentas);
		// eliminar de empresa
		$deletes['empresa'] = $this->empresaRepo->delete($id);
		//vdd($deletes);
		$response = new stdClass();
		if ($deletes['empresa'] == false) {
			$response->success = false;
			$response->message = "No se pudo eliminar la empresa, intentalo más tarde.";
			$response->error = json_encode($deletes);
		} else {
			$response->success = true;
			$response->message = "Cliente eliminado correctamente.";
		}
			
		header('Content-type: text/json');
	    echo json_encode($response);
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
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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

			$js = '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
			
			$counts = $this->cuentaRepo->getAcountsByCompany( $id );

			$this->header_admin('Detalle - ' . $client['nombre'] . ' - ');
				require $this->adminviews . 'detailClientView.php';
			$this->footer_admin($js);

		}else{
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function getAcountJsonById($id)
	{
		$cuenta = $this->cuentaRepo->get($id);

		if($cuenta)
			json_response($cuenta);
		else
			json_response(false);

	}

	public function updateAcount($id)
	{
		if( isset( $_SESSION['admin'] ) )
		{
			$acount = $this->cuentaRepo->get($id);
			$acount['nombre'] = $_POST['nombre'];
		    $acount['apellidos'] = $_POST['apellidos'];
		    $acount['cargo'] = $_POST['cargo'];
		    $acount['telefono1'] = $_POST['tel_casa'];
		    $acount['telefono2'] = $_POST['celular'];
		    $acount['email'] = $_POST['correo'];
		    $acount['comentario'] = $_POST['comentarios'];
		    $acount['username'] = $_POST['username'];
		    $acount['password'] = ($_POST['password'] != '') ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $acount['password'];

			$json = new stdClass();

			if( $update = $this->cuentaRepo->updateAcount( $acount )->exito )
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

			json_response($json);
			// $_SESSION['alerts']['empresa'] = $json;
			// header( 'Location: /panel/client/' . $acount['id_empresa']);
		}
		else
		{
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
			header( 'Location: ' . $_SERVER[' https_REFERER'] );
		}
		else
		{
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            $_POST['password'] = password_hash( $_POST['password'], PASSWORD_DEFAULT );

			$newAccount = $this->cuentaRepo->create( $_POST );

			header('Content-type: text/json');
	        echo json_encode($newAccount);

		}else{
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
			header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
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
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function rmAccount()
	{
		if( isset( $_SESSION['admin'] ) ){
			$acount = $_GET['acount'];
			$res = new stdClass();
			$row = $this->cuentaRepo->deleteById( $acount );
			if( $row->exito ){
				$res->exito = TRUE;
				$res->class = 'alert-info';
				$res->text = 'Se ha eliminado la cuenta con exito!!!';
			}else{
				$res->exito = FALSE;
				$res->class = 'alert-warning';
				$res->text = $row->error;
			}
			header('Content-type: text/json');
	        echo json_encode($res);
		}else{
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

	public function rmTheme()
	{
		if( isset( $_SESSION['admin'] ) ){
			$theme = $_GET['themeId'];
			$res = new stdClass();
			$row = $this->temaRep->deleteThemeById( $theme );
			if( $row ){
				$res->exito = TRUE;
				$res->text = 'Se ha eliminado el tema con exito!!!';
			}else{
				$res->exito = FALSE;
				$res->text = "No se pudo eliminar el tema";
			}
			header('Content-type: text/json');
	        echo json_encode($res);
		}else{
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}

	public function editTopic()
		{
		if( isset( $_SESSION['admin'] ) ){

			if( $update = $this->temaRep->updateTopic( $_POST )->exito ) {
				$response->success = true;
                $response->message = "Se ha actualizado el tema con exito!!!";
			}else{
				$response->success = false;
                $response->error = json_encode($update);
                $response->message = "No se pudo actualizar el tema, intentalo más tarde.";
			}
			header('Content-type: text/json');
	        echo json_encode($response);
		}else{
            header( "Location:  https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }	
	}

}
