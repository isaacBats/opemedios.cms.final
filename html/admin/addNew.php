	<div class="row">
        <div class="col-lg-12">
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Agregar Noticia
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="/panel/new/<?= strtolower($fuente)  ?>/save" method="post" name="new<?= $fuente ?>">
                            <div class="form-group select2">
                                <select class="form-control" name="fuente" id="selectFuente">
                                    <option value="">Seleccione una Fuente</option>
                                    <?= $optionFont ?>
                                </select>
                            </div>
                            <div class="form-group"> 
                                <input class="form-control" placeholder="Encabezado" name="encabezado">
                            </div>
                            <div class="form-group">
                                <label>Síntesis:</label>
                                <textarea class="form-control" name="sintesis"></textarea>
                            </div>
                            <div class="form-group"> 
                                <input class="form-control" placeholder="Nombre Autor" name="autor">
                            </div>
                            <div class="form-group col-lg-6">
                                 <select class="form-control" name="tipoAutor">
                                    <option value="">Tipo de Autor</option>
                                    <?= $tipoAutor ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                 <select class="form-control" name="genero">
                                    <option value="">Género</option>
                                    <?= $genero ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                 <select class="form-control" name="sector">
                                    <option value="">Sector</option>
                                    <?= $sector ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                 <select class="form-control" name="seccion">
                                    <option value="">Sección</option>
                                    <?= $seccion ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6">
                                <label>Fecha</label>
                                <div class="input-group">
                                    <input type="text" class="form-control fechaNota" placeholder="yyyy-mm-dd" name="fecha" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">                               
                                <?= $campos ?>
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="form-group col-sm-6"> 
                                    <input class="form-control" placeholder="Costo Beneficio" name="costoBeneficio">
                                </div>
                                <div class="form-group col-sm-6">
                                     <select class="form-control" name="tendencia">
                                        <option value="">Tendencia</option>
                                        <option>Positiva</option>
                                        <option>Neutral</option>
                                        <option>Negativa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>Comentarios:</label>
                                <textarea class="form-control" name="comentarios"></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Archivo de <?php if($fuente === 'Television'){
                                                                echo str_replace('Television', 'Video', ucwords($fuente));
                                                           }elseif($fuente === 'Periodico'){
                                                                echo str_replace('Periodico', 'Periódico', ucwords($fuente));
                                                            }else{
                                                                echo $fuente;
                                                            } 
                                                      ?></label>
                                <input type="file" name="file">
                                <input type="file" name="imagen">
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