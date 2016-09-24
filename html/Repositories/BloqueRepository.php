<?php 

include_once("BaseRepository.php");

class BloqueRepository extends BaseRepository{

	public function all( ){
		
		$blocks = new stdClass();

		$query = $this->pdo->prepare('SELECT * FROM bloques WHERE enviado = 0;');
		
		if($query->execute()){
			$blocks->exito = true;
			$blocks->rows = ( $query->rowCount() > 0 ) ? $query->fetchAll( \PDO::FETCH_ASSOC) : 'No se encontraron bloques para agregar una noticia';
			$blocks->error = 0;
		}else{
			$blocks->exito = false;
			$blocks->error = $query->errorInfo();
		}

		return $blocks;
	}

	public function insertNewToBlock( $block )
	{
		$query = $this->pdo->prepare( 'INSERT INTO bloques_noticias ( bloque_id, noticia_id, tema_id ) VALUES( ' . $block['bloque'] . ', '. $block['noticia'] .', ' . $block['tema'] . ');' );

		$rs = ( $query->execute() ) ? TRUE : FALSE;

		return $rs;
	}

	
}