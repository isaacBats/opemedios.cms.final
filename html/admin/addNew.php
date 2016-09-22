	<div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h1 class="page-header">Agregar Noticia de <?php if($fuente === 'Television'){
                                                                echo str_replace('Television', 'Televisión', ucwords($fuente));
                                                           }elseif($fuente === 'Periodico'){
                                                                echo str_replace('Periodico', 'Periódico', ucwords($fuente));
                                                            }else{
                                                                echo $fuente;
                                                            } 
                                                      ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Agregar Noticia
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <form id="form_new" method="post" action="/panel/new/<?= strtolower($fuente)  ?>/save" enctype="multipart/form-data">
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group select2">
                                <select class="form-control" name="fuente" id="selectFuente" required >
                                    <option value="">Seleccione una Fuente</option>
                                    <?= $optionFont ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 "> 
                                <input class="form-control" placeholder="Encabezado" name="encabezado" required>
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label>Síntesis:</label>
                                <textarea class="form-control" name="sintesis"></textarea>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3"> 
                                <input class="form-control" placeholder="Nombre Autor" name="autor" required>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                 <select class="form-control" name="tipoAutor">
                                    <option value="">Tipo de Autor</option>
                                    <?= $tipoAutor ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                 <select class="form-control" name="genero">
                                    <option value="">Género</option>
                                    <?= $genero ?>
                                </select>
                            </div>
                            <!-- <div class="form-group col-lg-6">
                                 <select class="form-control" name="sector">
                                    <option value="">Sector</option>
                                    <?php //echo $sector ?>
                                </select>
                            </div> -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                 <select class="form-control" name="seccion" id="add-new-secction" disabled="disabled" >
                                    <option value="">Sección</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                <label>Fecha</label>
                                <div id="fecha_new" class="input-group">
                                    <input type="text" class="form-control fechaNota" placeholder="yyyy-mm-dd" name="fecha" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <?= $campos ?>
                            <div class="form-group">
                                <div class="form-group col-sm-12 col-md-6 col-lg-6"> 
                                    <input class="form-control" placeholder="Costo Beneficio" name="costoBeneficio">
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                     <select class="form-control" name="tendencia">
                                        <option value="">Tendencia</option>
                                        <option value="1" >Positiva</option>
                                        <option value="2" >Neutral</option>
                                        <option value="3" >Negativa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label>Comentarios:</label>
                                <textarea class="form-control" name="comentarios"></textarea>
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" />Incluir a bloque de noticias
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Archivo de <?php if($fuente === 'Television'){
                                                                echo str_replace('Television', 'Video', ucwords($fuente));
                                                           }elseif($fuente === 'Periodico'){
                                                                echo str_replace('Periodico', 'Periódico', ucwords($fuente));
                                                            }else{
                                                                echo $fuente;
                                                            } 
                                                      ?></label>
                                <input type="file" name="primario" />
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
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