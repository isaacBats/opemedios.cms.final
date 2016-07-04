<?php 

include_once("BaseRepository.php");

class FuentesRepository extends BaseRepository{

	public function showAllFonts( $id = -1 ){
		
		if( $id != -1){
			$query = $this->pdo->prepare("SELECT * FROM fuente where id_tipo_fuente = $id ORDER BY id_fuente DESC;");			
		}else{
			$query = $this->pdo->prepare("SELECT * FROM fuente ORDER BY id_fuente DESC LIMIT 130;");			
		}
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todas las Fuentes';
		}
	}

	public function getFontById( $id, $font = '' ) {

		if( $font != '' || $font != null ){
			$query = $this->pdo->prepare( 'SELECT * FROM fuente_' . $font . ' WHERE id_fuente = :id' );			
		}else{
			$query = $this->pdo->prepare( 'SELECT * FROM fuente WHERE id_fuente = :id' );			
		}
		$query->bindparam( ':id', $id, \PDO::PARAM_INT);

		$rs = ( $query->execute() ) ? $query->fetch() : 'No se ejecuto la consulta para buscar la fuente';

		return $rs;	
	}


}