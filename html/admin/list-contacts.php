<div class="table-responsive">
  <table class="table table-bordered table-default table-striped nomargin">
    <thead class="success">
      <tr>
        <th>Nombre</th>
        <th>Empresa</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th class="text-right">Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($rows as $row) {
        echo '
        <tr>
         <td>'.$row['nombre'].'</td>
         <td>'.$row['empresa'].'</td>
         <td>'.$row['telefono'].'</td>
         <td>'.$row['email'].'</td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/contact/'.$row['id_contacto'].'" >Ver</a>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
</div>