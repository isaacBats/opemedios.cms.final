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
		$stmt_news = $this->pdo->prepare($qry_news);
		$stmt_count = $this->pdo->prepare($qry_count);

		if ($stmt_news->execute())
			$news = ($stmt_news->rowCount() > 0) ? $stmt_news->fetchAll(PDO::FETCH_ASSOC) : 0;
		if($stmt_count->execute())
			$count = ($stmt_count->rowCount() > 0) ? $stmt_count->fetchAll(PDO::FETCH_ASSOC)['count'] : 0;
		
		return [
			'rows' => $news, 
			'count' => $count
			];
	}

	public function countNewsAsigned ($empresa, $tema) 
	{
		if (is_array($tema))
			$tema = implode(",", $tema);

		$news = $this->pdo->query("SELECT a.id_noticia, n.fecha FROM asigna a 
			INNER JOIN noticia n ON a.id_noticia = n.id_noticia 
			WHERE id_empresa = $empresa AND id_tema in ($tema)")->fetchAll(\PDO::FETCH_ASSOC);
		
		$totals = array();
		if($news) {
			
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