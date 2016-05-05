<?php 

include_once("BaseRepository.php");

class AdjuntoRepository extends BaseRepository{

	public function add ( $adjunto, $idNoticia ){

		if ( $adjunto['principal'] == 1 ) {
		
			$nombreArchivo = 'ID'.$idNoticia.'_'.$adjunto['files']['primario']['name'];
		
		}else{
			
			$nombreArchivo = 'ID'.$idNoticia.'_2_'.$adjunto['files']['primario']['name'];
		}

		$sql = 'INSERT INTO adjunto (nombre, tipo, carpeta, principal, id_noticia, nombre_archivo) 
								VALUES(:nombre, :tipo, :carpeta, :principal, :idNoticia, :nombreArchivo)';

		$query = $this->pdo->prepare($sql);
		$query->bindParam(':nombre',$adjunto['files']['primario']['name']);
		$query->bindParam(':tipo',$adjunto['files']['primario']['type']);
		$query->bindParam(':carpeta',$adjunto['slug']);
		$query->bindParam(':principal',$adjunto['principal']);
		$query->bindParam(':idNoticia',$idNoticia);
		$query->bindParam(':nombreArchivo',$nombreArchivo);
		
		if($query->execute()){
			return true;
		}else{
		 	return false;
		}

	}
}