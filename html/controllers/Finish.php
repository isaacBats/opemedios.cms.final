<?php 

/**
 * 
 */
 class Finish extends Controller
 {
 	
 	
	//  FINISHES

	private function codigos(){
		$sql = "SELECT codigo FROM acabados";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$codigos = $query->fetchAll(PDO::FETCH_COLUMN);
				return $codigos;
			}
		}
	}

	function filterFinishes( $lang , $type ){
		$this->addBread( array( "label"=> $this->trans( $lang , "Catalogo" , "Catalog") , "url"=>$this->url($lang , "/catalog") ) );
		//$this->addBread( array( "label"=> $this->trans($lang , "Acabados" ,"Finishes") ) );
		
 		

 		if( $type == "painted" ){
 			$this->addBread( array( "label"=> $this->trans($lang , "Acabados Pintados" ,"Painted Finishes") ) );
 			$tipo = "2";
 		}else{
 			$tipo = "1";
 			$this->addBread( array( "label"=> $this->trans($lang , "Acabados Madera" ,"Wood Finishes") ) );
 		}

 		$this->header( $lang, $this->trans($lang , "Acabados - " ,"Finishes - ") );

 		$sql = "SELECT * FROM acabados WHERE tipo = :tipo";
 		$query = $this->pdo->prepare($sql);
 		$query->bindParam(':tipo',$tipo);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$acabados = $query->fetchAll();
				$count = 0;
				require $this->views."acabados.php";
			}
		}
 		
 		$this->footer($lang);
	}

	function navegacion($lang="es",$codigo){
		
		$codigos = $this->codigos();

		/************************************************************************************/
		$key_actual = array_search($codigo, $codigos);	
		$key_final = key( array_slice( $codigos, -1, 1, TRUE ) );
		/************************************************************************************/

		$anterior = ( ($key_actual-1) < 0 ) ? '<a href="'.$codigos[$key_final].'">'.$this->trans($lang,'Anterior','Previous').'</a>' : '<a href="'.$codigos[$key_actual-1].'">'.$this->trans($lang,'Anterior','Previous').'</a>';
		$siguiente = ( ($key_actual+1) > $key_final ) ? '<a href="'.$codigos[0].'">'.$this->trans($lang,'Siguiente','Next').'</a>' : '<a href="'.$codigos[$key_actual+1].'">'.$this->trans($lang,'Siguiente','Next').'</a>';
		
		$html =  $anterior.' | '.$siguiente;
		
		return $html;
	}



	public function detailFinish($lang,$codigo){
 		$sql = "SELECT * FROM acabados WHERE codigo = :codigo";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':codigo', $codigo);
		$rs = $query->execute();
		if( $rs ){
			$acabado = $query->fetch();
		}

		$this->addBread( array( "label"=> $this->trans( $lang , "Catalogo" , "Catalog") , "url"=>$this->url($lang , "/catalog") ) );
		$this->addBread( array( "label"=> $this->trans($lang , "Acabados" ,"Finishes") , "url"=>$this->url($lang , "/catalog/finishes") ) );
		$this->addBread( array( "label"=> $acabado['codigo'].' '.$acabado['nombre'] ) );
 		$this->header( $lang, $this->trans($lang , "Detalle Acabado - " ,"Finish Detail - ") );
		
		require $this->views."detalle-finish.php";
		
		$this->footer($lang);
	}
	

	public function showFinishes($lang){
		$this->addBread( array( "label"=> $this->trans( $lang , "Catalogo" , "Catalog") , "url"=>$this->url($lang , "/catalog") ) );
		$this->addBread( array( "label"=> $this->trans($lang , "Acabados" ,"Finishes") ) );
 		$this->header( $lang, $this->trans($lang , "Acabados - " ,"Finishes - ") );

 		$sql = "SELECT * FROM acabados";
 		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$acabados = $query->fetchAll();
				$count = 0;
				require $this->views."acabados.php";
			}
		}
 		
 		$this->footer($lang);

	}




 } 

?>