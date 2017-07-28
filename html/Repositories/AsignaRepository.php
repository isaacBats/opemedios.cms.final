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
			$qry_news = "SELECT a.* FROM asigna a INNER JOIN noticia n ON a.id_noticia = n.id_noticia WHERE a.id_empresa = $empresa AND a.id_tema in ($tema) AND (n.encabezado LIKE '%{$search}%' OR n.sintesis LIKE '%{$search}%') ORDER BY a.id_noticia DESC LIMIT $limit OFFSET $page";
			$qry_count = "SELECT COUNT(*) AS count FROM asigna a INNER JOIN noticia n ON a.id_noticia = n.id_noticia WHERE a.id_empresa = $empresa AND a.id_tema in ($tema) AND (n.encabezado LIKE '%{$search}%' OR n.sintesis LIKE '%{$search}%')";
		}
		// exit($qry_news . PHP_EOL . $qry_count);

		$news = $this->pdo->query($qry_news)->fetchAll(\PDO::FETCH_ASSOC);
		$count = $this->pdo->query($qry_count)->fetch(\PDO::FETCH_ASSOC);


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

}