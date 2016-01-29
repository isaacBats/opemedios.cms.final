<div class="panel">
  <div class="panel-heading">
    <h3 >
      Detalle de contacto
    </h3>
    <p></p>
  </div>

  
  <div class="panel-body">
<?php 
  foreach ($contact as $key => $value) {
    echo '<h4 class="panel-title">'.$key.'</h4>';
    echo '<p>'.$value.'</p>';      
  } 
?>  
    <a class="btn btn-success" href="/panel/contact/edit/<?php echo $contact['id_contacto']; ?>">Editar</a>
    <a class="btn btn-success" href="/panel/contact/remove/<?php echo $contact['id_contacto']; ?>">Eliminar</a> 
  </div>
</div>
