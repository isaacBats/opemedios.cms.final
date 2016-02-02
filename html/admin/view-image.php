<!-- <div class="col-sm-8 col-md-9 col-lg-10">
  <div class="table-responsive"> 
    <table class="table table-bordered table-default table-striped nomargin">
      <thead class="success">
        <tr>
          <th>Imagen</th>
          <th>Thumb</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php
      foreach ($images as $image) {
          echo '
          <tr>          
           <td><img height="150" width="150" alt="" src="'.$url.$image['imagen'].'"/> </td>
           <td><img height="80" width="80" alt="" src="'.$url.$image['thumb'].'"/> </td>
           <td class="text-right">
            <a class="btn btn-default btn-sm" href="/panel/gallery/update/'.$image['id'].'" >Actualizar</a>
            <a class="btn btn-danger btn-sm" href="/panel/gallery/remove/'.$image['id'].'" >Eliminar</a>
          </td>
        </tr>';
      }
      ?>
    </tbody>
  </table>
  </div>
</div> -->

<div class="clear-fix col-sm-3 pull-right">
  <a href="/panel/galleries/add" class="btn btn-danger btn-quirk btn-block mb20">Agregar nueva imagen</a>
</div>
<div class="clearfix"></div>
<div class="row filemanager">
     <?php
      foreach ($images as $image) {
    ?>
    <div class="col-xs-6 col-sm-4 ">
      <div class="thmb">
        <!-- <label class="ckbox" >
          <input type="checkbox"><span></span>
        </label> -->
        <div class="btn-group fm-group" style="display: none;">
          <button type="button" class="btn btn-default dropdown-toggle fm-toggle" data-toggle="dropdown">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right fm-menu" role="menu">
            <li><a href="/panel/gallery/update/<?php echo $image['id']; ?>"><i class="fa fa-pencil"></i> Edit</a></li>
            <li><a href="<?php echo $url.$image['imagen']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></li>
            <li><a href="/panel/gallery/remove/<?php echo $image['id']; ?>"><i class="fa fa-trash-o"></i> Delete</a></li>
          </ul>
        </div><!-- btn-group -->
        <div class="thmb-prev">
          <img src="<?php echo $url.$image['imagen']; ?>" class="img-responsive" alt="">
        </div>
        <h5 class="fm-title"><a href="">Imagen 1</a></h5>
        <small class="text-muted">Added: July 1, 2015</small>
      </div><!-- thmb -->
    </div>
    <?php } ?>
</div>
