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
<!-- Formulario para agregar un tema -->
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
						placeholder="Ejem.: Recursos Ambientales" 
						required="required" 
						data-rule-required="true" 
						data-msg="Introduce el nombre del tema" />	
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Descripción</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="descripcion" rows="6" required="required" data-rule-required="true" data-msg="Agrega una texto que describa el tema"></textarea>					
				</div>
			</div>
			<button class="btn btn-primary pull-right">Crear</button>
			<button class="btn btn-warning pull-right cancelar" type="button" style="margin: 0 10px 0 0;">Cancelar</button>
		</form>
		<div class="col-sm-3 plus-secction"></div>
	</div>
</div>
<!-- /Formulario para agregar un tema -->
<!-- Formulario para relaciona una cuenta a la empresa y tema-->
<div class="row">
	<div class="col-sm-12 form-r_cuenta-tema">
		<div class="col-sm-3 plus-tema"></div>
		<form action="/panel/client/theme-acount" method="post" class="form-horizontal col-sm-6" id="form-agrega-tema-cuenta">
			<input type="hidden" value="<?= $id ?>" name="empresaId">
			<div class="form-group">
				<label class="col-sm-3 control-label">Tema</label>
				<div class="col-sm-8">
					<select name='tema' required="required" class="form-control">
						<option value="">Selecciona un tema</option>
						<?php foreach ($thems as $them): ?>
						<option value="<?= $them['id_tema'] ?>"><?= $them['nombre'] ?></option>
						<?php endforeach; ?>
					</select>		
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Cuenta</label>
				<div class="col-sm-8">
					<select name="cuenta" required="required" class="form-control">
						<option>Selecciona una cuenta</option>
						<?php if( is_array( $counts ) && sizeof( $counts ) > 0 ): 
								foreach ($counts as $count): ?>
									<option value="<?= $count['id_cuenta'] ?>"><?= $count['nombre'] . ' ' . $count['apellidos'] ?></option>
						<?php 	endforeach; 
							  endif; ?>
					</select>
				</div>
			</div>
			<button class="btn btn-primary pull-right">Relacionar</button>
			<button class="btn btn-warning pull-right" id="cancelar-tema-cuenta" type="button" style="margin: 0 10px 0 0;">Cancelar</button>
		</form>
		<div class="col-sm-3 plus-secction"></div>		
	</div>
