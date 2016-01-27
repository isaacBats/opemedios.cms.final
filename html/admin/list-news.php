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
          <button class="btn btn-default btn-sm">Ver</button>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
</div>