<div class="panel">
  <div class="panel-heading">
    <h3 >
      Detalle de nota
    </h3>
    <p></p>
  </div>

  
  <div class="panel-body">
<?php 
  foreach ($new as $key => $value) {
    echo '<h4 class="panel-title">'.$key.'</h4>';
    if($key == "imagen" || $key == "imagen_thumbnail"){
      echo '<img alt="" src="/assets/images/news/'.$value.'" />';
    }else{
      echo '<p>'.$value.'</p>';      
    }
  } 
?>  
  </div>
</div>
