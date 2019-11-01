<?php 

use utilities\Util;
use utilities\MediaDirectory;
/**
 * 			
 */
class Newsletters extends Controller
{
	private $bloqueRepo;

	function __construct()
	{
		$this->bloqueRepo = new BloqueRepository();
		/* JOZ */
		$this->empresaRepo = new EmpresaRepository();
		/* /JOZ */
	}

	public function index()
	{
		$historic = $this->bloqueRepo->getHistoric();
		if( isset( $_SESSION['admin'] ) ){
			$this->header_admin( 'Historial de newsletters - ');
			require $this->adminviews . 'historic.php';
			$this->footer_admin();
		} else {
			header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
		}
	}

	public function resend()
	{
		$response = new stdClass();
		if (isset( $_SESSION['admin'] )) {
			if (isset($_POST['block']) && isset($_POST['empresa_id'])) {			
				$blockRepo = new BloqueRepository();
				$themeRep = new TemaRepository();
				$empresaRep = new EmpresaRepository();

				$blockId = $_POST['block'];
				//buscar el bloque, filtrado por bloqueID, fecha, empresa_id, enviado != NULL
				$block = $blockRepo->getBlockById( $blockId );
				
				$bloqueBitacora = $blockRepo->getBitacoraById($_POST['bitacora_id']);
				$thems = $themeRep->getThemaByEmpresaID( $block->rows['empresa_id'] );
				$themesId = array_column( $thems, 'id_tema');
				$empresa = $empresaRep->getEmpresaById( $block->rows['empresa_id'] );
				
				$contacts = [];
				foreach ($_POST as $key => $contact) {
					if($key != 'block' && $key != 'empresa_id' && $key != 'bitacora_id')
						array_push($contacts, ['name' => str_replace('_', ' ', $key), 'mail' => $contact]);
				}




				$news = $blockRepo->getNewsSentOfBlock( $blockId, $bloqueBitacora);
				$noticias = null;
				if( is_array($news->rows) ){
					$pre = $this->mapNewsForEmail($news->rows, $contacts[0]['mail']);
					foreach ($pre as $new) {
						if( in_array( $new['temaId'], $themesId ) ){
							$noticias[$new['tema']][] = $new;
						}
					}				
				}else{
					$noticias = $news->rows;
				}

				if (count($contacts) <= 0) {
					$response->success = false;
					$response->message = 'Debes seleccionar contactos';
					$response->code    = 201;
					header('Content-type: text/json');
					echo json_encode($response);
					exit;
				}

				$currentDate = Util::getDayOfWeek() . ' ' . date('d') . ' de ' . Util::getCurrentMonth() . ' del ' . date('Y');
				$aBgColors = Util::getNewsletterColorsConfig();  	

				$bannerImgName = isset($block->rows['banner']) ? $block->rows['banner']: 'banner-default.png';
				$pathBanner = isset($bannerImgName) ? 
							"https://{$_SERVER["HTTP_HOST"]}/" . MediaDirectory::LOGO_NEWSLETTERS . $bannerImgName: 
							"https://{$_SERVER["HTTP_HOST"]}/assets/data/banners-newsletter/{$bannerImgName}";


				/*JOZ - OBTENER LOGO*/
				$client_id = $block->rows['empresa_id'];
				$client = $this->empresaRepo->get($client_id);
				$client = ( $client->exito ) ? $client->rows : $client->error;
				$logo = "https://{$_SERVER["HTTP_HOST"]}/".$client['logo'];
				/*JOZ - /OBTENER LOGO*/

				ob_start();
				require $this->adminviews . 'viewsEmails/mail-block-template.php';
				$body = ob_get_clean();
				/*
				$mail = new Mail();
				$mail->setSubject('Bloque de Noticias Operadora de medios');
				$mail->setBody( $body );
				
				$noenviados = [];

				foreach ($contacts as $key => $contact) {
					$exito = $mail->sendMail( $contact['mail'], $contact['name'] );
					if( !$exito ){
						$noenviado = [$contact['name'] => $contact['mail'] ];
						array_push($noenviados, $noenviado);
					}					
				} */
					
				$response->success = true;
				$response->message = 'Correos reenviados - [DEMO]';
				$response->contacts = json_encode($contacts);
				header('Content-type: text/json');
				echo json_encode($response);
				
			}else{
				$response->success = false;
				$response->message = "Datos incompletos para la operación.";
				header('Content-type: text/json');
	    		echo json_encode($response);
			}
		} else {
			header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
		}
	}

	public function getContacts()
	{
		if( isset( $_SESSION['admin'] ) ){
			$empresaRep = new EmpresaRepository();
			$contacts  	= $empresaRep->getContactsbyEmpresaId($_POST['eid']); 
			$bloqueId 	= $_POST['bid'];
			$empresa_id = $_POST['eid'];
			$bitacora_id = $_POST['idb'];

			if( $contacts->exito && is_array($contacts->rows) ){
				$emails = array_map(function( $contact ){
					return [
						'nombre' => $contact['nombre_cuenta'],
						'email'	 => $contact['correo']
					];
				}, $contacts->rows);

				$emails = array_values(array_unique($emails, SORT_REGULAR));				
			}elseif(!$contacts->exito && is_array($contacts->error)){
				$emails = '<div class="alert alert-warning">' . $contacts->error[2] . '</div>';
			}else{
				$emails = '<div class="alert alert-warning">No hay contactos para este tema y esta empresa.</div>';				
			}
			
			ob_start();
			require $this->adminviews . 'viewsEmails/contacts.php';
			$body = ob_get_clean();

			header('Content-type: text/json');
	    	echo json_encode($body);
		} else {
			header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
		}
	}
}