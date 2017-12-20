<?php 

include_once("BaseRepository.php");

class EmpresaTemaCuentaRepository extends BaseRepository
{
	private $table = 'empresa_tema_cuenta';

	public function deleteFromEmpresa($empresa)
	{
		if ($this->pdo->exec("DELETE FROM {$this->table} WHERE id_empresa = {$empresa}"))
			return true;
		else 
			return false;
	}

    public function getCuentasByEmpresa($empresa)
    {
        $stmt = $this->pdo->prepare("SELECT id_cuenta FROM {$this->table} WHERE id_empresa = :empresa");
        try {
            if ($stmt->execute([':empresa' => $empresa]))
                return $stmt->fetchAll(\PDO::FETCH_COLUMN);
            else
                return false;
        } catch (PDOException $e) {
            throw new Exception("Error al traer las cuentas relacionadas a una Empresa. Message: {$e->getMessage()}");    
        }
    }	
}
