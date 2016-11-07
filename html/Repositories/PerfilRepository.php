<?php 

include_once("BaseRepository.php");

class PefilRepository extends BaseRepository{

	public function getAllNewsOfClient( $empresa_id = 0, array $temas = [] )
	{
		if( sizeof ( $temas ) > 0 ){
			$temasIds = implode(',', array_column( $temas, 'id_tema'));
			$sql = "SELECT * FROM asigna WHERE id_empresa = $empresa_id AND id_tema in ($temasIds) ORDER BY id_noticia DESC";
		}else{
			$sql = "SELECT * FROM asigna WHERE id_empresa = $empresa_id ORDER BY id_noticia DESC";
		}

		$news = $this->pdo->query( $sql );

		$result = new stdClass();

		if( $news ){
			$result->exito = TRUE;
			$result->rows = ( sizeof( $news ) > 0 ) ? $news->fetchAll( \PDO::FETCH_ASSOC ) : 'No hay elementos aun';			
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo();
		}

		return $result;
	}

	public function getCountAllNewsOfClient( $empresa_id = 0, array $temas = [] )
	{
		if( sizeof( $temas ) > 0 ){
			$temasIds = implode(',', array_column( $temas, 'id_tema'));			
			$sql = "SELECT COUNT(*) AS count FROM asigna WHERE id_empresa = $empresa_id AND id_tema in ($temasIds)";
		}else{
			$sql = "SELECT COUNT(*) AS count FROM asigna WHERE id_empresa = $empresa_id";
		}

		$news = $this->pdo->query( $sql );

		$result = new stdClass();

		if( $news ){
			$result->exito = TRUE;
			$result->rows = ( sizeof( $news ) > 0 ) ? $news->fetch( \PDO::FETCH_ASSOC )['count'] : 0;	
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo();
		}

		return $result;
	}

	public function getCountNewsOfClientMount( array $news = [] )
	{
		if( sizeof( $temas ) > 0 ){
			$news = implode(',', $news );			
			$sql = "SELECT COUNT(*) AS count FROM asigna WHERE id_noticia in  ($news)";
		}else{
			$sql = "SELECT COUNT(*) AS count FROM asigna WHERE id_empresa = $empresa_id";
		}

		$news = $this->pdo->query( "SELECT COUNT(*) AS count FROM asigna WHERE id_noticia in  ($news)" );

		$result = new stdClass();

		if( $news ){
			$result->exito = TRUE;
			$result->rows = ( sizeof( $news ) > 0 ) ? $news->fetch( \PDO::FETCH_ASSOC )['count'] : 0;	
		}else{
			$result->exito = FALSE;
			$result->error = $this->pdo->errorInfo();
		}

		return $result;
	}
		

}