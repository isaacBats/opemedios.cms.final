<div class="table-responsive">
  <table class="table table-bordered table-default table-striped nomargin">
    <thead class="success">
      <tr>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Estatus</th>
        <th class="text-right">Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($rows as $row) {
          
       $status='<span class="label label-warning">Pendiente</span>';
       if($row['status']==1)
         $status='<span class="label label-success">Aprobado</span>';
       elseif($row['status']==2) 
         $status='<span class="label label-default">Denegado</span>';
      
        echo '
        <tr>
         <td>'.$row['nombre'].' '.$row['apellidos'].'</td>
         <td>'.$row['telefono'].'</td>
         <td>'.$row['email'].'</td>
         <td>
            '.$status.'
        </td>
         <td class="text-right">
          <a class="btn btn-default btn-sm" href="/panel/user/'.$row['id_registro'].'">Ver</a>
        </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
</div>