</div>
<!-- /Formulario para relaciona una cuenta a la empresa y tema-->
<!-- Temas -->
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
	                        <li>
	                        	<a href="javascript:void(0);" id="agrega-cuenta-TemaAction">
	                        		Relacionar cuenta
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
		                            			<a class="btn-view-contacts d-info" id="<?= $key + 1 ?>" data-id="<?= $key + 1 ?>" href="javascript:void(0)"><i class="p5 fa fa-group" style="font-size: 1.3em;"></i></a>
		                            		</li>
		                            	</ul>	                            	
		                            </td>
		                        </tr>
		                        <?php if( isset( $theme['contacts'] ) ): ?>
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
		                    <?php endif; ?>
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
<!-- /Temas -->
<!-- Cuentas -->
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            Cuentas 
	            <div class="pull-right">
	                <div class="btn-group">
	                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
	                        Acciones
	                        <span class="caret"></span>
	                    </button>
	                    <ul class="dropdown-menu pull-right" role="menu">
	                        <li>
	                        	<a href="javascript:void(0);" id="agregarCuentaAction">
	                        		Agregar nueva cuenta
	                        	</a>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <div class="panel-body">
	            <?php if( sizeof( $counts ) > 0 ): ?>
	            <div class="table-responsive">
	                <table class="table table-striped">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Nombre</th>
	                            <th>Cargo</th>
	                            <th>Correo</th>
	                            <th>Activo</th>
	                            <!-- <th>Acción</th> -->
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php // TODO: @DetailclientView Desarrollar las acciones para una cuenta (Editar, ver, eliminar, desactivar). ?>
	                    	<?php foreach ($counts as $number => $userData): ?>
                        		<tr>
                        			<td><?= $number + 1 ?></td>
                        			<td><?= $userData['nombre'] . ' ' . $userData['apellidos'] ?></td>
                        			<td><?= $userData['cargo'] ?></td>
                        			<td><?= $userData['email'] ?></td>
                        			<td class="fa <?= ( $userData['activo'] ) ? 'fa-check-circle green' : 'fa-times-circle red' ?>" ></td>
                        			<!-- <td class="menu-actions-icon">
		                            	<ul>
		                            		<li>
		                            			<a class="d-success" href="javascript:void(0)"><i class="p5 fa fa-eye" style="font-size: 1.3em;"></i></a>
		                            		</li>
		                            		<li>
		                            			<a class="d-info" href="javascript:void(0)"><i class="p5 fa fa-pencil" style="font-size: 1.3em;"></i></a>
		                            		</li>
		                            		<li>
		                            			<a class="d-warning" href="javascript:void(0)"><i class="p5 fa fa-trash-o" style="font-size: 1.3em;"></i></a>
		                            		</li>
		                            		<li>
		                            			<a href="javascript:void(0)">Desactivar</a>
		                            		</li>
		                            	</ul>	                            	
		                            </td> -->
                        		</tr>
			                <?php endforeach; ?>
	                    </tbody>
	                </table>
	            </div>
	        	<?php endif; ?>
	            <!-- /.table-responsive -->
	        </div>
	        <!-- /.panel-body -->
	    </div>
	</div>
</div>
<!-- /Cuentas -->
<!-- Formulario para crear una cuenta  -->
<div class="row">
	<div class="panel panel-default form-agregar-cuenta" style="display: none">
		<div class="panel-heading">
			Crear nueva cuenta para <?= $client['nombre'] ?>
		</div>
		<div class="panel-body">
			<form action="/panel/client/cuenta/add" method="post" class="form-horizontal col-sm-12" id="form-agrega-cuenta">
				<input type="hidden" value="<?= $id ?>" name="empresaId">
				<div class="col-sm-6">
					<p>Datos personales: </p>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Nombre*</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Juan" class="form-control" name="nombre" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Apellidos*</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Perez" class="form-control col-sm-8" name="apellidos" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Correo*</label>
						<div class="col-sm-8">
							<input type="email" placeholder="juan@opemedios.com.mx" class="form-control col-sm-8" name="correo" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tel. Casa*</label>
						<div class="col-sm-8">
							<input type="tel" placeholder="5545768789" maxlength="12" minlength="8" class="form-control col-sm-8" name="tel_casa" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Celular</label>
						<div class="col-sm-8">
							<input type="tel" placeholder="0445567890485" maxlength="15" minlength="10" class="form-control col-sm-8" name="celular" />
						</div>
					</div>			
				</div>
				<div class="col-sm-6">
					<p>Datos laborales: </p>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Cargo</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Encargado de Internet" class="form-control col-sm-8" name="cargo" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Comentarios</label>
						<div class="col-sm-8">
							<textarea class="form-control" name="comentarios" rows="6" ></textarea>
						</div>
					</div>
					<p>Datos de sistema: </p>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Username*</label>
						<div class="col-sm-8">
							<input placeholder="juan1234" class="form-control col-sm-8" name="username" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Password*</label>
						<div class="col-sm-8">
							<input type="password" class="form-control col-sm-8" name="password" required="required" />
						</div>
					</div>
				</div>
				<input type="submit" value="Guardar" class="btn btn-success pull-right" />
				<input type="button" value="Cancelar" class="btn btn-danger pull-right" id="cancela-nueva-cuenta" style="margin-right: 2.5em;" />
			</form>			
		</div>
	</div>
</div>
<!-- /Formulario para crear una cuenta  -->
