<?php 

include_once("BaseRepository.php");
use utilities\StatusBlock;

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

	/** OBTENER INFORMACION DEL BLOQUE **/

	public function getBlockById( $id ) {
		
		$blocks = new stdClass();

		/*$query = $this->pdo->prepare('SELECT b.id, b.name, b.empresa_id, b.enviado, e.nombre AS \'empresa\', b.banner FROM bloques b INNER JOIN empresa e ON b.empresa_id = e.id_empresa WHERE b.enviado = 0 AND b.id = ' . $id);*/

		$query = $this->pdo->prepare('SELECT b.id, b.name, b.empresa_id, b.enviado, e.nombre AS \'empresa\', b.banner FROM bloques b INNER JOIN empresa e ON b.empresa_id = e.id_empresa WHERE b.id = ' . $id);
		
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

	/** OBTENER NOTICIAS DEL BLOQUE **/

	public function getNewsOfBlock( $blockId ){
		
		$blocks = new stdClass();

		/*$sql = 'SELECT bn.id AS bnid, b.name, bn.noticia_id AS noticiaId, n.encabezado, n.sintesis, n.id_seccion, n.autor, n.id_tipo_fuente, n.id_tipo_autor, f.nombre AS fuente, f.id_fuente, bn.tema_id AS temaId, t.nombre AS tema, n.id_tendencia_monitorista AS tendencia_id FROM bloques_noticias bn INNER JOIN bloques b ON bn.bloque_id = b.id INNER JOIN noticia n ON bn.noticia_id = n.id_noticia INNER JOIN fuente f ON n.id_fuente = f.id_fuente INNER JOIN tema t ON bn.tema_id = t.id_tema WHERE bn.bloque_id = :blockId AND (bn.enviado IS NULL OR bn.enviado like "0");
		';*/

		$sql = 'SELECT bn.id AS bnid, b.name, bn.noticia_id AS noticiaId, n.encabezado, n.sintesis, n.id_seccion, n.autor, n.id_tipo_fuente, n.id_tipo_autor, f.nombre AS fuente, f.id_fuente, bn.tema_id AS temaId, t.nombre AS tema, n.id_tendencia_monitorista AS tendencia_id FROM bloques_noticias bn INNER JOIN bloques b ON bn.bloque_id = b.id INNER JOIN noticia n ON bn.noticia_id = n.id_noticia INNER JOIN fuente f ON n.id_fuente = f.id_fuente INNER JOIN tema t ON bn.tema_id = t.id_tema WHERE bn.bloque_id = :blockId ; ';

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

	public function getNewsSentOfBlock( $blockId, $bloqueBitacora ){
		
		$blocks = new stdClass();
		//se modifica este query para que descarte las noticias que ya han sido enviadas
		$sql = 'SELECT bn.id AS bnid, b.name, bn.noticia_id AS noticiaId, n.encabezado, n.sintesis, n.id_seccion, n.autor, n.id_tipo_fuente, n.id_tipo_autor, f.nombre AS fuente, f.id_fuente, bn.tema_id AS temaId, t.nombre AS tema, n.id_tendencia_monitorista AS tendencia_id FROM bloques_noticias bn INNER JOIN bloques b ON bn.bloque_id = b.id INNER JOIN noticia n ON bn.noticia_id = n.id_noticia INNER JOIN fuente f ON n.id_fuente = f.id_fuente INNER JOIN tema t ON bn.tema_id = t.id_tema WHERE bn.bloque_id = :blockId AND bn.fecha_envio = :fecha AND bn.noticia_id IN (:claves);
		';
		$ids = json_decode($bloqueBitacora['claves_noticias']);
		$query = $this->pdo->prepare( $sql );
		$query->bindParam(':blockId', $blockId, \PDO::PARAM_INT);
		$query->bindParam(':fecha', $bloqueBitacora['fecha_envio'], \PDO::PARAM_STR);
		$query->bindParam(':claves', implode(",", $ids), \PDO::PARAM_STR);
		
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

	public function insertNewToBlock( $block ) {
		$query = $this->pdo->prepare( 'INSERT INTO bloques_noticias ( bloque_id, noticia_id, tema_id ) VALUES( ' . $block['bloque'] . ', '. $block['noticia'] .', ' . $block['tema'] . ');' );

		$rs = ( $query->execute() ) ? TRUE : FALSE;

		return $rs;
	}

	public function insertBlock( $block, $banner = NULL ) {
		
		$stmt = $this->pdo->prepare( "INSERT INTO bloques ( name, empresa_id, enviado, banner ) VALUES( :blockName, :empresaId, '0', :banner )" );

		$stmt->bindParam(':blockName', $block['blockName'], \PDO::PARAM_STR);
		$stmt->bindParam(':empresaId', $block['empresaId'], \PDO::PARAM_INT);
		$stmt->bindParam(':banner', $banner, \PDO::PARAM_STR);

		$rs = new stdClass();
		if( $stmt->execute() ){
			$rs->exito = true;
		}else{
			$rs->exito = false;
			$rs->error = $stmt->errorInfo();
		}

		return $rs;
	}

	public function editBlock( $block ) {
		$query = $this->pdo->prepare( "UPDATE bloques SET name = '" . $block['blockName'] . "', empresa_id = " . $block['empresaId'] . ", banner = :banner WHERE id = " . $block['blockId'] . " LIMIT 1;" );
		$query->bindParam(':banner', $block['banner'], \PDO::PARAM_INT);

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
	public function checkNewInBlock( $new, $block ) {
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

	/**
	 * Elimina una noticia (de tabla bloques_noticia) que pertenece a un bloque 
	 * @param  Int $block_new_id id del bloque de noticias
	 * @return boolean
	 */
	public function deleteNewBlock( $block_new_id ) {
		$query = $this->pdo->prepare( 'DELETE FROM  bloques_noticias WHERE id = ' . $block_new_id );

		$rs = ( $query->execute() ) ? TRUE : FALSE;

		return $rs;
	}
	/**
	 * Inserta en "asigna" aquellas noticias del bloque que no esten actualmente en la tabla asigna.
	 * @param  [array] $noticias noticias del bloque
	 * @return [boolean]    
	 */
	public function insertAsignaFromBlock($noticias, $idEmpresa) {
		$noticiasRepo = new NoticiasRepository();
		$asignaRepo   = new AsignaRepository();
		foreach ($noticias as $tema => $notis) {
			foreach ($notis as $value) {
				//comprobar si ya está en asigna
				$data = [
					'id_noticia' => $value['id_new'],
					'id_empresa' => $idEmpresa,
					'id_tema'    => $value['temaId']
				];
				$exist = $asignaRepo->isRecordDuplicate( $data );
				if (!$exist) {
					$noticiasRepo->insertAsigna([
						'noticiaid' => $value['id_new'], 
						'empresaid' => $idEmpresa,
						'temaid'    => $value['temaId'],
						'tendenciaid' => $value['id_tendencia']
					]);
				}
			}
		} 
	} 

	/**
	 * Elimina un bloque de noticias
	 * @return boolean 
	 */
	public function deleteBlock($idBloque)
	{
		$query = $this->pdo->prepare( 'DELETE FROM  bloques WHERE id = ' . $idBloque );
		return ( $query->execute() ) ? TRUE : FALSE;

	}

	/** GUARDA HISTORIAL DE BLOQUE EN LA BITACORA **/

	public function saveHistoricBlock($idBloque, $noticias) {
		$keysNoticias = [];
		foreach ($noticias as $tema => $ANoticia) {
			foreach ($ANoticia as $key => $noticia) {
				array_push($keysNoticias, $noticia['id_new']);	
			}
		}
		$jsonData = json_encode($keysNoticias);
		$query = $this->pdo->prepare( "INSERT INTO bloques_bitacora ( bloque_id, claves_noticias, fecha_envio ) VALUES( '". $idBloque . "', '" . $jsonData . "', CURDATE());" );
		$rs = new stdClass();
		if( $query->execute() ){
			$rs->exito = true;
		}else{
			$rs->exito = false;
			$rs->error = $query->errorInfo();
		}
		return $rs;
	}

	/** ACTUALIZA A ENVIADO EL STATUS DE EN BLOQUE DE NOTICIAS **/

	public function restartBlock($idBloque, $noticias) {
		$keysNoticias = [];
		foreach ($noticias as $tema => $ANoticia) {
			foreach ($ANoticia as $key => $noticia) {
				array_push($keysNoticias, $noticia['id_new']);	
			}
		}
		$idsNoticias = implode(",", $keysNoticias);
		$q = "UPDATE bloques_noticias SET enviado = 1, fecha_envio = CURDATE() WHERE noticia_id IN ({$idsNoticias}) AND bloque_id = :idbloque";
		$stmt = $this->pdo->prepare($q);
		$stmt->bindParam(':idbloque', $idBloque, \PDO::PARAM_INT);
		$stmt->execute();
	}

	/** ACTUALIZA A ENVIADO EL STATUS DEL BLOQUE **/

	public function updateBlockSend( $block ) {
		$query = $this->pdo->prepare( "UPDATE bloques SET enviado = 1 WHERE id = " . $block . " ;" );
		$rs = new stdClass();
		if( $query->execute() ){
			$rs->exito = true;
		}else{
			$rs->exito = false;
			$rs->error = $query->errorInfo();
		}
		return $rs;
	}

	/** CREA UN BLOQUE NUEVO DE LA EMPRESA **/

	public function cloneBlock($block, $id, $banner) {
		$stmt = $this->pdo->prepare( "INSERT INTO bloques ( name, empresa_id, enviado, banner ) VALUES( :blockName, :empresaId, '0', :banner )" );
		$stmt->bindParam(':blockName', $block, \PDO::PARAM_STR);
		$stmt->bindParam(':empresaId', $id, \PDO::PARAM_INT);
		$stmt->bindParam(':banner', $banner, \PDO::PARAM_STR);
		$rs = new stdClass();
		if( $stmt->execute() ){
			$rs->exito = true;
		}else{
			$rs->exito = false;
			$rs->error = $stmt->errorInfo();
		}
		return $rs;
	}

/*
	public function getHistoric()
	{
		$q = "SELECT DISTINCT bb.bloque_id, bb.claves_noticias, bb.fecha_envio, b.name, b.empresa_id, e.nombre as nombre_empresa, bb.id_bitacora FROM bloques_bitacora bb INNER JOIN bloques b ON bb.bloque_id = b.id LEFT JOIN empresa e ON e.id_empresa = b.empresa_id GROUP BY bb.fecha_envio ORDER BY bb.fecha_envio DESC";
		$stmt = $this->pdo->prepare($q);
		if ($stmt->execute()) {
			return $stmt->rowCount() > 0 ? $stmt->fetchAll( \PDO::FETCH_ASSOC): [];
		}
		return [];
	}*/

	public function getBitacoraById($id)
	{
		$q = "SELECT * FROM bloques_bitacora WHERE id_bitacora = :id";
		$stmt = $this->pdo->prepare($q);
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		if ($stmt->execute()) {
			return $stmt->rowCount() > 0 ? $stmt->fetchAll( \PDO::FETCH_ASSOC): [];
		}
		return [];
	}

	/** OBTENER BLOQUES ENVIADOS **/

	public function records( ){
		
		$blocks = new stdClass();

		$query = $this->pdo->prepare('SELECT DISTINCT bb.bloque_id, bb.fecha_envio, b.name, b.empresa_id, b.id, e.nombre as nombre_empresa, bb.id_bitacora FROM bloques_bitacora bb INNER JOIN bloques b ON bb.bloque_id = b.id LEFT JOIN empresa e ON e.id_empresa = b.empresa_id ORDER BY bb.fecha_envio DESC, b.id DESC');
		
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

	

	
}