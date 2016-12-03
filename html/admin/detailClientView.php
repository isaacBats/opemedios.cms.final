<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header"><?= $client['nombre'] ?></h1>
	</div>
	<div class="col-md-6">
		<img src="/<?= $client['logo']  ?>" alt="<?= $client['nombre'] ?>" width="320">
	</div>
	<div class="col-md-6">
		<?php foreach ($client as $key => $value): 
				if( $key != 'id_empresa' && $key != 'nombre' && $key != 'logo' && $key != 'color_fondo' && $key != 'color_letra' && $key != 'fecha_registro' ): ?>
					<p><strong><?= ucwords( $key ) ?>: </strong><?= $value ?></p>
		<?php endif; endforeach; ?>
	</div>
</div>
<!-- Formulario para agregar una seccion -->
<div class="row">
	<div class="col-sm-12 form-agregar-tema" style="display: none">
		<div class="col-sm-3 plus-tema"></div>
		<form action="/panel/client/tema/add" method="post" class="form-horizontal col-sm-6" id="form-agrega-tema">
			<input type="hidden" value="<?= $id ?>" name="empresaId">
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
			<button class="btn btn-warning pull-right cancelar" type="button" style="margin: 0 10px 0 0;">Cancelar</button>
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
	            Temas relacionados
	            <div class="pull-right">
	                <div class="btn-group">
	                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
	                        Acciones
	                        <span class="caret"></span>
	                    </button>
	                    <ul class="dropdown-menu pull-right" role="menu">
	                        <li>
	                        	<a href="javascript:void(0);" id="agregarTemaAction">
	                        		Agregar nuevo tema
	                        	</a>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <div class="panel-body">
	            <?php if( is_array( $thems ) ): ?>
	            <div class="table-responsive">
	                <table class="table table-striped">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Nombre</th>
	                            <th>Descripción</th>
	                            <th>Acción</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach( $thems as $key => $theme ): ?>
	                        <tr>
	                            <td><?= $key + 1 ?></td>
	                            <td><?= $theme['nombre'] ?></td>
	                            <td><?= $theme['descripcion'] ?></td>
	                            <td class="menu-actions-icon">
	                            	<ul>
	                            		<li>
	                            			<a class="d-success" href="javascript:void(0)"><i class="p5 fa fa-eye" style="font-size: 1.3em;"></i></a>
	                            		</li>
	                            		<li>
	                            			<a class="d-warning" href="javascript:void(0)"><i class="p5 fa fa-trash-o" style="font-size: 1.3em;"></i></a>
	                            		</li>
	                            		<li>
	                            			<a class="d-info btn-view-contacts" id="<?= $key + 1 ?>" data-id="<?= $key + 1 ?>" href="javascript:void(0)"><i class="p5 fa fa-group" style="font-size: 1.3em;"></i></a>
	                            		</li>
	                            	</ul>	                            	
	                            </td>
	                        </tr>
	                        <tr style="display: none"  id="table<?= $key + 1 ?>">
	                            <!-- Tabla para los contactos -->
	                           	<td></td>
	                           	<td colspan="2">
		                            <table class="table table-striped table-bordered table-hover">
		                            	<thead>
		                            		<th>#</th>
		                            		<th>Nombre</th>
		                            		<th>Cargo</th>
		                            		<th>Correo</th>
		                            	</thead>
		                            	<tbody>
		                            		<?php foreach ($theme['contacts'] as $num => $user): ?>
			                            		<tr>
			                            			<td><?= $num + 1 ?></td>
			                            			<td><?= $user['nombre'] . ' ' . $user['apellidos'] ?></td>
			                            			<td><?= $user['cargo'] ?></td>
			                            			<td><?= $user['email'] ?></td>
			                            		</tr>
		                            		<?php endforeach ?>
		                            	</tbody>
		                            </table>
		                        </td>
		                        <!-- /Fin de la tabla de los contactos -->
	                        </tr>
	                    <?php endforeach; ?>
	                    </tbody>
	                </table>
	            </div>
	        	<?php else: ?>
	        	<p class="lead"><?= $thems ?></p>
	        	<?php endif; ?>
	            <!-- /.table-responsive -->
	        </div>
	        <!-- /.panel-body -->
	    </div>
	</div>
</div>
<!-- /Secciones -->
