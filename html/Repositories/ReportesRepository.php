<?php 
use utilities\Util;

class ReportesRepository extends BaseRepository
{
	private $result;
	private $now;

	function __construct()
	{
		$this->result = new stdClass();
		$this->now = date('Y-m-d');

		parent::__construct();
	}

	public function reportForClient($empresaid, $fecha_inicio = null, $fecha_fin = null, $tema = 0, $tendencia = 0, $tipo_fuente = 0, $fuente = 0, $seccion = 0)
	{
		$sql = "SELECT noti.id_noticia, noti.id_tipo_fuente, tema.id_tema, tema.nombre AS tema, tf.descripcion AS tipo_fuente, fue.nombre AS fuente, noti.encabezado, noti.sintesis, ten.descripcion AS tendencia, noti.alcanse AS alcance, noti.fecha  FROM asigna asig INNER JOIN noticia noti ON asig.id_noticia = noti.id_noticia INNER JOIN fuente fue ON noti.id_fuente = fue.id_fuente INNER JOIN tipo_fuente tf ON noti.id_tipo_fuente = tf.id_tipo_fuente INNER JOIN tendencia ten ON noti.id_tendencia_monitorista = ten.id_tendencia INNER JOIN tema ON asig.id_tema = tema.id_tema ";
		$where = "WHERE asig.id_empresa = $empresaid ";

		if($fecha_inicio != null)
			$where .= " AND noti.fecha >= '{$fecha_inicio}' ";
		if($fecha_fin != null)
			$where .= " AND noti.fecha <= '{$fecha_fin}' ";
		if($tema != '' && $tema != 0)
			$where .= " AND asig.id_tema = $tema ";
		if($tendencia != '' && $tendencia != 0)
			$where .= " AND noti.id_tendencia_monitorista = $tendencia ";
		if($tipo_fuente != '' && $tipo_fuente != 0)
			$where .= " AND noti.id_tipo_fuente = $tipo_fuente ";
		if($fuente != '' && $fuente != 0)
			$where .= " AND noti.id_fuente = $fuente ";
		if($seccion != '' && $seccion != 0)
			$where .= " AND noti.id_seccion = $seccion ";

		$order = " ORDER BY noti.fecha DESC";
		try{
			$stmt = $this->pdo->prepare($sql.$where.$order);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
						
		}catch(PDOException $err){
			throw new PDOException("Error Processing Request: " . $err->getMessage());			
		}

		return $this->result;
	}
	/**
	 * Retorna un objecto con los totales de noticias clasificados por tipo de fuente
	 * @param  Array $news       noticias
	 * @return stdClass          Objecto con los datos de totales por tipo de fuente
	 */
	public function getCountBySourceType($news, $filters)
	{	
		$tipoFuentes = ($filters['tipo_fuente'] != 0) ? array_column($news, 'id_tipo_fuente'): [1,2,3,4,5];
		//separar cuantas noticias hay por cada tipo de fuente.
		$totales = new stdClass();
		foreach ($tipoFuentes as $key => $tipo) {
			$contador = 0;
			$strSource = "";
			foreach ($news as $clave => $noticia) {
				if ($noticia['id_tipo_fuente'] == $tipo) {
					$contador++;
					$strSource = Util::tipoFuente($tipo-1)['fuente'];
					$news[$clave]['tipo_fuente'] = $strSource;
				}
			}
			//echo "Numero de noticias de tipo {$tipo}: " . Util::tipoFuente($tipo-1)['fuente'] . " - " . $contador . "\n";
			if ($contador > 0) {
				$totales->$strSource = $contador;
			}	
		}
		return ['totales' => $totales, 'noticias' => $news];
		//print_r($totales);
		//print_r($news);
		//die();
	}

	/**
	 * Obtiene el total de noticias por atributos [Sector, genero, TipoAutor, Tendencia].
	 * @param  Array $news noticias
	 * @return stdClass    Object con 4 propiedades: [Sector, genero, TipoAutor, Tendencia]
	 * Este object contiene por cada key un array con el total de noticias. ejemplo:
	 * $object->genero => [Articulo:10, Noticia: 10, ...] 
	 */
	public function getTotalByAttributes($news)
	{
		$attributes = new stdClass();
		$ASector 	= [];
		$AGenero 	= [];
		$ATipoAutor = []; 
		$ATendencia = [];
		foreach ($news as $key => $value) {
			array_push($ASector, 	$news[$key]['sector']);
			array_push($AGenero, 	$news[$key]['genero']);
			array_push($ATipoAutor, $news[$key]['tipo_autor']);
			array_push($ATendencia, $news[$key]['tendencia']);
		}
		$attributes->sector 	= array_count_values($ASector);
		
		$attributes->genero 	= array_count_values($AGenero);

		$attributes->tipoAutor 	= array_count_values($ATipoAutor);

		$attributes->tendencia 	= array_count_values($ATendencia);

		return $attributes;
	}

