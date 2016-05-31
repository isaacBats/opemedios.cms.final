<?php 

include_once("BaseRepository.php");

class NoticiasRepository extends BaseRepository{

	public function showAllNews(){
		
		$query = $this->pdo->prepare("SELECT * FROM noticia ORDER BY id_noticia DESC LIMIT 30;");
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
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
					WHERE fecha = CURDATE()
					ORDER BY n.id_noticia DESC;					
				';
		$query = $this->pdo->prepare( $sql );

		$rs = ( $query->execute() ) ? $query->fetchAll() : 'No hay noticias aun';

		return $rs;
	}

}