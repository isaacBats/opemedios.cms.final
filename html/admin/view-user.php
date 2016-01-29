<div class="panel">
  <div class="panel-heading">
    <h3 >
      Detalle de contacto
    </h3>
    <p></p>
  </div>

  
  <div class="panel-body">
<?php 
  foreach ($user as $key => $value) {
    echo '<h4 class="panel-title">'.$key.'</h4>';
    echo '<p>'.$value.'</p>';      
  } 
?>  
    <a class="btn btn-success" href="/panel/user/edit/<?php echo $user['id_registro']; ?>">Editar</a>
    <a class="btn btn-success" href="/panel/user/remove/<?php echo $user['id_registro']; ?>">Eliminar</a> 
  </div>
</div>
