<?php

include_once("BaseRepository.php");

class AsignaRepository extends BaseRepository
{

	public function findByThemeIdAndCompanyId ($empresa, $tema, $search = NULL, $limit = 10, $page = 0)
	{
		if (is_array($tema))
			$tema = implode(",", $tema);

		if (is_null($search)) {
			$qry_news = "SELECT * FROM asigna WHERE id_empresa = $empresa AND id_tema in ($tema) ORDER BY id_noticia DESC LIMIT $limit OFFSET $page";
			$qry_count = "SELECT COUNT(*) AS count FROM asigna WHERE id_empresa = $empresa AND id_tema in ($tema)";
		} else {
			//$qry_news = "SELECT a.* FROM asigna a INNER JOIN noticia n ON a.id_noticia = n.id_noticia WHERE a.id_empresa = $empresa AND a.id_tema in ($tema) AND (n.encabezado LIKE '%{$search}%' OR n.sintesis LIKE '%{$search}%') ORDER BY a.id_noticia DESC LIMIT $limit OFFSET $page";
			$qry_news = "SELECT a.* FROM asigna a INNER JOIN noticia n ON a.id_noticia = n.id_noticia WHERE a.id_empresa = $empresa AND a.id_tema in ($tema) AND (n.encabezado LIKE '%{$search}%') ORDER BY a.id_noticia DESC LIMIT $limit OFFSET $page";
			$qry_count = "SELECT COUNT(*) AS count FROM asigna a INNER JOIN noticia n ON a.id_noticia = n.id_noticia WHERE a.id_empresa = $empresa AND a.id_tema in ($tema) AND (n.encabezado LIKE '%{$search}%' OR n.sintesis LIKE '%{$search}%')";
		}
		// exit($qry_news . PHP_EOL . $qry_count);

		$stmt_news = $this->pdo->prepare($qry_news);
		$stmt_count = $this->pdo->prepare($qry_count);

		if ($stmt_news->execute())
			$news = ($stmt_news->rowCount() > 0) ? $stmt_news->fetchAll(PDO::FETCH_ASSOC) : 0;

		if ($stmt_count->execute())
			$count = ($stmt_count->rowCount() > 0) ? $stmt_count->fetch(PDO::FETCH_ASSOC) : 0;

		return [
			'rows' => (!$news) ? 0 : $news,
			'count' => (!$count) ? 0 : $count['count']
			];
	}

