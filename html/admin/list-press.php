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
    foreach ($press as $p) {
        echo '
        <tr>
         <td>'.$p['nombre'].'</td>
         <td><img height="150" width="150" alt="" src="/assets/images/galeria/'.$p['imagen'].'"/> </td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/press/'.$p['id'].'">Ver</a>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
</div>