<div class="table-responsive"> 
  <table class="table table-bordered table-default table-striped nomargin">
    <thead class="success">
      <tr>
        <th>Imagen</th>
        <th>Thumb</th>
        <th class="text-right">Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($images as $image) {
        echo '
        <tr>          
         <td><img height="150" width="150" alt="" src="'.$url.$image['imagen'].'"/> </td>
         <td><img height="80" width="80" alt="" src="'.$url.$image['thumb'].'"/> </td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/gallery/update/'.$image['id'].'" >Actualizar</a>
          <a class="btn btn-danger btn-sm" href="/panel/gallery/remove/'.$image['id'].'" >Eliminar</a>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
<br class="clear">
<div class="text-right">
  <a class="btn btn-primary btn-sm" href="/panel/galleries/add" >Agregar nueva imagen</a>  
</div>
</div>
