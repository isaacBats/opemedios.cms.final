<?php 

include_once("BaseRepository.php");

class NoticiasRepository extends BaseRepository{

	public function showAllNews(){
		
		$query = $this->pdo->prepare("SELECT * FROM noticia ORDER BY id_noticia DESC LIMIT 30;");
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETsCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta para buscar todas las Noticias';
		}
	}

	public function showNewsToDay(){

		/*$sql = ' 	SELECT n.id_noticia AS id, n.encabezado, f.nombre AS nameFont, a.id_empresa, e.nombre AS send
					FROM noticia n
					INNER JOIN fuente f ON n.id_fuente = f.id_fuente
					INNER JOIN asigna a ON n.id_noticia = a.id_noticia
					INNER JOIN empresa e ON a.id_empresa = e.id_empresa
					ORDER BY n.id_noticia DESC LIMIT 30;					
				';*/

		$sql = ' 	SELECT n.id_noticia AS id, n.encabezado, f.nombre AS nameFont
					FROM noticia n
					INNER JOIN fuente f ON n.id_fuente = f.id_fuente
					/*WHERE fecha = CURDATE()*/
					WHERE n.id_noticia > 598840
					ORDER BY n.id_noticia DESC;					
				';
		$query = $this->pdo->prepare( $sql );

		$rs = ( $query->execute() ) ? $query->fetchAll() : 'No hay noticias aun';

		return $rs;
	}

	public function asignaByIdNoticia( $id ){

		$query = $this->pdo->prepare( "SELECT a.id_noticia, e.nombre AS 'empresa'
									   FROM asigna a 
									   INNER JOIN empresa e ON a.id_empresa = e.id_empresa 
									   WHERE id_noticia = $id;" );

		$rs = ( $query->execute() ) ? $query->fetch() : 'No se ejecuto la consulta para buscar la asignacion';

		return $rs;
	}

	public function getNewById( $id, $font = '' ) {

		if( $font != '' || $font != null ){
			$query = $this->pdo->prepare( 'SELECT * FROM noticia_' . $font . ' WHERE id_noticia = :id' );			
		}else{
			$query = $this->pdo->prepare( 'SELECT * FROM noticia WHERE id_noticia = :id' );			
		}
		$query->bindparam( ':id', $id, \PDO::PARAM_INT);

		$rs = ( $query->execute() ) ? $query->fetch() : 'No se ejecuto la consulta para buscar la noticia';

		return $rs;	
	}


}