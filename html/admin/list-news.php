<div class="table-responsive">
  <table class="table table-bordered table-default table-striped nomargin">
    <thead class="success">
      <tr>
        <th>Título</th>
        <th>Extracto</th>
        <th>Fecha</th>
        <th class="text-right">Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($rows as $row) {
        echo '
        <tr>
         <td>'.$row['titulo'].'</td>
         <td>'.$row['extracto'].'</td>
         <td>'.$row['fecha'].'</td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/new/'.$row['id_noticia'].'">Ver</a>
          <a class="btn btn-success btn-sm" href="/panel/new/edit/'.$row['id_noticia'].'" >Editar</a>
          <a class="btn btn-danger btn-sm" href="/panel/new/remove/'.$row['id_noticia'].'" >Eliminar</a>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
</div>