<?php 

class Profile extends Controller{

	private $temasId;
	private $perfilRepository;
	private $asignaRepo;
	private $noticiaRepo;
	private $company;

	function __construct()
	{
		$this->perfilRepository = new PefilRepository ();
		$this->asignaRepo = new AsignaRepository ();
		$this->noticiasRepo = new NoticiasRepository ();
		$this->temasId = array_map(function($theme) {
			return $theme['id_tema'];
		}, $_SESSION['user']['temas']);
		$this->company = [
			'id' => $_SESSION['user']['id_empresa'],
			'name' => $_SESSION['user']['empresa'], 
			'address' => $_SESSION['user']['direccion'],
			'telephone' => $_SESSION['user']['tel_empresa'], 
			'contact' => $_SESSION['user']['contacto_empresa'], 
			'email' => $_SESSION['user']['email_empresa'], 
			'logo' => $_SESSION['user']['logo_empresa'],
			'giro' => $_SESSION['user']['giro'],
		];
	}

	public function getCompany()
	{
		return $this->company;
	}


	public function showNews()
	{
		if( isset( $_SESSION['user'] ) ){			
			
			$news = array_map(function ($asigna) {				
				
				$new = $this->noticiasRepo->getNewById($asigna['id_noticia']);
				$new['adjunto'] = $this->getMediaHTML($new['tipofuente_id'], $new['id']);
				return $new;

			}, $this->asignaRepo->findByThemeIdAndCompanyId($this->company['id'], $this->temasId));



			$this->renderViewClient('home', 'Noticias - ' . $_SESSION['user']['empresa'] . ' - ', compact('news'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }

	}

	public function detailNewView($fontType, $newId)
	{
		if( isset( $_SESSION['user'] ) ){


			$new = $this->noticiasRepo->getNewById($newId);
			$media = $this->getMediaHTML($new['tipofuente_id'], $newId);
			$this->renderViewClient('detailNew', $new['encabezado'] . ' - ', compact('new', 'media'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }		
	}

}