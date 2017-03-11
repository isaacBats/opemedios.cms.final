<?php

include_once("BaseRepository.php");

class AsignaRepository extends BaseRepository
{

	public function findByThemeIdAndCompanyId ($empresa, $tema) 
	{
		if (is_array($tema))
			$tema = implode(",", $tema);

		return $this->pdo->query("SELECT * FROM asigna WHERE id_empresa = $empresa AND id_tema in ($tema)")->fetchAll(\PDO::FETCH_ASSOC);
	}

}