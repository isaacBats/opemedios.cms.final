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

	public function showNewsToDay( $data = [] ){
		
		extract( $data );

		$sql = ' 	SELECT n.id_noticia AS id, n.encabezado, f.nombre AS nameFont
					FROM noticia n
					INNER JOIN fuente f ON n.id_fuente = f.id_fuente
					WHERE fecha = CURDATE()	
				';
		$l = ' LIMIT ' . $limit . ' OFFSET ' . $page;
		$o = ' ORDER BY n.id_noticia DESC';
					// WHERE n.id_noticia > 500000
		$query = $this->pdo->prepare( $sql . $o . $l);

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
		$query->bindParam( ':id', $id, \PDO::PARAM_INT);

		$rs = ( $query->execute() ) ? $query->fetch() : 'No se ejecuto la consulta para buscar la noticia';

		return $rs;	
	}

	public function getTendencias(){
		
		$query = $this->pdo->prepare("SELECT * FROM tendencia;");			
		
		$tendencias = ( $query->execute() ) ? $query->fetchAll(\PDO::FETCH_ASSOC) : 'No se pudo ejecutar la consulta para buscar todos los Sectores';
		
		return $tendencias;
	}

	public function updateNew( $new ){

		$sql = 'UPDATE noticia SET encabezado 				= :encabezado,
								   sintesis	  				= :sintesis,
								   autor	  				= :autor,
								   fecha	  				= :fecha,
								   comentario 				= :comentario,
								   id_fuente      			= :fuente_id,
								   id_seccion     			= :seccion_id,
								   id_sector      			= :sector_id,
								   id_tipo_autor  			= :tipoautor_id,
								   id_genero      			= :genero_id,
								   id_tendencia_monitorista = :tendencia_id
				WHERE id_noticia = :noticia_id;				
			   ';
		
		$query = $this->pdo->prepare( $sql );
	 	$query->bindParam(':encabezado', $new['encabezado']);
	 	$query->bindParam(':sintesis', $new['sintesis']);
	 	$query->bindParam(':autor', $new['autor']);
	 	$query->bindParam(':fecha', $new['fecha']);
	 	$query->bindParam(':comentario', $new['comentarios']);
	 	$query->bindParam(':fuente_id', $new['fuente_id']);
	 	$query->bindParam(':seccion_id', $new['seccion']);
	 	$query->bindParam(':sector_id', $new['sector']);
	 	$query->bindParam(':tipoautor_id', $new['tipoAutor']);
	 	$query->bindParam(':genero_id', $new['genero']);
	 	$query->bindParam(':tendencia_id', $new['tendencia']);
	 	$query->bindParam(':noticia_id', $new['noticia_id']);

	 	return $query->execute();
	}

	public function updateNewRadTel( $new, $typeFont ){

		$sql = 'UPDATE noticia_' . $typeFont . ' SET hora     = :hora,
													 duracion = :duracion,
													 costo    = :costo
				WHERE id_noticia = :noticia_id;
	
		';

		$query = $this->pdo->prepare( $sql );
		$query->bindParam(':hora', $new['hora']);
		$query->bindParam(':duracion', $new['duracion']);
		$query->bindParam(':costo', $new['costoBeneficio']);
		$query->bindParam(':noticia_id', $new['noticia_id']);

		return $query->execute();
	}

	public function updateNewPerRev( $new, $typeFont ){


		$sql = 'UPDATE noticia_' . $typeFont . ' SET pagina            = :pagina,
													 id_tipo_pagina    = :tipopag_id,
													 porcentaje_pagina = :tamano,
													 costo             = :costo
				WHERE id_noticia = :noticia_id;
	
		';
		
		$query = $this->pdo->prepare( $sql );
		$query->bindParam(':pagina', $new['pagina']);
		$query->bindParam(':tipopag_id', $new['tipoPagina']);
		$query->bindParam(':tamano', $new['tamano']);
		$query->bindParam(':costo', $new['costoBeneficio']);
		$query->bindParam(':noticia_id', $new['noticia_id']);

		return $query->execute();
	}

	public function updateNewInt( $new, $typeFont ){

		$sql = 'UPDATE noticia_' . $typeFont . ' SET url     		  = :url,
													 hora_publicacion = :hora,
													 costo    		  = :costo
				WHERE id_noticia = :noticia_id;
	
		';

		$query = $this->pdo->prepare( $sql );
		$query->bindParam(':hora', $new['hora']);
		$query->bindParam(':url', $new['url']);
		$query->bindParam(':costo', $new['costoBeneficio']);
		$query->bindParam(':noticia_id', $new['noticia_id']);

		return $query->execute();
	}

	public function insertAsigna( $data ){

		$sql = 'INSERT INTO asigna (id_noticia, id_empresa, id_tema, id_tendencia) VALUES (:noticiaid, :empresaid, :temaid, :tendenciaid)';

		$query = $this->pdo->prepare( $sql );
		$query->bindParam(':noticiaid', $data['noticiaid']);
		$query->bindParam(':empresaid', $data['empresaid']);
		$query->bindParam(':temaid', $data['temaid']);
		$query->bindParam(':tendenciaid', $data['tendenciaid']);

		return $query->execute();
	}

	public function getCountNews( $data = [], $hoy = '' ){

		$sql = '';

		if( count( $data ) > 0 ){
			
			extract( $data );
			
			$sql = 'SELECT COUNT(*) AS count FROM noticia';

			$w = ' WHERE ';
			if( $titulo != null ){
				$w .= "encabezado LIKE '%" . $titulo . "%' ";

				if( $finicio != null && !isset( $ffin ) ){
					$w .= " AND fecha = '" . $finicio . "' ";
				}

				if( $finicio != null && ( isset( $ffin ) && $ffin != null ) ){
					$w .= " AND fecha > '" . $finicio . "' AND fecha < '" . $ffin . "' ";
				}

				if( $tipoFuente != null ){
					$w .= " AND id_tipo_fuente = $tipoFuente";
				}
			}elseif( $titulo == ''){

				if( $finicio != null && !isset( $ffin ) ){
					$w .= " fecha = '" . $finicio . "' ";
				}

				if( $finicio != null && ( isset( $ffin ) && $ffin != null ) ){
					$w .= " AND fecha > '" . $finicio . "' AND fecha < '" . $ffin . "' ";
				}

				if( $tipoFuente != null && $tipoFuente != 0 ){

					$w .= " AND id_tipo_fuente = $tipoFuente";

				}elseif( $tipoFuente == 0 ){

					$w .= " AND id_tipo_fuente in ('1', '2', '3', '4', '5')";
				}
			}			
			$query = $this->pdo->prepare ( $sql . $w );

		}else{
			
			$sql = 'SELECT COUNT(*) AS count FROM noticia';

			$query = $this->pdo->prepare( $sql );			
		}

		if( !empty( $hoy ) ){
			$query = $this->pdo->prepare( 'SELECT COUNT(*) AS count  FROM noticia WHERE fecha = CURDATE()' );
		}

		$value = ( $query->execute() ) ? $query->fetch( \PDO::FETCH_ASSOC ) : 0;

		$value = intval($value['count']);

		return $value;
	}

	public function getNewsWithFilters( $data = [] ){

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
					INNER JOIN usuario u 	  ON n.id_usuario = u.id_usuario ";

		if( count( $data ) > 0 ){
			
			extract( $data );
			
			$w = ' WHERE ';
			if( $titulo != null ){
				$w .= "n.encabezado LIKE '%" . $titulo . "%' ";

				if( $finicio != null && !isset( $ffin ) ){
					$w .= " AND n.fecha = '" . $finicio . "' ";
				}

				if( $finicio != null && ( isset( $ffin ) && $ffin != null ) ){
					$w .= " AND n.fecha > '" . $finicio . "' AND n.fecha < '" . $ffin . "' ";
				}

				if( $tipoFuente != null ){
					$w .= " AND n.id_tipo_fuente = $tipoFuente";
				}
			}elseif( $titulo == ''){

				if( $finicio != null && !isset( $ffin ) ){
					$w .= " n.fecha = '" . $finicio . "' ";
				}

				if( $finicio != null && ( isset( $ffin ) && $ffin != null ) ){
					$w .= " AND n.fecha > '" . $finicio . "' AND n.fecha < '" . $ffin . "' ";
				}

				if( $tipoFuente != null && $tipoFuente != 0 ){

					$w .= " AND n.id_tipo_fuente = $tipoFuente";

				}elseif( $tipoFuente == 0 ){

					$w .= " AND n.id_tipo_fuente in ('1', '2', '3', '4', '5')";
				}
			}

			$l = ' LIMIT ' . $limit . ' OFFSET ' . $page;
			$o = ' ORDER BY n.fecha';

			// echo $sql . $w . $o . $l; exit();
			$query = $this->pdo->prepare ( $sql . $w . $o . $l );

		}
		// else{
			
		// 	$sql = 'SELECT COUNT(*) AS count FROM noticia';

		// 	$query = $this->pdo->prepare( $sql );			
		// }

		$value = ( $query->execute() ) ? $query->fetchAll( \PDO::FETCH_ASSOC ) : 'No ahi resultados para tu filtro';

		// echo $sql . $w . $o . $l; echo '<pre>'; print_r($value); exit(); 

		return $value;
	}	

}