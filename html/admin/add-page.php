<div class="panel">
  <div class="panel-heading">
    <h4 class="panel-title">Crear Página</h4>
  </div>
  <div class="panel-body">
    <form method="post" action="/panel/plain/add/page" id="newPag" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" placeholder="Título (en español)" class="form-control" name="titulo">
      </div>
      <div class="form-group">
        <input type="text" placeholder="Título (en inglés)" class="form-control" name="title">
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
        <textarea id="contenido_en" name="contend">Contenido en inglés</textarea>
        <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
      </div>
      <div class="form-group">
        <input type="file" name="imagen">
        <span class="help-block">Imagen principal de la página</span>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" id="btn-submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>
