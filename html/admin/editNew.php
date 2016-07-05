	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar Noticia de <?= $newSelected['tipofuente'] ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Editar Noticia
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form_new" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group"> 
                            	<label>Título:</label>
                                <input class="form-control" value="<?= $newSelected['encabezado'] ?>" name="encabezado" required>
                            </div>
                            <div class="form-group">
                                <label>Síntesis:</label>
                                <textarea class="form-control" name="sintesis"><?= $newSelected['sintesis'] ?></textarea>
                            </div>
                            <div class="form-group select2">
                                <label>Fuente:</label>
                                <select class="form-control" name="fuente" id="selectFuente" required >
                                    <option value="">Seleccione una Fuente</option>
                                    <?= $optionFont ?>
                                </select>
                            </div>
                            <div class="form-group"> 
                                <label>Nombre Autor:</label>
                                <input class="form-control" value="<?= $newSelected['autor'] ?>" name="autor" required>
                            </div>
                            <div class="form-group col-lg-6">
                            	<label>Tipo de Autor:</label>
                                 <select class="form-control" name="tipoAutor">
                                    <option value="">Tipo de Autor</option>
                                    <?= $tipoAutor ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                            	<label>Género:</label>
                                 <select class="form-control" name="genero">
                                    <option value="">Género</option>
                                    <?= $genero ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                            	<label>Sector:</label>
                                 <select class="form-control" name="sector">
                                    <option value="">Sector</option>
                                    <?= $sector ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                            	<label>Sección:</label>
                                 <select class="form-control" name="seccion">
                                    <option value="">Sección</option>
                                    <?= $seccion ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Fecha:</label>
                                <div id="fecha_new" class="input-group">
                                    <input type="text" class="form-control fechaNota" value="<?= $newSelected['fecha'] ?>" name="fecha" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <?= $campos ?>
                            <div class="form-group">
                                <div class="form-group col-lg-6">
                                    <label>Costo:</label>
                                    <input class="form-control" value="<?= 'Sin costo por el momento' ?>" name="costoBeneficio">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Tendencia:</label>
                                     <select class="form-control" name="tendencia">
                                        <option value="">Tendencia</option>
                                        <?= $tendencia ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>Comentarios:</label>
                                <textarea class="form-control" name="comentarios"><?= $newSelected['comentario'] ?></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Archivo de <?= $newSelected['tipofuente'] ?></label>
                                <input type="file" name="primario" />
                            </div>
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