<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Bloques de noticias</h1>
    </div>    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-20">
        <form method="post" action="/panel/block/create" class="form-inline" id="form-block">
            <div class="form-group">
                <!-- <label for="nombre del bloque">Nombre del bloque: </label> -->
                <input class="form-control" name="blockName" placeholder="Nombre del bloque" required>                
            </div>
            <div class="form-group">
                <!-- <label for="empresa">Empresa: </label> -->
                <select class="form-control select2"  name="empresaId" required>
                    <option value="">Selecciona una Empresa</option>
                    <?php if( is_array( $companies->rows ) ) {
                            foreach ($companies->rows as $key => $empresa) { ?>
                                <option value="<?= $empresa['id_empresa'] ?>"><?= $empresa['nombre'] ?></option>
                    <?php } }?>
                </select>                
            </div>
            <input type="submit" class="btn btn-success" value="Crear bloque">
        </form>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bloques sin enviar
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre del bloque</th>
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
			                                <td><?= $row['name'] ?></td>
			                                <td><?= $row['empresa'] ?></td>
			                                <td>
			                                	<a href="/panel/news/blocks/<?= $row['id'] ?>"><i class="fa fa-eye"></i> Ver bloque</a>	
												<!-- <a href=""><i class="fa fa-pencil"></i></a>	
												<a href=""><i class="fa fa-envelope-o"></i></a>	
												<a href=""><i class="fa fa-trash-o"></i></a> -->
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