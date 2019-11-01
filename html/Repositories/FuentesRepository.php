<?php 

use utilities\FontType;
use utilities\Util;

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

	public function updateFont(array $data, $fontType = null) 
	{
		$Ftype = (!is_null($fontType)) ? Util::tipoFuente($fontType - 1) : null;
		$rs = new stdClass();

		$sql = "UPDATE fuente f ";
		
		if (is_array($Ftype)) {
			$sql .= " INNER JOIN fuente_{$Ftype['pref']} ff ON f.id_fuente = ff.id_fuente ";
		}

		$sql .= " SET f.nombre = :nombre, f.empresa = :empresa, f.comentario = :comentario, f.logo = :logo, f.activo = :activo,";

		if (!is_null($fontType)) {
			if ($fontType == FontType::FONT_TELEVISION['key'])
				$sql .= " ff.conductor = :conductor, ff.canal = :canal, ff.desde = :desde, ff.hasta = :hasta, ff.id_senal = :id_senal, ";

			if ($fontType == FontType::FONT_RADIO['key'])
				$sql .= " ff.conductor = :conductor, ff.estacion = :estacion, ff.horario = :horario, ";

			if ($fontType == FontType::FONT_REVISTA['key'] || $fontType == FontType::FONT_PERIODICO['key'])
				$sql .= " ff.tiraje = :tiraje, ";

			if ($fontType == FontType::FONT_INTERNET['key'])
				$sql .= " ff.url = :url, ";
		}

		$sql .= " f.id_cobertura = :id_cobertura WHERE f.id_fuente = :id_fuente";

		$stmt = $this->pdo->prepare($sql);
		if($stmt->execute($data)) {
			$rs->exito = true;
			$rs->row   = $this->pdo->query("SELECT * FROM fuente WHERE id_fuente = {$data['id_fuente']}")->fetch(\PDO::FETCH_ASSOC);
		} else {
			$rs->exito = false;
			$rs->error = $stmt->errorInfo()[2];

		}

		return $rs;

	}

	public function delete ($id) 
	{
		if ($this->pdo->exec("DELETE FROM fuente WHERE id_fuente = $id LIMIT 1")) 
			return true;
		else
			new Exception("Error al borrar la fuente $id ");
		
		return false;
	}

	/**
	 * Obtiene el orden en que deben ser puestas las imagenes enel pdf (merge)
	 * @param  String $type tipo 
	 * @return Array orden en que deben ir las imagenes
	 */
	public function getOrderPriority($type)
	{
		$order = [];
		if (!isset($type)) {
			return $order;
		}
		$q = "SELECT * FROM orderMergePdf WHERE LOWER(section) LIKE LOWER('{$type}') LIMIT 1";
		$stmt = $this->pdo->prepare($q);
		if ( $stmt->execute() ) {
			$ids = $stmt->fetch(PDO::FETCH_ASSOC)['orderByIdFuente'];
			$order = preg_split('/,/', $ids);
		} 
		return $order;
	}
}