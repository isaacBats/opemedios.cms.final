<div class="table-responsive">
  <table class="table table-bordered table-default table-striped nomargin">
    <thead class="success">
      <tr>
        <th>Título</th>
        <th class="text-right">Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($rows as $row) {
        $html = '
        <tr>
         <td>'.$row['titulo'].'</td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/plain/page/'.$row['slug'].'">Ver</a>';
          
          if($row['id'] == $idHome){
            $html .= '<a class="btn btn-success btn-sm" href="/panel/gallery/'.$idGallery['id'].'" >Editar</a>';            
          }else{
            $html .= '<a class="btn btn-success btn-sm" href="/panel/plain/page/edit/'.$row['id'].'" >Editar</a>';   
          }
          

          $html .= '<!-- <a class="btn btn-danger btn-sm removePage" href="javascript:void(0);" data-id="'.$row['id'].'" >Eliminar</a>  -->
        </td>
      </tr>';

      echo $html;
    }
    ?>
  </tbody>
</table>
</div>