	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar Noticia de <?= $newSelected['tipofuente'] ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Editar Noticia
                <button class="btn btn-success" data-toggle="collapse" data-target="#collapseFiles" aria-expanded="false" aria-controls="collapseFiles" style="margin: -7px; float: right;">Ver archivos adjunto</button>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="collapse" id="collapseFiles">
                            <div class="panel panel-default">
                              <div class="panel-heading">Archivos Adjuntos a la nota</div>
                              <div class="panel-body">
                                <? if(count($attachedFiles) > 0){ ?>
                                    <table class="table table-responsive table-bordered table-hover">
                                        <thead>
                                            <!--<th></th>-->
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>acciones</th>
                                        </thead>
                                        <tbody>
                                            <? foreach ($attachedFiles as $key => $fileAttached) { ?>
                                                <tr>
                                                <!--<td>
                                                    <? //$fn::renderFileIcon($fileAttached)?>
                                                </td>-->
                                                <td><?=$fileAttached['nombre']?></td>
                                                <td><?=$fileAttached['tipo']?></td>
                                                <td>
                                                    <button class="btn btn-small btn-info attach-replace"
                                                        data-fid="<?=$fileAttached['id_adjunto']?>" 
                                                        data-nid="<?=$id?>"
                                                        data-toggle="modal" data-target="#modalReplacer"
                                                    >reemplazar</button>
                                                </td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table> 
                                    <? } else { ?>
                                    <label>Esta nota no tiene archivos adjuntos.</label>
                                <? } ?>
                              </div>
                            </div>
                        </div>
                        <form id="form_new" method="post" action="/panel/new/update-new" enctype="multipart/form-data">
                            <input type="hidden" name="noticia_id" value="<?= $newSelected['id'] ?>" />
                            <input type="hidden" name="tipofuente_id" value="<?= $newSelected['tipofuente_id'] ?>" />
                            <div class="form-group"> 
                            	<label>Encabezado:</label>
                                <input class="form-control" value="<?= $newSelected['encabezado'] ?>" name="encabezado" required>
                            </div>
                            <div class="form-group">
                                <div class="alert alert-primary" role="alert">
                                    <label>Pegar Síntesis: (Reemplazará la síntesis actual)</label>
                                    <textarea id="paste_here" class="form-control" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Síntesis:</label>
                                <textarea id="summernote" class="form-control" rows="10" name="sintesis"><?= $newSelected['sintesis'] ?></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <label>Fuente:</label>
                                        <select class="select2 form-control" name="fuente_id" id="selectFuente" required >
                                            <option value="">Seleccione una Fuente</option>
                                            <?= $optionFont ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label>Sección:</label>
                                    <select class="form-control" name="seccion" id="add-new-secction">
                                        <option value="<?= $seccion['id_seccion'] ?>"><?= $seccion['nombre'] ?></option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group"> 
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <label>Autor:</label>
                                            <input class="form-control col-xs-3 col-lg-3" value="<?= $newSelected['autor'] ?>" name="autor" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Alcance</label>
                                            <input class="form-control col-xs-3 col-lg-3" name="alcance" value="<?= $newSelected['alcance'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <label>Tipo de Autor:</label>
                                            <select class="form-control col-xs-3 col-lg-3" name="tipoAutor">
                                                <option value="">Tipo de Autor</option>
                                                <?= $tipoAutor ?>
                                            </select>        
                                        </div>
                                        <div class="col-md-6">
                                            <label>Género:</label>
                                            <select class="form-control col-xs-3 col-lg-3" name="genero">
                                                <option value="">Género</option>
                                                <?= $genero ?>
                                            </select>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Fecha:</label>
                                <div id="fecha_new" class="input-group">
                                    <input type="text" class="form-control fechaNota" value="<?= $newSelected['fecha'] ?>" name="fecha" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <?= $campos ?>
                            <div class="form-group col-sm-3 <?= ( $newSelected['tipofuente_id'] == 3 || $newSelected['tipofuente_id'] == 4 ) ? 'col-sm-pull-3' : ''  ?>">
                                <label>Costo Beneficio:</label>
                                <input class="form-control" value="<?= $costo ?>" name="costoBeneficio">
                            </div>
                            <div class="row">
                            <div class="form-group <?= ( $newSelected['tipofuente_id'] == 3 || $newSelected['tipofuente_id'] == 4 ) ? 'col-sm-3 col-sm-pull-3' : 'col-sm-6'  ?>">
                                <label>Tendencia:</label>
                                 <select class="form-control" name="tendencia">
                                    <option value="">Tendencia</option>
                                    <?= $tendencia ?>
                                </select>
                            </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Guardar">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="modal fade" id="modalReplacer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cargar archivo nuevo</h4>
      </div>
      <form id="formReplace" action="/panel/new/replace-attached" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label for="" class="control-label">Archivo</label>
            <input type="file" name="adjunto" class="form-control" id="newFileAttached">
            <input type="hidden" name="aid" id="aid-value">
            <input type="hidden" name="nid" id="nid-value">
            <input type="hidden" name="fuenteid" value="<?=$newSelected['tipofuente_id']?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="cancel-replacer" data-dismiss="modal">
            Cancelar
        </button>
        <input type="submit" class="btn btn-primary" id="btnReplace" value="Replace" />
      </div>
      </form>
    </div>
  </div>
</div>