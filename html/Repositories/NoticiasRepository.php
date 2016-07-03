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
			$sql = "SELECT n.id_noticia 	AS 'id', 
					       n.encabezado 	AS 'encabezado', 
					       n.sintesis   	AS 'sintesis', 
					       n.autor 	    	AS 'autor', 
					       n.fecha 	    	AS 'fecha', 
					       n.comentario 	AS 'comentario', 
					       n.id_tipo_fuente	AS 'tipofuente_id',
					       tf.descripcion	AS 'tipofuente',
					       n.id_fuente		AS 'fuente_id',
					       f.nombre			AS 'fuente',
					       n.id_seccion		AS 'seccion_id',
					       scc.nombre		AS 'seccion',
					       n.id_sector		AS 'sector_id',
					       sec.nombre		AS 'sector',
					       n.id_tipo_autor	AS 'tipoautor_id',
					       ta.descripcion	AS 'tipoautor',
					       n.id_genero		AS 'genero_id',
					       g.descripcion	AS 'genero',
					       n.id_tendencia_monitorista AS 'tendencia_id',
					       t.descripcion	AS 'tendencia',
					       n.id_usuario		AS 'usuario_id',
					       u.nombre			AS 'usuario'
					FROM   noticia n
					INNER JOIN tipo_fuente tf ON n.id_tipo_fuente = tf.id_tipo_fuente
					INNER JOIN fuente f 	  ON n.id_fuente = f.id_fuente
					INNER JOIN seccion scc    ON n.id_seccion = scc.id_seccion
					INNER JOIN sector sec     ON n.id_sector = sec.id_sector 
					INNER JOIN tipo_autor ta  ON n.id_tipo_autor = ta.id_tipo_autor
					INNER JOIN genero g 	  ON n.id_genero = g.id_genero
					INNER JOIN tendencia t 	  ON n.id_tendencia_monitorista = t.id_tendencia
					INNER JOIN usuario u 	  ON n.id_usuario = u.id_usuario
					WHERE n.id_noticia = :id;";
			// $query = $this->pdo->prepare( 'SELECT * FROM noticia WHERE id_noticia = :id' );			
			$query = $this->pdo->prepare( $sql );			
		}
		$query->bindparam( ':id', $id, \PDO::PARAM_INT);

		$rs = ( $query->execute() ) ? $query->fetch() : 'No se ejecuto la consulta para buscar la noticia';

		return $rs;	
	}


}