<?= $this->flashAlerts('empresa'); ?>
<div class="row spacer-30" id="datos-cliente">
	<div class="col-sm-12">
		<h1 class="page-header"><?= $client['nombre'] ?></h1>
		<div class="col-sm-offset-11">
			<button class="btn btn-success btn-lg" style="margin-top: -120px;">Editar</button>
		</div>
	</div>
	<div class="col-md-6" id="logo-cliente">
		<img src="/<?= $client['logo']  ?>" alt="<?= $client['nombre'] ?>" class="logo-company">
		<a href="javascript:void(0);" class="col-sm-12" id="cambiar-imagen-cliente">Cambiar Imagen</a>
	</div>
	<div class="col-md-6" id="cambiar-logo-action" style="display: none">
		<form action="/panel/client/logo/edit" method="post" id="form-cambia-imagen" enctype="multipart/form-data">
			<input type="hidden" value="<?= $id ?>" name="empresaId">
			<div class="col-sm-6">
	            <div class="input-group">
	                <label class="input-group-btn">
	                    <span class="btn btn-primary">
	                        Buscar <input name="empresa-logo" type="file" style="display: none;" required="required"/>
	                    </span>
	                </label>
	                <input type="text" class="form-control" readonly>
	            </div>
	            <span class="help-block">
	                Selecciona la imagen que desees que quede en representación del cliente
	            </span>
	        </div>
	        <div class="col-sm-6">
	        	<input type="submit" value="Cambiar" class="btn btn-primary">
	        	<input type="button" value="Cancelar" class="btn btn-warning" id="cancelar-guarda-logo">
	        </div>
		</form>
	</div>
	<div class="col-md-6">
		<?php foreach ($client as $key => $value): 
				if( $key != 'id_empresa' && $key != 'nombre' && $key != 'logo' && $key != 'color_fondo' && $key != 'color_letra' && $key != 'fecha_registro' ): ?>
					<p><strong><?= ucwords( $key ) ?>: </strong><?= $value ?></p>
		<?php endif; endforeach; ?>
	</div>
</div>
<!-- Editar cliente -->
<div class="row" id="edita-datos-cliente" style="display: none;">
	<div class="panel panel-default">
		<div class="panel-heading"> Editar <?= $client['nombre'] ?></div>
		<div class="panel-body">
			<form action="/panel/client/edit/<?= $client['id_empresa'] ?>" method="post" id="form-edita-cliente">
				<div class="form-group col-sm-6">
					<label>Nombre</label>
					<input class="form-control" name=":nombre" required="required" value="<?= $client['nombre'] ?>" />	
				</div>
				<div class="form-group col-sm-6">
					<label>Direccion</label>
					<input class="form-control" name=":direccion" value="<?= $client['direccion'] ?>" />	
				</div>
				<div class="form-group col-sm-3">
					<label>Telefono</label>
					<input class="form-control" name=":telefono" required="required" value="<?= $client['telefono'] ?>" />	
				</div>
				<div class="form-group col-sm-3">
					<label>Contacto</label>
					<input class="form-control" name=":contacto" required="required" value="<?= $client['contacto'] ?>" />	
				</div>
				<div class="form-group col-sm-3">
					<label>Correo</label>
					<input class="form-control" name=":email" required="required" value="<?= $client['email'] ?>" />	
				</div>
				<div class="form-group col-sm-3">
					<label>Giro</label>
					<input class="form-control" name=":giro" value="<?= $client['giro'] ?>" />	
				</div>
				<input type="hidden" name=":id_empresa" value="<?= $client['id_empresa'] ?>">
				<div class="col-sm-offset-10">
					<button class="btn btn-warning" type="button" id="calcela-editar-datos">Cancelar</button>					
					<button class="btn btn-primary">Guardar</button>					
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Editar cliente -->
<!-- Formulario para agregar un tema -->
<div class="row">
	<div class="col-sm-12 form-agregar-tema" style="display: none">
		<div class="panel panel-default">
			<div class="panel-heading">
				Agrega un nuevo tema
			</div>
			<div class="panel-body">
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
	</div>
