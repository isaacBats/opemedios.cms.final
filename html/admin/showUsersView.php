<?php use utilities\Util; ?>
<?= $this->flashAlerts('usuarios'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Administrar Usuarios</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Clientes
            </div>
            <div class="panel-body">
                <div>
                    <table class="table" id="op-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Tipo de Usuario</th>
                                <th>Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if( is_array( $users ) ): ?>
                            <?php foreach ($users as $key => $u): ?>
                                <tr>
                                    <td><?= ($key  + 1 * $page) + 1 ?></td>
                                    <td><?= $u['nombre'] ?></td>
                                    <td><?= Util::tipoUsuario( $u['id_tipo_usuario'] ) ?></td>
                                    <td><?= $u['cargo'] ?></td>
                                    <td>
                                        <a href="/panel/user/<?= $u['id_usuario'] ?>"><i class="action-btn p5 fa fa-eye"></i></a>
                                        <a href="/panel/user/delete/<?=$u['id_usuario']?>" class="deleteUser"><i class="action-btn p5 fa fa-trash-o"></i></a>
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