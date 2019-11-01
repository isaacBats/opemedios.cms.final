<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Newsletters</h1>
    </div>    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-20">
        <form method="post" action="/panel/block/create" class="form-inline" enctype="multipart/form-data" id="form-block">
            <div class="form-group">
                <input class="form-control" name="blockName" id="blockName" placeholder="Nombre del Newsletter" required>
            </div>
            <div class="form-group">
                <select class="form-control"  name="empresaId" id="empresaId" required>
                    <option value="">Selecciona una Empresa</option>
                    <?php if( is_array( $companies->rows ) ) {
                            foreach ($companies->rows as $key => $empresa) { ?>
                                <option value="<?= $empresa['id_empresa'] ?>"><?= $empresa['nombre'] ?></option>
                    <?php } }?>
                </select>                
            </div>
            <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Imagen del bloque <input name="banner-img" type="file" style="display: none;">
                            </span>
                        </label>
                        <input type="text" class="form-control" readonly="">
                    </div>
            </div>
            <input type="submit" class="btn btn-success" value="Crear Newsletter">
        </form>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Newsletter sin enviar
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
                                <th>Empresa</th>
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
			                                <td><?= $row['empresa'] ?></td>
			                                <td>
			                                	<a href="/panel/news/blocks/<?= $row['id'] ?>"><i class="fa fa-eye"></i> Ver Newsletter</a>&nbsp;&nbsp;	
												<a href="#" data-bid="<?=$row['id']?>" class="btn-rm-block">
                                                    <i class="fa fa-trash-o"></i> Elimnar
                                                </a>
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