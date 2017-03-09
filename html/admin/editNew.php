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
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="form_new" method="post" action="/panel/new/update-new" enctype="multipart/form-data">
                            <input type="hidden" name="noticia_id" value="<?= $newSelected['id'] ?>" />
                            <input type="hidden" name="tipofuente_id" value="<?= $newSelected['tipofuente_id'] ?>" />
                            <div class="form-group col-sm-12"> 
                            	<label>Encabezado:</label>
                                <input class="form-control" value="<?= $newSelected['encabezado'] ?>" name="encabezado" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Síntesis:</label>
                                <textarea id="summernote" class="form-control" rows="10" name="sintesis"><?= $newSelected['sintesis'] ?></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Fuente:</label>
                                <select class="form-control select2" name="fuente_id" id="selectFuente" required >
                                    <option value="">Seleccione una Fuente</option>
                                    <?= $optionFont ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                            	<label>Sección:</label>
                                 <select class="form-control" name="seccion" id="add-new-secction">
                                    <option value="<?= $seccion['id_seccion'] ?>"><?= $seccion['nombre'] ?></option>
                                </select>
                            </div>
                            <div class="form-group col-sm-3"> 
                                <label>Autor:</label>
                                <input class="form-control" value="<?= $newSelected['autor'] ?>" name="autor" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Alcance</label>
                                <input class="form-control" name="alcance" value="<?= $newSelected['alcance'] ?>">
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Tipo de Autor:</label>
                                 <select class="form-control" name="tipoAutor">
                                    <option value="">Tipo de Autor</option>
                                    <?= $tipoAutor ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Género:</label>
                                 <select class="form-control" name="genero">
                                    <option value="">Género</option>
                                    <?= $genero ?>
                                </select>
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
                            <div class="form-group <?= ( $newSelected['tipofuente_id'] == 3 || $newSelected['tipofuente_id'] == 4 ) ? 'col-sm-3 col-sm-pull-3' : 'col-sm-6'  ?>">
                                <label>Tendencia:</label>
                                 <select class="form-control" name="tendencia">
                                    <option value="">Tendencia</option>
                                    <?= $tendencia ?>
                                </select>
                            </div>
                            <!-- <div class="col-lg-12 form-group">
                                <label>Comentarios:</label>
                                <textarea class="form-control" name="comentarios" rows="6" ><?php //echo $newSelected['comentario'] ?></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Archivo de <?php //echo $newSelected['tipofuente'] ?></label>
                                <input type="file" name="primario" />
                            </div> -->
                            <div class="col-lg-12">
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