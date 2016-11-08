<?php 

class Profile extends Controller{

	private $temas;
	private $perfilRepository;

	function __construct()
	{
		$this->perfilRepository = new PefilRepository ();
		$this->temas = $_SESSION['user']['temas'];		
	}



	public function showNews()
	{
		if( isset( $_SESSION['user'] ) ){			
			
			// $temasIds = implode(',', array_column( $this->temas, 'id_tema'));
			$totales = $this->perfilRepository->getCountAllNewsOfClient( $_SESSION['user']['id_empresa'], $this->temas );
			
			$this->header('Noticias - ' . $_SESSION['user']['empresa'] . ' - ');
			require $this->views.'noticias.php';
			$this->footer();
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/sign-in");
        }

	}

	public function getTemas(){

		return $this->temas; 
	}

}