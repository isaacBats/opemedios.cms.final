<div class="table-responsive">
  <table class="table table-bordered table-default table-striped nomargin">
    <thead class="success">
      <tr>
        <th>Nombre</th>
        <th>Imagen</th>
        <th class="text-right">Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($galleries as $gallery) {
        echo '
        <tr>
         <td>'.$gallery['nombre'].'</td>
         <td><img height="150" width="150" alt="" src="/assets/images/galeria/'.$gallery['imagen'].'"/> </td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/gallery/'.$gallery['id'].'">Ver</a>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
</div>