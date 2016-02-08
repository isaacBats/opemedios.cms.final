<div class="panel">
  <div class="panel-heading">
    <h2 class="panel-title">Nueva Galeria</h2>
  </div>
  <div class="panel-body">
    <form method="post" action="/panel/save/gallery" id="addNew" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" placeholder="Nombre de la galeria" class="form-control" name="nombre">
      </div>
      <div class="form-group">
        <input type="text" placeholder="slug-url" class="form-control" name="slug">
        <span class="help-block">Ejemplo: ad-junio-2016. <br>Nota: El slug no lleva espacions entre palabras, separarlas con un guion "-"</span>
      </div>
      <div class="form-group">
       	<select title="Contexto" placeholder="Contexto" name="contexto" id="contexto">
			<option value="">Contexto</option>
			<option value="brochure">Brochure</option>
			<option value="publicity">Publicity</option>
		</select>
      </div>
      <div class="form-group">
        <input type="file" name="imagen">
        <span class="help-block">Imagen portada</span>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" id="btn-submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>
