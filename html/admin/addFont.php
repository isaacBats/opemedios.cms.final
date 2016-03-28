	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Agregar Fuente de <?php if($fuente === 'Television'){
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
                Agregar Fuente
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="/panel/font/add/font-<?= strtolower($fuente)  ?>" method="post" name="font<?= $fuente ?>">
                            <div class="form-group">
                                <input class="form-control" placeholder="Nombre" name="nombre">
                            </div>
                            <div class="form-group"> 
                                <input class="form-control" placeholder="Empresa" name="empresa">
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
                            <div class="form-group">
                                <label>Comentarios:</label>
                                <textarea class="form-control" name="comentario"></textarea>
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