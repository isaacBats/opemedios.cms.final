<div class="panel">
  <div class="panel-heading">
    <h3 >
      Detalle de <?php  echo $page['titulo']; ?>
    </h3>
    <p></p>
  </div>

  
  <div class="panel-body">
<?php 
  foreach ($page as $key => $value) {
    echo '<h4 class="panel-title">'.$key.'</h4>';
    if($key == "imagen"){
      echo '<img height="150" width="150" alt="" src="/assets/images/'.$value.'" />';  
    }else{
      echo '<p>'.$value.'</p>';      
    }
  } 
?>  
  </div>
</div>