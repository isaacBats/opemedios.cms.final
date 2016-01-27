<div class="panel">
  <div class="panel-heading">
    <h4 class="panel-title">Agregar noticia</h4>
    <p>Llena estos campos para crear la noticia.</p>
  </div>
  <div class="panel-body">
    <form method="post" action="/admin/news/add" id="addNew" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" placeholder="Título (en español)" class="form-control" name="titulo">
      </div>
      <div class="form-group">
        <input type="text" placeholder="Título (en inglés)" class="form-control" name="titulo_en">
      </div>
      <div class="form-group">
        <input type="text" placeholder="SLUG" class="form-control" name="slug">
        <span class="help-block">Slug de la noticia, p.ejem "titulo-noticia-diciembre"</span>
      </div>
      <div class="form-group">
        <input type="text" placeholder="Extracto (en español)" class="form-control" name="extracto">
      </div>
      <div class="form-group">
        <input type="text" placeholder="Extracto (en inglés)" class="form-control" name="extracto_en">
      </div>
      <div class="form-group">
        <textarea id="contenido" name="contenido">Contenido de la noticia</textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
        <textarea id="contenido_en" name="contenido_en">Contenido de la noticia (en inglés)</textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
        <input type="file" name="imagen_thumbnail">
        <span class="help-block">Imagen en tamaño THUMBNAIL (200*200px)</span>
      </div>
      <div class="form-group">
        <input type="file" name="imagen">
        <span class="help-block">Imagen principal de la noticia</span>
      </div>
      <div class="input-group">
        <input type="text" name="fecha" class="form-control medium" placeholder="Fecha de la noticia" id="fecha">
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" id="btn-submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>