	public function countNewsAsigned ($empresa, $tema)
	{
		if (is_array($tema))
			$tema = implode(",", $tema);

		$stmt = $this->pdo->prepare("SELECT a.id_noticia, n.fecha FROM asigna a
			INNER JOIN noticia n ON a.id_noticia = n.id_noticia
			WHERE id_empresa = $empresa AND id_tema in ($tema)");

		$totals = array();
		if($stmt->execute()) {
			$news = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$totals['mounth'] = count(array_filter($news, function($row) {

				return substr($row['fecha'], 0, 7) == date('Y-m');

			}));
			$totals['today'] = count(array_filter($news, function($row) {

				return $row['fecha'] == date('Y-m-d');

			}));

			$totals['total'] = count($news);
		} else {
			$totals = ['mounth' => 0, 'today' => 0, 'total' => 0];
		}

		return $totals;
	}

	private function toString($value, $key)
	{
		if (is_array($value)) {
			return " {$key} in (" . implode(',', $value) .") ";
		} else {
			return " {$key} = {$value} ";
		}
	}

	public function find(array $data)
	{
		$qry = 'SELECT * FROM asigna WHERE 1 = 1 ';
		$where = '';
		if (!is_null($data['id_noticia'])) {
			$where .= ' AND ' . $this->toString($data['id_noticia'], 'id_noticia');
		}

		if (!is_null($data['id_empresa'])) {
			$where .= ' AND ' . $this->toString($data['id_empresa'], 'id_empresa');
		}

		if (!is_null($data['id_tema'])) {
			$where .= ' AND ' . $this->toString($data['id_tema'], 'id_tema');
		}

		if (!is_null($data['id_tendencia'])) {
			if($data['id_tendencia'] == 0)
				$where .= ' AND id_tendencia in (1,2,3)';
			else
				$where .= " AND id_tendencia = {$data['id_tendencia']}";
		}
		//print_r($qry.$where);
		//die("break point 1");
		$stmt = $this->pdo->prepare($qry . $where);

		try {
			if($stmt->execute()) {
				return $stmt->fetchAll(\PDO::FETCH_ASSOC);
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo "Error: => {$e->getMessage()}";
		}
	}

	public function updateThemeTrend($data)
	{
		$response = new stdClass();
		$qry = 'UPDATE asigna SET id_tema = :idtheme, id_tendencia = :idtrend WHERE id_noticia = :idnew LIMIT 1';
		$stmt = $this->pdo->prepare($qry);
		$stmt->bindParam(':idtheme', $data['idtheme'], PDO::PARAM_INT);
		$stmt->bindParam(':idtrend', $data['idtrend'], PDO::PARAM_INT);
		$stmt->bindParam(':idnew', 	 $data['idnew'],   PDO::PARAM_INT);
		//$stmt->bindParam(':idtema',  $data['idtheme'], PDO::PARAM_INT);
		try {
			if($stmt->execute()) {
				$response->success = true;
			} else {
				$response->success = false;
				$response->msgError = "Fallo la actualizacion";
			}
			return $response;
		} catch (Exception $e) {
			echo "Error: => {$e->getMessage()}";
			$response->success = false;
			return $response;
		}
	}

	public function deleteFromPortal($idNew)
	{
		$response = new stdClass();
		$stmt = $this->pdo->prepare( 'SELECT * FROM noticia WHERE id_noticia = :id LIMIT 1' );
		$stmt->bindParam(':id', $idNew, PDO::PARAM_INT);
		$rs   = $stmt->execute();
		if ($rs) {
			$noticia = ($stmt->rowCount() > 0) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
			if (!$noticia){
				$response->success = true;
				$response->nosirvio = true;
				return $response; 
			}

			$tbl = "";
			switch ($noticia[0]['id_tipo_fuente']) {
				case 1:
					$tbl = "noticia_tel";	 
					break;
				case 2:
					$tbl = "noticia_rad";
					break;
				case 3:
					$tbl = "noticia_per";	 
					break;
				case 4:
					$tbl = "noticia_rev";
					break;
				case 5:
					$tbl = "noticia_int";	 
					break;
			}
			$qry  = 'DELETE FROM noticia WHERE id_noticia = :id LIMIT 1';
			$qry1 = 'DELETE FROM asigna WHERE id_noticia = :id LIMIT 1';
			$qry2 = 'DELETE FROM :tbl WHERE id_noticia = :id LIMIT 1';
			$qry3 = 'DELETE FROM bloques_noticias WHERE id_noticia = :id LIMIT 1';

			$stmt  = $this->pdo->prepare($qry);
			$stmt->bindParam(':id', $idNew, PDO::PARAM_INT);

			$stmt2  = $this->pdo->prepare($qry1);
			$stmt2->bindParam(':id', $idNew, PDO::PARAM_INT);

			$stmt3  = $this->pdo->prepare($qry2);
			$stmt3->bindParam(':tbl', $tbl, PDO::PARAM_STR);
			$stmt3->bindParam(':id', $idNew, PDO::PARAM_INT);
			
			$stmt4  = $this->pdo->prepare($qry3);
			$stmt4->bindParam(':id', $idNew, PDO::PARAM_INT);			
			/*$stmt2->execute();
			if (isset($tbl) && $tbl != "") {
				$stmt3->execute();	
			}*/

			$rs1 = $stmt->execute();
			$rs2 = $stmt2->execute();
			$rs3 = $stmt3->execute();
			if ($tbl!="") {
				$rs4 = $stmt4->execute();	
			}
			

			//if ($rs1 && $rs2 && $rs3 && $rs4) {
				$response->success = true;
				$response->error   = false;
				$response->action = "delete";
			/*} else {
				$response->success = false;
				$response->error   = true;
			}*/

			return $response;

		} else {
			$response->success = true;
			$response->nosirvio = true;
			return $response; 	
		}
	}

	public function isRecordDuplicate(array $data)
	{
		$q = "SELECT * FROM asigna WHERE id_noticia = :idNoticia AND id_empresa = :idEmpresa AND id_tema = :idTema";
		$stmt = $this->pdo->prepare($q);
		$stmt->bindParam(':idNoticia', $data['id_noticia'], PDO::PARAM_INT);
		$stmt->bindParam(':idEmpresa', $data['id_empresa'], PDO::PARAM_INT);
		$stmt->bindParam(':idTema', $data['id_tema'], PDO::PARAM_INT);

		try {
			if ($stmt->execute()) {
 				return ($stmt->rowCount() > 0) ? true: false;
			}
			return true;
		} catch (Exception $e) {
			return true;
		}

	}

}
