<div class="table-responsive">
  <table class="table table-bordered table-default table-striped nomargin">
    <tbody>
    <?php
    foreach ($images as $image) {
        echo '
        <tr>          
         <td><img height="150" width="150" alt="" src="/assets/images/galeria/'.$image['imagen'].'"/> </td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/galleries/'.$image['id'].'" >Editar</a>
          <a class="btn btn-default btn-sm" href="/panel/galleries/'.$image['id'].'" >Eliminar</a>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
</div>
