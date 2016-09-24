<?php 

class AdminEmpresa extends Controller
{
	private $temaRep;

	function __construct()
	{
		$this->temaRep = new TemaRepository();
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
}