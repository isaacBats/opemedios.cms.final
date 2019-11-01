<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Historial de Newsletters</h1>
    </div>    <!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Newsletter enviados
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Nombre del Newsletter</th>
                                <th>Empresa enviado</th>
                                <th>Fecha de Envío</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        	if( $blocks->exito )
                        	{
                        		if( is_array( $blocks->rows ) )
                        		{
                        			foreach ($blocks->rows as $key => $row) { ?>
                        				                        
                        				<tr>
			                                <td><?= $key + 1 ?></td>
                                            <td><?= $row['id'] ?></td>
			                                <td><?= $row['name'] ?></td>
			                                <td><?= $row['nombre_empresa']?></td>
                                            <td><?= $row['fecha_envio']?></td>
			                                <td>
			                                	<a href="/panel/news/blocks/records/<?= $row['id'] ?>"><i class="fa fa-eye"></i> Ver Newsletter</a>
			                                </td>
			                            </tr>

                        <?php		}
                        		}else{ echo '<tr><td></td><td><h3>' . $blocks->rows . '</h3></td></tr>'; }
                        	}else{ echo '<h3> You have an error in your SQL syntax: ' . $blocks->error[1] . '</h3><input type="hidden" value="' . $blocks->error[2] . '" />'; }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>