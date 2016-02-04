<div class="panel">
  <div class="panel-heading">
    <h4 class="panel-title">Agregar nueva imagen</h4>
  </div>
  <div class="panel-body">
    <form method="post" action="/panel/galleries/save" id="addNew" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" name="gallery_id" value="<?php echo $id_gallery; ?>">
      </div>
      <div class="form-group">
        <input type="file" name="imagen_thumbnail">
        <span class="help-block">Imagen en tamaño THUMBNAIL (200*200px)</span>
      </div>
      <div class="form-group">
        <input type="file" name="imagen">
        <span class="help-block">Imagen principal</span>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" id="btn-submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>
