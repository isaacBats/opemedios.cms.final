<?php

class Encrypter extends Controller
{

	public $pdo = null;
	public $type = "cuenta";
	
	function __construct()
	{
		global $_config;
		$this->pdo = new PDO($_config->db["dsn"], $_config->db["nombre_usuario"], $_config->db["password"], $_config->db["opciones"]);
	}

	public function doEncrypt(){
		$data = $this->getData();
		$SId = ($this->type == 'usuario') ? 'id_usuario': 'id_cuenta';
		$tbl = ($this->type == 'usuario') ? 'usuario': 'cuenta';

		$str = "UPDATE {$tbl} SET password = :pwd WHERE {$SId} = :id";

		$file = fopen("pwds.txt", "w") or die("Unable to open file!");

		fwrite($file, "#querys encrypt passwords" . PHP_EOL);

		try{

			foreach ($data as $key => $user) {

				$q = str_replace(':id', $user[$SId], $str);
				$hash = password_hash($user['password'], PASSWORD_DEFAULT);
				$q = str_replace(':pwd', '\''.$hash.'\'', $q);

				fwrite($file, $q . ';' . PHP_EOL);
				
			}

			fclose($file);

		}catch(Exception $err){
			echo "ERROR: " . $err;
		}

	}

	protected function getData(){
		$tbl = ($this->type == 'usuario') ? 'usuario': 'cuenta';
		$SId = ($this->type == 'usuario') ? 'id_usuario': 'id_cuenta';

		$query = $this->pdo->prepare("SELECT {$SId}, username, password FROM {$tbl} WHERE id_cuenta > 2653");
		
		if($query->execute()){
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}else{
			echo 'No se pudo ejecutar la consulta';
		}
	}
}