	/**
	 * Obtiene el total de noticias por tema, en el formato [Tema | #Noticas]
	 * @param Array $news noticas result query.
	 * @return array arreglo con el total de noticas por tema ["tema x" => 99, ...]
	 */
	public function getTotalByTheme($news)
	{
		//creamos una rutina que obtenga el total de noticias clasificadas por tema.
		$resultData = [];
		$totalByTema = [];
		$sql = "SELECT asigna.*, tema.nombre as tema FROM asigna INNER JOIN tema ON asigna.id_tema = tema.id_tema WHERE id_noticia = :id LIMIT 1";
		foreach ($news as $key => $noticia) {
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':id', $noticia['id_noticia'], PDO::PARAM_INT);
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$idTema = $res[0]['id_tema'] ? $res[0]['id_tema']: " ";
			$nombreTema = $res[0]['tema'] ? $res[0]['tema']: " ";
			array_push($totalByTema, $idTema);
			$news[$key]['id_tema'] = $idTema;
			$news[$key]['tema'] = $nombreTema;
		}	

		$ATotalTemas = array_count_values($totalByTema);
		$themeData = []; //array de temas con ids
		//consultamos todos los temas con los id's obtenidos.
		$q = "SELECT nombre FROM tema WHERE id_tema = ? LIMIT 1";
		foreach ($ATotalTemas as $idTema => $total) {
			$q = str_replace("?", $idTema, $q);
			$stmt = $this->pdo->prepare($q);
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$STema = $res[0]['nombre'] ? $res[0]['nombre']: " ";
			$resultData[$STema] = $total;
			$themeData[$idTema] = ['id' => $idTema, 'tema' => $STema];
		}
		return ["totalByTheme" 	=> $resultData,
				"news" 			=> $news,
				"themeData" 	=> $themeData
			];
	}

	/**
	 * Formatea el array de noticias, clasificandolas por TEMA y ordenando sus propiedades
	 * @param  Array $news noticias para el reporte
	 * @return Array noticias ordenadas por tema ["TemaX" => [ ['medio'=>'TV','Fuente'=>'CNN'],[],...] ]
	 */
	public function getDetalleNoticias($news, $themeData, $ATemas)
	{
		//TODO 
		//obtener el costo de la noticia - consultamos el costo en una de las 4 tablas [noticia_(int,per,rad,rev,tel)] dependiendo del id_tipo_fuente
		$temasIDs = [];
		$sql_costo = "SELECT costo FROM :tbl WHERE id_noticia = :id LIMIT 1";
		foreach ($news as $key => $noticia) {
			$tbl = "";
			array_push($temasIDs, $noticia['id_tema']);
			switch ($noticia['id_tipo_fuente']) {
				case 1: //Television
					$tbl = "noticia_tel";
					break;
				case 2: //Radio
					$tbl = "noticia_rad";
					break;
				case 3: //Periodico	
					$tbl = "noticia_per";
					break;
				case 4: //Revista
					$tbl = "noticia_rev";	
					break;
				case 5: //Internet
					$tbl = "noticia_int";				
			}
			$stmt = $this->pdo->prepare($sql_costo);
			$stmt->bindParam(':tbl', $tbl);
			$stmt->bindParam(':id', $noticia['id_noticia']);
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$news[$key]['costo'] = (count($res)) ? $res['costo']: "";
		}
		//creamos las secciones por tema
		$newsDetail = [];
		foreach ($ATemas as $key => $val) {
			$newsDetail[$key] = [];
		}
		//llenamos $newsDetail con las noticias que le correspondan por tema.
		foreach ($news as $key => $noticia) {
			$tipoTema = array_key_exists($noticia['id_tema'], $themeData) ? 
						$themeData[$noticia['id_tema']]: false;
			if ($tipoTema) {
				array_push($newsDetail[$tipoTema['tema']], $noticia);
			}
		}
		return $newsDetail;
	}

	public function reportForDay($finicio, $ffin)
	{
		// exit("SELECT count(*) AS 'Numero' FROM noticia WHERE fecha BETWEEN '{$finicio}' AND '{$ffin}'");
		return $this->pdo->query("SELECT n.id_usuario AS ID, 
				CONCAT(u.nombre, ' ', u.apellidos) AS Nombre, 
				COUNT(*) AS 'Notas' 
			FROM noticia n 
			INNER JOIN usuario u ON n.id_usuario = u.id_usuario 
			WHERE fecha BETWEEN '{$finicio}' AND '{$ffin}' 
			GROUP BY n.id_usuario 
			ORDER BY COUNT(*) DESC")->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getNewsByAllThemes(array $data)
	{
		$result = [];
		//crear un array con keys de cada uno de los temas.
		foreach ($data['temas'] as $key => $stema) {
			$result[$stema] = array('news' => array());
		}
		//recorrer el array de news e ir agregando al array de temas['tema'].push(new) la noticia(s) que le corresponda.
		foreach ($data['news'] as $key => $noticia) {
			if (array_key_exists($noticia['tema'], $result)) {
				array_push( $result[$noticia['tema']]['news'], $noticia );
			}
		}

		return $result;
	}
}