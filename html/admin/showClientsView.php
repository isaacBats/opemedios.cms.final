<?= $this->flashAlerts('clientes'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Administrar Clientes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Clientes
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" id="op-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Giro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if( is_array( $clients ) ): ?>
                            <?php foreach ($clients as $key => $c): ?>
                                <tr>
                                    <td><?= ($key  + 1 * $page) + 1 ?></td>
                                    <td><?= $c['nombre'] ?></td>
                                    <td><?= $c['contacto'] ?></td>
                                    <td><?= $c['giro'] ?></td>
                                    <td>
                                        <a href="/panel/client/<?= $c['id_empresa'] ?>"><i class="action-btn p5 fa fa-eye"></i></a> 
                                        <a href="/panel/client/remove/<?= $c['id_empresa'] ?>" data-id="<?= $c['id_empresa'] ?>" class="delete-client"><i class="action-btn p5 fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            No cuentas con clientes
                        <?php endif; ?>                            
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>