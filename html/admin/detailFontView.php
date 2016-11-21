<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header"><?= $font['nombre'] ?></h1>
	</div>
	<div class="col-md-6">
		<img src="/<?= $font['logo']  ?>" alt="<?= $font['nombre'] ?>" width="320">
	</div>
	<div class="col-md-6">
		<?php foreach ($font as $key => $value): 
				if( $key != 'id_fuente' && $key != 'id_cobertura' && $key != 'logo' && $key != 'id_tipo_fuente' && $key != 'id_senal' ): ?>
					<p><strong><?= ucwords( $key ) ?>: </strong><?= $value ?></p>
		<?php endif; endforeach; ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            Secciones
	        </div>
	        <!-- /.panel-heading -->
	        <div class="panel-body">
	            <?php if( is_array( $sections ) ): ?>
	            <div class="table-responsive">
	                <table class="table table-striped">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Nombre</th>
	                            <th>Descripción</th>
	                            <th>Activa</th>
	                            <th>Acción</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach( $sections as $key => $section ): ?>
	                        <tr>
	                            <td><?= $key + 1 ?></td>
	                            <td><?= $section['nombre'] ?></td>
	                            <td><?= $section['descripcion'] ?></td>
	                            <td class="fa <?= $section['activo']['class'] ?>">
	                            </td>
	                            <td>
	                            	<?php if ( $section['activo']['activo'] ): ?>
	                            		<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" data-href="/panel/font/section/change-state?section=<?= $section['id_seccion'] ?>&action=desactivado" class="change-state">Desactivar</a>
	                            	<?php else: ?>
										<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" data-href="/panel/font/section/change-state?section=<?= $section['id_seccion'] ?>&action=activado" class="change-state">Activar</a>
									<?php endif; ?>	                            	
	                            </td>
	                        </tr>
	                    <?php endforeach; ?>
	                    </tbody>
	                </table>
	            </div>
	        	<?php else: ?>
	        	<p class="lead"><?= $sections ?></p>
	        	<?php endif; ?>
	            <!-- /.table-responsive -->
	        </div>
	        <!-- /.panel-body -->
	    </div>
	    <!-- /.panel -->
	</div>
</div>