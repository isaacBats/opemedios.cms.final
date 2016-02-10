<div class="panel">
  <div class="panel-heading">
    <h4 class="panel-title">Edita noticia</h4>
  </div>
  <div class="panel-body" id="js-panel-body">
    <form method="post" action="/panel/news/save-changes" id="addNew" enctype="multipart/form-data">
      <div class="form-group">
        <input type="hidden" value="<?php echo $new['id_noticia'] ?>" class="form-control" name="id">
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $new['titulo'] ?>" class="form-control" name="titulo">
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $new['titulo_en'] ?>" class="form-control" name="titulo_en">
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $new['extracto'] ?>" class="form-control" name="extracto">
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $new['extracto_en'] ?>" class="form-control" name="extracto_en">
      </div>
      <div class="form-group">
        <textarea id="contenido" name="contenido"><?php echo $new['contenido'] ?></textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
        <textarea id="contenido_en" name="contenido_en"><?php echo $new['contenido_en'] ?></textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
        <img src="/assets/images/news/<?php echo $new['imagen_thumbnail']?>" height="80" width="80" id="img-thumbnail">
        <input type="file" name="imagen_thumbnail" id="input-imagen_thumbnail" class="inp-thum">
        <a href="javascript:void(0);" id="btn-changeThumbnail" class="borrar atributo imagen btn btn-default" ><i class="fa fa-pencil-square-o"> Cambiar</i></a>
        <span class="help-block">Imagen en tamaño THUMBNAIL (200*200px)</span>
      </div>
      <div class="form-group">
        <img src="/assets/images/news/<?php echo $new['imagen']?>" height="150" width="150">
        <input type="file" name="imagen" id="input-imagen" class="inp-thum">
        <a href="javascript:void(0);" id="btn-changeImage" class="borrar atributo imagen btn btn-default" ><i class="fa fa-pencil-square-o"> Cambiar</i></a>
        <span class="help-block">Imagen principal de la noticia</span>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" id="btn-submit" class="btn btn-success">Guardar cambios</button>
      </div>
    </form>
  </div>
</div>
