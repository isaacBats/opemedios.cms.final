<form method="post" action="/panel/news/save-changes" id="addNew" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-8">
      <div class="panel">
        
        <div class="panel-body" id="js-panel-body">
            <input type="hidden" value="<?php echo $new['id_noticia'] ?>" class="form-control" name="id">
            <div class="form-group">

              <label class="panel-title">Titulo en español<span class="text-danger">*</span></label>
              <input type="text" value="<?php echo $new['titulo'] ?>" class="form-control" name="titulo">
            </div>

            <h4 class="panel-title">Contenido en español</h4>
            
            <div class="form-group">
              <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
              <textarea id="contenido" name="contenido"><?php echo $new['contenido'] ?></textarea>
            </div>
            <div class="form-group">
              <button type="submit" id="btn-submit" class="btn btn-success">Guardar cambios</button>
            </div>
            
          </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="panel ">
        <div class="panel-body" id="js-panel-body">
            
            <h4 class="panel-title">Fecha de publicación</h4>
            <div class="input-group">
              
              <input type="text" class="form-control hasDatepicker" placeholder="mm/dd/yyyy" id="datepicker">
              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
  
            <hr>
            
            <div class="form-group">
              <label class="panel-title">Extracto<span class="text-danger">*</span></label>
              <span class="help-block">Se muestra en el home de noticias <br>500 Caracteres max.</span>
              <textarea name="extracto" class="form-control" rows="15"><?php echo $new['extracto'] ?></textarea>
            </div>
        </div>
      </div>
    </div>
  
</div>

<div class="row">
      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">Editar Noticia</h4>
        </div>
        <div class="panel-body" id="js-panel-body">
            
            <div class="form-group">
              <label class="control-label">Titulo en Ingles<span class="text-danger">*</span></label>
              <input type="text" value="<?php echo $new['titulo_en'] ?>" class="form-control" name="titulo_en">
            </div>

            <h4 class="panel-title">Contenido en ingles</h4>
            
            <div class="form-group">
              <span class="help-block">Recuerda que puedes utilizar las herramientas del editor para formar tu contenido.</span>
              <textarea id="contenido_en" name="contenido_en"><?php echo $new['contenido_en'] ?></textarea>
            </div>
            <div class="form-group">
              <button type="submit" id="btn-submit" class="btn btn-success">Guardar cambios</button>
            </div>
          </div>
      </div>
    </div>

</div>
    <div class="col-sm-4">
      <div class="panel ">
        <div class="panel-heading">
          <h4 class="panel-title">Imagenes</h4>
        </div>
        <div class="panel-body" id="js-panel-body">
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
            <div class="form-group">
              <label class="control-label">Extracto<span class="text-danger">*</span>
              <span class="help-block">Se muestra en el home de noticias 500 Caracteres max.</span>
              </label>
              
              <textarea name="extracto" class="form-control" rows="6"><?php echo $new['extracto'] ?></textarea>
            </div>
            <div class="form-group">
            <label class="control-label">
            Extracto en Ingles<span class="text-danger">*</span>
            <span class="help-block">Se muestra en el home de noticias 500 Caracteres max.</span></label>
            <textarea name="extracto_en" class="form-control" rows="6"><?php echo $new['extracto_en'] ?></textarea>
            </div>
            <div class="form-group">
              <button type="submit" id="btn-submit" class="btn btn-success">Guardar cambios</button>
            </div>
            
        </div>
      </div>
    </div>
  
</form>
