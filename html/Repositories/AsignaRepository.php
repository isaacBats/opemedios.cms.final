<?php

include_once("BaseRepository.php");

class AsignaRepository extends BaseRepository
{

	public function findByThemeIdAndCompanyId ($empresa, $tema, $limit = 10, $page = 0) 
	{
		if (is_array($tema))
			$tema = implode(",", $tema);

		$news = $this->pdo->query("SELECT * FROM asigna WHERE id_empresa = $empresa AND id_tema in ($tema) ORDER BY id_noticia DESC LIMIT $limit OFFSET $page")->fetchAll(\PDO::FETCH_ASSOC);
		
		$count = $this->pdo->query("SELECT COUNT(*) AS count FROM asigna WHERE id_empresa = $empresa AND id_tema in ($tema)")->fetch(\PDO::FETCH_ASSOC);

		return ['rows' => $news, 'count' => $count['count']];
	}

}