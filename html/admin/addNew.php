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
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 "> 
                                <label>Encabezado:</label>
                                <input class="form-control" placeholder="Encabezado" name="encabezado" required>
                            </div>
                            <!--<div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <div class="alert alert-primary" role="alert">
                                    <label>Pegar Síntesis:</label>
                                    <textarea id="paste_here" class="form-control" rows="1"></textarea>
                                </div>
                            </div>-->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label>Escribir o Editar Síntesis:</label>
                                <textarea id="ckeditordiv" name="sintesis"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Fuente:</label>
                                <select id="selectFuente" class="select2 form-control" name="fuente" required >
                                    <option value="">Seleccione una Fuente</option>
                                    <?= $optionFont ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Sección:</label>
                                 <select class="form-control" name="seccion" id="add-new-secction" disabled="disabled" >
                                    <option value="">Sección</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-3"> 
                                <label for="autor">Autor:</label>
                                <input class="form-control" id="autor" placeholder="Nombre Autor" name="autor" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Alcance</label>
                                <input class="form-control" name="alcance" placeholder="1">
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                <label>Tipo de autor:</label>
                                 <select class="form-control" name="tipoAutor" required >
                                    <option value="">Tipo de Autor</option>
                                    <?= $tipoAutor ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                <label>Genero:</label>
                                 <select class="form-control" name="genero" required >
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
                            <!-- <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                <label>Fecha</label>
                                <div id="fecha_new" class="input-group">
                                    <input type="text" class="form-control fechaNota" placeholder="yyyy-mm-dd" name="fecha" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div> -->
                            <?= $campos ?>
                            <div class="form-group">
                                <div class="form-group col-sm-3"> 
                                    <label>Costo Beneficio:</label>
                                    <input class="form-control" placeholder="Costo Beneficio" name="costoBeneficio">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Tendencia:</label>
                                     <select class="form-control" name="tendencia" required>
                                        <option value="">Tendencia</option>
                                        <option value="1" >Positiva</option>
                                        <option value="2" >Neutral</option>
                                        <option value="3" >Negativa</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                <label>Comentarios:</label>
                                <textarea class="form-control" name="comentarios" rows="6"></textarea>
                            </div> -->
                            <div class="form-group col-sm-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="checkBlock"/>Incluir a Newsletters
                                    </label>
                                </div>
                            </div>
                            <div class="invisible col-sm-12 col-md-8 col-lg-8" id="panelBloque">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="bloque">Bloque:</label>
                                            <select name="bloque" class="form-control select-bloque" >
                                                <option value="">Seleccione un bloque</option>
                                                <?php if( is_array($sbloques) ){
                                                        foreach ($sbloques as $b) { ?>
                                                            <option value="<?= $b['id'] ?>" data-empresa="<?= $b['empresa_id'] ?>"><?= $b['name'] ?></option>
                                                <?php   }
                                                       }else{
                                                        echo $sbloques;
                                                       }
                                                ?>
                                            </select>
                                            <label for="tema">Tema:</label>
                                            <select name="tema" class="form-control select-tema" disabled="disabled">
                                                <option value="">Seleccione un tema</option>
                                            </select>
                                            <!-- <a class="btn btn-info disabled pull-right" id="btn-guardar-tema"><i class="fa fa-save"></i> Guardar </a>
                                            <a class="btn btn-primary"><i class="fa fa-plus-circle"></i> Crear Bloque</a>
                                            <a class="btn btn-success"><i class="glyphicon glyphicon-repeat"></i> Agregar Noticia a otro bloque</a> -->
                                        </div>
                                    </div>
                                </div>                                
                            </div>

                            <?php //Falta validacion de archivos ?>
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label>Archivo de <?php if($fuente === 'Television'){
                                                                echo str_replace('Television', 'Video', ucwords($fuente));
                                                           }elseif($fuente === 'Periodico'){
                                                                echo str_replace('Periodico', 'Periódico', ucwords($fuente));
                                                            }else{
                                                                echo $fuente;
                                                            } 
                                                      ?></label>
                                <input type="file" id="primario" name="primario[]" multiple />
                                <input type="hidden" name="MAX_FILE_SIZE" value="50000000000" />
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