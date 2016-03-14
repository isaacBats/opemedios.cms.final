<div class="clear-fix col-sm-3 pull-right">
  <a href="/panel/galleries/add/<?php echo $id; ?>" class="btn btn-danger btn-quirk btn-block mb20">Agregar nueva imagen</a>
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
        <h5 class="fm-title"><a href=""><?php echo $image['imagen'] ?></a></h5>
        <small class="text-muted">Added: July 1, 2015</small>
      </div><!-- thmb -->
    </div>
    <?php } ?>
</div>
