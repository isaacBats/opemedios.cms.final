<div class="panel">
  <div class="panel-heading">
    <h4 class="panel-title">Editar Acerca de...</h4>
  </div>
  <div class="panel-body">
    <form method="post" action="" id="whoAreWe" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" placeholder="Título (en español)" class="form-control" name="titulo">
      </div>
      <div class="form-group">
        <input type="text" placeholder="Título (en inglés)" class="form-control" name="titulo_en">
      </div>
      <div class="form-group">
        <input type="text" placeholder="SLUG" class="form-control" name="slug">
        <span class="help-block">link de la pag, p.ejem "titulo-de-la-nota"</span>
      </div>
      <div class="form-group">
        <textarea id="contenido" name="contenido">Contenido en español</textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
        <textarea id="contenido_en" name="contenido_en">Contenido en inglés</textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
          <img src="/assets/images/products/<?php echo $row['imagen']?>" height="150" width="150">
          <input type="hidden" value="<?php echo $row['imagen'] ?>" class="form-control" name="imagen">
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
