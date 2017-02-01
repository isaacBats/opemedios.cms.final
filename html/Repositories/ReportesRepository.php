<?php 

class ReportesRepository extends BaseRepository
{
	private $result;

	function __construct()
	{
		$this->result = new stdClass();
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

			if($stmt->execute()){
				$this->result->exito = TRUE;
				$this->result->rows = ($stmt->rowCount() > 0) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
			}else{
				$this->result->exito = FALSE;
				$this->result->error = $stmt->errorInfo()[2];
			}			
		}catch(PDOException $err){
			throw new PDOException("Error Processing Request: " . $err->getMessage());			
		}

		return $this->result;
	}
}