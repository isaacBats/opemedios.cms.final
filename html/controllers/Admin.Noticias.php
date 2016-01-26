<?php 

class AdminNoticias extends Controller{

	public function showNews(){
		$this->header_admin($lang="es");
		$html = '<div class="table-responsive">
	              <table class="table table-bordered table-default table-striped nomargin">
	                <thead class="success">
	                  <tr>
	                    <th>Título</th>
	                    <th>Extracto</th>
	                    <th>Fecha</th>
	                    <th class="text-right">Acciones</th>
	                  </tr>
	                </thead>
	                <tbody>';
        $sql = "SELECT * FROM noticias";
		$query = $this->pdo->prepare($sql);
		$query->bindParam(':id_tabla', $id_tabla);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$rows = $query->fetchAll();
				foreach ($rows as $row) {
					$html .= '
					<tr>
                     <td>'.$row['titulo'].'</td>
                     <td>'.$row['extracto'].'</td>
                     <td>'.$row['fecha'].'</td>
                     <td class="text-right">
                     	<button class="btn btn-default btn-sm">Ver</button>
                     	<button class="btn btn-success btn-sm">Editar</button>
                     </td>
                   </tr>';
				}
			}
		}
                  
		$html .= '</tbody>
              </table>
            </div>';
        echo $html;
		$this->footer_admin($lang="es");
	}
	
}

?>