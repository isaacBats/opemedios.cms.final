<div class="panel">
  <div class="panel-heading">
    <h4 class="panel-title">Editar <?php echo $page['titulo']; ?></h4>
  </div>
  <div class="panel-body">
    <form method="post" action="/panel/plain/page/update" id="editPage" enctype="multipart/form-data">
      <div class="form-group">
        <input type="hidden" value="<?php echo $page['id'] ?>" class="form-control" name="id">
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $page['titulo'] ?>" class="form-control" name="titulo">
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $page['titulo_en'] ?>" class="form-control" name="titulo_en">
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $page['slug'] ?>" class="form-control" name="slug">
        <span class="help-block">link de la pag, p.ejem "titulo-de-la-nota"</span>
      </div>
      <div class="form-group">
        <textarea id="contenido" name="contenido"><?php echo $page['contenido'] ?></textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
        <textarea id="contenido_en" name="contenido_en"><?php echo $page['contenido_en'] ?></textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $page['comentario'] ?>" class="form-control" name="comentario">
        <span class="help-block">Se utiliza para un pequeño parrafo que acompañe a la imagen</span>
      </div>
      <div class="form-group">
        <input type="text" value="<?php echo $page['coment'] ?>" class="form-control" name="coment">
        <span class="help-block">Se utiliza para un pequeño parrafo que acompañe a la imagen en inglés</span>
      </div>
      <div class="form-group">
          <img src="/assets/images/<?php echo $page['imagen']?>" height="150" width="150">
          <input type="hidden" value="<?php echo $page['imagen'] ?>" class="form-control" name="imagen">
          <input type="file" name="imagen" id="input-imagen" class="inp-thum">
          <a href="javascript:void(0);" id="btn-changeImage" class="borrar atributo imagen btn btn-default" ><i class="fa fa-pencil-square-o"> Cambiar</i></a>
          <span class="help-block">Imagen principal de la página</span>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" id="btn-submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>
