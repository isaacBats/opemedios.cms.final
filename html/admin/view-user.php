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
  </div>
</div>
