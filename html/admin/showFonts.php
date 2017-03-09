    <?php use utilities\Util; ?>
	<?= $this->flashAlerts('fuentes'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Administrar Fuentes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <form class="" id="bootpag_text_count">
            <div class="form-inline">
                <div class="col-sm-6" id="bootpag_nummc">
                    <label for="exampleInputName2">Mostrar &nbsp;</label>
                    <input type="hidden" value="1" name="page" id="current_page">
                    <select name="numpp" id="bootpag_text_count_select" class="form-control input-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label for="exampleInputName2">&nbsp; Registros</label>
                </div>
                <div class="col-sm-6 pull-right">
                    <label>Buscar fuente</label>
                    <div class="input-group custom-search-form">                    
                        <input class="form-control" name="font_name" placeholder="El Universal" id="bootpag_search_input"> 
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>                  
                </div>
            </div>  
        </form>
            <!-- <form action="" method="get">
                
                
            </form> -->
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Fuentes
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Empresa</th>
                                <th>Logo</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fuentes as $fuente): ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <i class="fa <?= Util::tipoFuente($fuente['id_tipo_fuente'] - 1)['icon'] ?> fa-3" style="font-size:40px;"></i>
                                    </td>
                                    <td>
                                        <?= $fuente['nombre'] ?>                                            
                                    </td>
                                    <td>
                                        <?= $fuente['empresa'] ?>                                            
                                    </td>
                                    <td>
                                        <img src="/<?= $fuente['logo'] ?>" alt="<?= $fuente['nombre'] ?>" width="150" />
                                    </td>
                                    <td width="170">
                                        <a class="btn btn-default" href="/panel/fonts/detail/<?= $fuente['id_tipo_fuente'].'-'.$fuente['id_fuente'] ?>">Ver</a>
                                        <!-- <a class="btn btn-danger" href="javascript:void(0);">Dar de baja</a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-md-6">
                        <p id="bootpag_text">
                            Mostrando registros del <b><?= $ini ?></b> al <b><?= $end ?></b> de un total de <b><?= $count ?></b> registros.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p id="bootpag_pag" data-count="<?= $count ?>"></p>
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>