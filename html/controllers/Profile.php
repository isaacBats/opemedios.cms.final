<?php 

class Profile extends Controller{

	private $temasId;
	private $perfilRepository;
	private $asignaRepo;
	private $companyId;
	private $noticiaRepo;

	function __construct()
	{
		$this->perfilRepository = new PefilRepository ();
		$this->asignaRepo = new AsignaRepository ();
		$this->noticiasRepo = new NoticiasRepository ();
		$this->temasId = array_map(function($theme) {
			return $theme['id_tema'];
		}, $_SESSION['user']['temas']);
		$this->companyId = $_SESSION['user']['id_empresa'];
	}



	public function showNews()
	{
		if( isset( $_SESSION['user'] ) ){			
			
			$news = array_map(function ($asigna) {				
				
				return $this->noticiasRepo->getNewById($asigna['id_noticia']);

			}, $this->asignaRepo->findByThemeIdAndCompanyId($this->companyId, $this->temasId));

			$this->renderViewClient('home', 'Noticias - ' . $_SESSION['user']['empresa'] . ' - ', compact('news'));
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }

	}

}