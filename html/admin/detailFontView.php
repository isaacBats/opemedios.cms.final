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
<!-- Formulario para agregar una seccion -->
<div class="row">
	<div class="col-sm-12 form-agregar-seccion">
		<div class="col-sm-3 plus-secction"></div>
		<form action="/panel/font/section/add" method="post" class="form-horizontal col-sm-6" >
			<input type="hidden" value="<?= $fontId ?>" name="fuenteId">
			<div class="form-group">
				<label class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
					<input 
						class="form-control" 
						name="nombre"  
						autocomplete="off" 
						placeholder="Ejem.: Entretenimiento" 
						required="required" 
						data-rule-required="true" 
						data-msg="Introduce el nombre de la sección" />	
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Descripción</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="decripcion" rows="6" required></textarea>					
				</div>
			</div>
			<button class="btn btn-primary pull-right">Crear</button>
			<button class="btn btn-warning pull-right" type="button" style="margin: 0 10px 0 0;">Cancelar</button>
		</form>
		<div class="col-sm-3 plus-secction"></div>
	</div>
</div>
<!-- /Formulario para agregar una seccion -->
<!-- Secciones -->
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            Secciones
	            <div class="pull-right">
	                <div class="btn-group">
	                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
	                        Acciones
	                        <span class="caret"></span>
	                    </button>
	                    <ul class="dropdown-menu pull-right" role="menu">
	                        <li>
	                        	<a href="javascript:void(0);" id="agregarSeccionAction">
	                        		Agregar Seccion
	                        	</a>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
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
	</div>
</div>
<!-- /Secciones -->
