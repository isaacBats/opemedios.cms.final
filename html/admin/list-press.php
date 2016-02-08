<div class="table-responsive">
  <div class="clear-fix col-sm-3 pull-right">
    <a href="/panel/add/gallery" class="btn btn-danger btn-quirk btn-block mb20">Nueva Galeria</a>
  </div>
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
         <td><img height="150" width="150" alt="" src="/assets/images/press/cover/'.$p['imagen'].'"/> </td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/gallery/'.$p['id'].'">Ver</a>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
</div>