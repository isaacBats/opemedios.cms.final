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
                        <form role="form" action="/panel/new/add/new-<?= strtolower($fuente)  ?>" method="post" name="new<?= $fuente ?>">
                            <div class="form-group">
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                     <select class="form-control" name="cobertura">
                                        <option value="">Tipo de Autor</option>
                                        <?= $tipoAutor ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                     <select class="form-control" name="cobertura">
                                        <option value="">Género</option>
                                        <?= $genero ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                     <select class="form-control" name="cobertura">
                                        <option value="">Sector</option>
                                        <?= $sector ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                     <select class="form-control" name="cobertura">
                                        <option value="">Sección</option>
                                        <?= $seccion ?>
                                    </select>
                                </div>                               
                            </div>
                            <?= $campos ?>
                            <div class="form-group">
                                 <select class="form-control" name="cobertura">
                                    <option value="">Cobertura</option>
                                    <option>Local</option>
                                    <option>Nacional</option>
                                    <option>Internacional</option>
                                </select>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="activo" value="1">Activo
                                </label>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Guardar">
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