</div>
<!-- /Formulario para agregar un tema -->
<!-- Formulario para relaciona una cuenta a la empresa y tema-->
<div class="row">
	<div class="col-sm-12 form-r_cuenta-tema" style="display: none;">
		<div class="panel panel-default">
			<div class="panel-heading">
				Relaciona un tema con una cuenta
			</div>
			<div class="panel-body">
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
	                <table class="table">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Nombre</th>
	                            <th>Descripción</th>
	                            <th>Acción</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach( $thems as $key => $theme ):?>
		                        <tr>
		                            <td><?= $key + 1 ?></td>
		                            <td><?= $theme['nombre'] ?></td>
		                            <td><?= $theme['descripcion'] ?></td>
		                            <td class="w-200">
		                            			<a class="btn-show-related-theme" 
		                            			data-name="<?=$theme['nombre']?>" 
		                            			data-desc="<?=$theme['descripcion']?>" 
		                            			href="javascript:void(0)">
		                            			<i class="action-btn p5 fa fa-eye"></i></a>
		                            			<a class="btn-rm-related-theme" href="javascript:void(0)" 
												 data-url="/panel/client/cuenta/rm-theme?themeId=<?=$theme['id_tema']?>">
		                            			<i class="action-btn p5 fa fa-trash-o"></i></a>
		                            			<a class="btn-view-contacts" id="<?= $key + 1 ?>" data-id="<?= $key + 1 ?>" href="javascript:void(0)"><i class="action-btn p5 fa fa-group"></i></a>
		                            			<a class="btn-edit-theme" data-id="<?= $key + 1 ?>" href="javascript:void(0)">
		                            			<i class="action-btn p5 fa fa-pencil"></i></a>
												<a class="btn-edit-subtheme" data-id="<?= $key + 1 ?>" href="javascript:void(0)">
		                            			<i class="action-btn p5 fa fa-level-down"></i></a>
		                            		</li>
		                            	</ul>	
																
		                            </td>
		                        </tr>
								<?php
								include "conexion.php"; 
								//print "select * from subtema where id_tema=".$theme['id_tema']."<br>";
								$sql = mysqli_query($conexion,"select * from subtema where id_tema=".$theme['id_tema']."");	
								while ($row = mysqli_fetch_array($sql))
								{				
									//print "sdf:".$row['nombre']."<br>";	
									?>
									<tr>
		                            <td><??></td>
		                            <td><?print $row['nombre']; ?></td>
		                            <td><?print $row['descripcion']; ?></td>
		                            <!--<td class="w-200">
		                            			<a class="btn-show-related-theme" 
		                            			data-name="<?$theme['nombre']?>" 
		                            			data-desc="<?=$theme['descripcion']?>" 
		                            			href="javascript:void(0)">
		                            			<i class="action-btn p5 fa fa-eye"></i></a>
		                            			<a class="btn-rm-related-theme" href="javascript:void(0)" 
												 data-url="/panel/client/cuenta/rm-theme?themeId=<??>">
		                            			<i class="action-btn p5 fa fa-trash-o"></i></a>
		                            			<a class="btn-view-contacts" id="<?= $key + 1 ?>" data-id="<?= $key + 1 ?>" href="javascript:void(0)"><i class="action-btn p5 fa fa-group"></i></a>
		                            			<a class="btn-edit-theme" data-id="<?= $key + 1 ?>" href="javascript:void(0)">
		                            			<i class="action-btn p5 fa fa-pencil"></i></a>
												<a class="btn-edit-subtheme" data-id="<?= $key + 1 ?>" href="javascript:void(0)">
		                            			<i class="action-btn p5 fa fa-level-down"></i></a>
		                            		</li>
		                            	</ul>																
		                            </td>-->
									</tr>
									<?php
								}
								mysqli_free_result($sql); 
								mysqli_close ($conexion);
								?>		
								
		                        <tr style="display: none"  id="trEditTheme<?= $key + 1 ?>">
		                        	<td></td>
		                           	<td colspan="2">
		                           		<form action="/panel/client/tema/edit" method="post" class="form-horizontal col-sm-6 pd-20"  id="editTopic<?= $key + 1 ?>">
		                           			<input type="hidden" value="<?=$theme['id_tema']?>" name="id_tema">
											<div class="form-group">
												<label>Nombre Tema</label>
												<input value="<?=$theme['nombre']?>"  required="required" class="form-control" name="nombre">
											</div>
											<div class="form-group">
												<label>Descripción</label>
												<textarea rows="5" required="required" class="form-control" name="descripcion"><?=$theme['descripcion']?></textarea> 	
											</div>
											<button class="btn btn-primary pull-right sendEditTheme" data-id="<?= $key + 1 ?>">Guardar</button>
											<button class="btn btn-warning pull-right cancelEditTheme" data-id="<?= $key + 1 ?>" type="button" style="margin: 0 10px 0 0;">Cancelar</button>
										</form>
		                           	</td>
		                           	<td></td>
		                        </tr>
								<!--Nuevo subtema-->
								<tr style="display: none"  id="trEditsubTheme<?= $key + 1 ?>">
		                        	<td></td>
		                           	<td colspan="2">
		                           		<form action="/panel/client/tema/edit" method="post" class="form-horizontal col-sm-6 pd-20"  id="editTopic<?= $key + 1 ?>">
		                           			<input type="hidden" value="<?=$theme['id_tema']?>" name="id_tema">
											<div class="form-group">
												<label>Nombre Subtema</label>
												<input value="<?=$theme['nombre']?>"  required="required" class="form-control" name="nombre">
											</div>
											<div class="form-group">
												<label>Descripción</label>
												<textarea rows="5" required="required" class="form-control" name="descripcion"><?=$theme['descripcion']?></textarea> 	
											</div>
											<button class="btn btn-primary pull-right sendEditsubTheme" data-id="<?= $key + 1 ?>">Guardar</button>
											<button class="btn btn-warning pull-right cancelEditsubTheme" data-id="<?= $key + 1 ?>" type="button" style="margin: 0 10px 0 0;">Cancelar</button>
										</form>
		                           	</td>
		                           	<td></td>
		                        </tr>
		                        <?php if( isset( $theme['contacts'] ) ): ?>
		                        <tr style="display: none"  id="table<?= $key + 1 ?>">
		                            <!-- Tabla para los contactos -->
		                           	<td></td>
		                           	<td colspan="2">
			                            <table class="table table-striped table-bordered table-hover pd-20">
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
			                        <td></td>
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
<div class="aalert"></div>
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
	                            <th style="text-align: center">Acción</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php // TODO: @DetailclientView Desarrollar las acciones para una cuenta (Editar, ver, eliminar). ?>
	                    	<?php foreach ($counts as $number => $userData): ?>
                        		<tr>
                        			<td><?= $number + 1 ?></td>
                        			<td><?= $userData['nombre'] . ' ' . $userData['apellidos'] ?></td>
                        			<td><?= $userData['cargo'] ?></td>
                        			<td><?= $userData['email'] ?></td>
                        			<td class="fa <?= ( $userData['activo'] ) ? 'fa-check-circle green' : 'fa-times-circle red' ?>" ></td>
                        			<td class="menu-actions-icon" style="text-align: center">
		                            	<ul>
		                            		<li>
		                            			<a class="d-info edit-acount" data-id="<?= $userData['id_cuenta'] ?>" href="javascript:void(0)"><i class="p5 fa fa-pencil" style="font-size: 1.3em;"></i></a>
		                            		</li>
		                            		<li>
		                            			<a class="d-warning rm-account-from-company" 
		                            			href="javascript:void(0)" data-href="/panel/client/cuenta/rm-account?acount=<?= $userData['id_cuenta'] ?>"
		                            			><i class="p5 fa fa-trash-o" style="font-size: 1.3em;"></i></a>
		                            		</li>
		                            		<li>
		                            			<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" data-href="/panel/client/cuenta/change-state?acount=<?= $userData['id_cuenta'] ?>&action=<?= ($userData['activo']) ? 'desactivado' : 'activado' ?>" class="change-state-acount"><?= ($userData['activo']) ? 'Desactivar' : 'Activar'?></a>
		                            		</li>
		                            	</ul>	                            	
		                            </td>
                        		</tr>
			                <?php endforeach; ?>
	                    </tbody>
	                </table>
	            </div>
	        	<?php else: ?>
	        	<p class="lead">No hay cuentas relacionadas con este cliente</p>
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
							<input type="text" placeholder="Juan" class="form-control" name="nombre" id="nombre" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Apellidos*</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Perez" class="form-control col-sm-8" name="apellidos" id="apellidos" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Correo*</label>
						<div class="col-sm-8">
							<input type="email" placeholder="juan@opemedios.com.mx" class="form-control col-sm-8" name="correo" id="correo" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tel. Casa*</label>
						<div class="col-sm-8">
							<input type="tel" placeholder="5545768789" maxlength="12" minlength="8" class="form-control col-sm-8" name="tel_casa" id="tel_casa" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Celular</label>
						<div class="col-sm-8">
							<input type="tel" placeholder="0445567890485" maxlength="15" minlength="10" class="form-control col-sm-8" name="celular" id="celular" />
						</div>
					</div>			
				</div>
				<div class="col-sm-6">
					<p>Datos laborales: </p>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Cargo</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Encargado de Internet" class="form-control col-sm-8" name="cargo" id="cargo" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Comentarios</label>
						<div class="col-sm-8">
							<textarea class="form-control" name="comentarios" id="comentarios" rows="6" ></textarea>
						</div>
					</div>
					<p>Datos de sistema: </p>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Username*</label>
						<div class="col-sm-8">
							<input placeholder="juan1234" class="form-control col-sm-8" name="username" id="username" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Password*</label>
						<div class="col-sm-8">
							<input type="password" class="form-control col-sm-8" name="password" id="password" required="required" />
						</div>
					</div>
				</div>
				<input type="submit" value="Guardar" class="btn btn-success pull-right" id="acount-confirmation" />
				<input type="button" value="Cancelar" class="btn btn-danger pull-right" id="cancela-nueva-cuenta" style="margin-right: 2.5em;" />
			</form>			
		</div>
	</div>
</div>
<!-- /Formulario para crear una cuenta  -->
