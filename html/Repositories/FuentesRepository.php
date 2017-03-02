<?php 

include_once("BaseRepository.php");

class FuentesRepository extends BaseRepository{

	public function showAllFonts( $limit, $offset, $id = -1, $search = '' ){
		
		if( $id != -1){
			$query = $this->pdo->prepare("SELECT * FROM fuente where id_tipo_fuente = $id ORDER BY id_fuente DESC;");			
		} elseif ($search != '') {

			$query = $this->pdo->prepare("SELECT * FROM fuente WHERE nombre LIKE '%{$search}%' ORDER BY id_fuente DESC LIMIT $limit OFFSET $offset;");			
		}else{
			$query = $this->pdo->prepare("SELECT * FROM fuente ORDER BY id_fuente DESC LIMIT $limit OFFSET $offset;");			
		}
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todas las Fuentes';
		}
	}

	public function getCountAllFonts($search = '')
	{
		if ($search != '')
			$qry = "SELECT COUNT(*) AS count FROM fuente WHERE nombre LIKE '%{$search}%'";
		else
			$qry = 'SELECT COUNT(*) AS count FROM fuente;';
		
		$stmt = $this->pdo->query($qry);
		return $stmt->fetch()['count'];
	}

	public function getFontsByTipeFont( $tipoFuente = array(), $limit = 10, $offset = 0 ){
		
		if( sizeof( $tipoFuente ) > 0 ){
			$tipos = implode(',', $tipoFuente );
			$query = $this->pdo->prepare("SELECT * FROM fuente where id_tipo_fuente in ( $tipos ) ORDER BY id_fuente DESC;");			
		}else{
			$query = $this->pdo->prepare("SELECT * FROM fuente ORDER BY id_fuente DESC LIMIT $limit OFFSET $offset;");			
		}
		
		$result = new stdClass();

		if($query->execute()){
			$result->exito = true;
			$result->rows = ( $query->rowCount() > 0 ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No se encontraron resultados';
			$result->class="alert-warning";
		}else{
			$result->exito = false;
			$result->error = $query->errorInfo();
			$result->class="alert-danger";
		}

		return $result;
	}

	public function getFontById( $id, $font = '' ) {

		if( $font != '' || $font != null ){
			$query = $this->pdo->prepare( 'SELECT * FROM fuente INNER JOIN fuente_' . $font . ' ON fuente.id_fuente = fuente_'.$font.'.id_fuente WHERE fuente.id_fuente = :id' );			
		}else{
			$query = $this->pdo->prepare( 'SELECT * FROM fuente WHERE id_fuente = :id' );			
		}
		$query->bindparam( ':id', $id, \PDO::PARAM_INT);

		$rs = ( $query->execute() ) ? $query->fetch(PDO::FETCH_ASSOC) : $query->errorInfo()[2];

		return $rs;	
	}

	public function getLogoById( $fontId )
	{
		return $this->pdo->query('SELECT logo FROM fuente WHERE id_fuente = ' . $fontId)->fetch(PDO::FETCH_ASSOC);
	}


}