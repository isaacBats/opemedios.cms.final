<?php 

include_once("BaseRepository.php");

class BloqueRepository extends BaseRepository{

	public function all( ){
		
		$blocks = new stdClass();

		$query = $this->pdo->prepare('SELECT b.id, b.name, b.empresa_id, b.enviado, e.nombre AS \'empresa\' FROM bloques b INNER JOIN empresa e ON b.empresa_id = e.id_empresa WHERE b.enviado = 0;');
		
		if($query->execute()){
			$blocks->exito = true;
			$blocks->rows = ( $query->rowCount() > 0 ) ? $query->fetchAll( \PDO::FETCH_ASSOC) : 'No se encontraron bloques';
			$blocks->error = 0;
		}else{
			$blocks->exito = false;
			$blocks->error = $query->errorInfo();
		}

		return $blocks;
	}

	public function getBlockById( $id ){
		
		$blocks = new stdClass();

		$query = $this->pdo->prepare('SELECT b.id, b.name, b.empresa_id, b.enviado, e.nombre AS \'empresa\' FROM bloques b INNER JOIN empresa e ON b.empresa_id = e.id_empresa WHERE b.enviado = 0 AND b.id = ' . $id);
		
		if($query->execute()){
			$blocks->exito = true;
			$blocks->rows = ( $query->rowCount() > 0 ) ? $query->fetch( \PDO::FETCH_ASSOC) : 'No se encontro el bloque';
			$blocks->error = 0;
		}else{
			$blocks->exito = false;
			$blocks->error = $query->errorInfo();
		}

		return $blocks;
	}

	public function getNewsOfBlock( $blockId ){
		
		$blocks = new stdClass();

		$sql = 'SELECT b.name, bn.noticia_id AS noticiaId, n.encabezado, n.sintesis, bn.tema_id AS temaId, t.nombre AS tema FROM bloques_noticias bn INNER JOIN bloques b ON bn.bloque_id = b.id INNER JOIN noticia n ON bn.noticia_id = n.id_noticia INNER JOIN tema t ON bn.tema_id = t.id_tema WHERE bn.bloque_id = :blockId;			
		';

		$query = $this->pdo->prepare( $sql );
		$query->bindParam(':blockId', $blockId, \PDO::PARAM_INT);
		
		if($query->execute()){
			$blocks->exito = true;
			$blocks->rows = ( $query->rowCount() > 0 ) ? $query->fetchAll( \PDO::FETCH_ASSOC) : 'No se encontraron noticias para este bloque';
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

	public function insertBlock( $block )
	{
		$query = $this->pdo->prepare( "INSERT INTO bloques ( name, empresa_id, enviado ) VALUES( '". $block['blockName'] . "', '" . $block['empresaId'] . "', '0');" );
		
		$rs = new stdClass();
		if( $query->execute() ){
			$rs->exito = true;
		}else{
			$rs->exito = false;
			$rs->error = $query->errorInfo();
		}

		return $rs;
	}

	public function editBlock( $block )
	{
		$query = $this->pdo->prepare( "UPDATE bloques SET name = '" . $block['blockName'] . "', empresa_id = " . $block['empresaId'] . " WHERE id = " . $block['blockId'] . " LIMIT 1;" );
		
		$rs = new stdClass();
		if( $query->execute() ){
			$rs->exito = true;
		}else{
			$rs->exito = false;
			$rs->error = $query->errorInfo();
		}

		return $rs;
	}

	/**
	 * Check if a new exist in a block
	 * @param  int $new   Id of the new
	 * @param  int $block Id of block
	 * @return Object $check     $check->exito = true and $check->exist = true If exist in the block
	 */
	public function checkNewInBlock( $new, $block )
	{
		$check = new stdClass();

		$query = $this->pdo->prepare('SELECT * FROM bloques_noticias WHERE bloque_id = :block AND noticia_id = :new;');
		$query->bindParam(':block', $block, \PDO::PARAM_INT);
		$query->bindParam(':new', $new, \PDO::PARAM_INT);

		if($query->execute()){
			$check->exito = true;
			$check->exist = ( $query->rowCount() > 0 ) ? true : false;
			$check->error = 0;
		}else{
			$check->exito = false;
			$check->error = $query->errorInfo();
		}

		return $check;
	} 

	
}