<div class="panel">
  <div class="panel-heading">
    <h3 >
      Detalle de <?php  echo $product['nombre']; ?>
    </h3>
    <p></p>
  </div>

  
  <div class="panel-body">
<?php 
  foreach ($product as $key => $value) {
    echo '<h4 class="panel-title">'.$key.'</h4>';
    if($key == "imagen"){
      if($value != "default2.jpg"){
        echo '<img height="150" width="150" alt="" src="/assets/images/products/'.$product['ur'].'/'.$value.'" />';
      }else{
        echo '<img height="150" width="150" alt="" src="/assets/images/products/'.$value.'" />';  
      }
    }else{
      echo '<p>'.$value.'</p>';      
    }
  } 
?>  
  </div>
</div>
