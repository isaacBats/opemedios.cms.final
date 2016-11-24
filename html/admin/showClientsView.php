<?= $this->flashAlerts('clientes'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Administrar Clientes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <form class="" id="bootpag_text_count">
            <div class="form-inline">
                <div class="col-sm-12" id="bootpag_nummc">
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
            </div>  
        </form>
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Clientes
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Giro</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if( is_array( $clients ) ): ?>
                            <?php foreach ($clients as $key => $c): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $c['nombre'] ?></td>
                                    <td><?= $c['contacto'] ?></td>
                                    <td><?= $c['giro'] ?></td>
                                    <td>
                                        <a href="/panel/client/<?= $c['id_empresa'] ?>"><i class="p5 fa fa-eye" style="font-size: 1.3em;"></i></a> 
                                        <!-- <a href="javascript:void(0);"><i class="p5 fa fa-pencil"></i></a>  
                                        <a href="javascript:void(0);"><i class="p5 fa fa-envelope-o"></i></a>  
                                        <a href="javascript:void(0);"><i class="p5 fa fa-trash-o"></i></a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            No cuentas con clientes
                        <?php endif; ?>                            
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