<?= $this->flashAlerts('usuario'); ?>
<div class="row" id="user-detail">
	<div class="col-sm-12">
		<h1 class="page-header">
			<?= $user['nombre'] . ' ' . $user['apellidos'] ?>
			<button type="button" class="btn btn-success btn-lg pull-right" id="btn-edit-user">Editar</button>			
		</h1>
	</div>
	<!-- <div class="col-md-6">
		<img src="/<?php //echo $client['logo']  ?>" alt="<?php //echo $client['nombre'] ?>" width="320">
	</div> -->
	<div class="col-md-6">
		<?php foreach ($user as $key => $value): 
				if( $key != 'id_usuario' && $key != 'nombre' && $key != 'id_tipo_usuario' && $key != 'activo' && $key != 'apellidos' && $key != 'password' ): ?>
					<p><strong><?= ucwords( $key ) ?>: </strong><?= $value ?></p>
		<?php endif; endforeach; ?>
		<p><strong><?= ($user['activo'] == TRUE ) ? 'Usuario Activo' : 'Usuario Inactivo' ?></strong></p>
	</div>
</div>
<div class="row" id="user-edit" style="display: none;">
	<div class="panel panel-default">
		<div class="panel-heading">
			Editar a <?= $user['nombre'] . ' ' . $user['apellidos'] ?>
		</div>
		<div class="panel-body">
			<form action="/panel/user/edit/<?= $user['id_usuario']?>" id="form-edit-user" class="form-horizontal" method="post" >
				<div class="col-sm-6">
					<p>Datos personales: </p>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Nombre *</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Juan" class="form-control" name="nombre" required="required" value="<?= $user['nombre'] ?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Apellidos*</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Perez" class="form-control col-sm-8" name="apellidos" required="required" value="<?= $user['apellidos'] ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Correo *</label>
						<div class="col-sm-8">
							<input type="email" placeholder="juan@opemedios.com.mx" class="form-control col-sm-8" name="correo" required="required" value="<?= $user['email'] ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tel. Casa *</label>
						<div class="col-sm-8">
							<input type="tel" placeholder="5545768789" maxlength="12" minlength="8" class="form-control col-sm-8" name="tel_casa" required="required" value="<?= $user['telefono1'] ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Celular</label>
						<div class="col-sm-8">
							<input type="tel" placeholder="0445567890485" maxlength="15" minlength="10" class="form-control col-sm-8" name="celular" value="<?= $user['telefono2'] ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Dirección</label>
						<div class="col-sm-8">
							<textarea class="form-control" name="direccion" rows="6" ><?= $user['direccion'] ?></textarea>					
						</div>
					</div>			
				</div>
				<div class="col-sm-6">
					<p>Datos laborales: </p>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tipo *</label>
						<div class="col-sm-8">
							<select name="tipo_usuario" class="form-control" required="required">
								<option>Tipo usuario</option>
								<?php foreach( $tipoUsuarios as $userType ): ?>
									<?php if ( $user['id_tipo_usuario'] === $userType['id_tipo_usuario']): ?>
										<option value="<?= $userType['id_tipo_usuario'] ?>" selected >
											<?= $userType['descripcion'] ?>
										</option>
									<?php else: ?>
										<option value="<?= $userType['id_tipo_usuario'] ?>" >
											<?= $userType['descripcion'] ?>
										</option>									
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Cargo</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Encargado de Internet" class="form-control col-sm-8" name="cargo" value="<?= $user['cargo'] ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Comentarios</label>
						<div class="col-sm-8">
							<textarea class="form-control" name="comentarios" rows="6" ><?= $user['comentario'] ?></textarea>
						</div>
					</div>
					<p>Datos de sistema: </p>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Username*</label>
						<div class="col-sm-8">
							<input placeholder="juan1234" class="form-control col-sm-8" name="username" required="required" value="<?= $user['username'] ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Password </label>
						<div class="col-sm-8">
							<input type="password" class="form-control col-sm-8" name="password" >
						</div>
					</div>
					<div class="checkbox">
						<label>
							<?php if ( $user['activo'] == TRUE ): ?>
								<input type="checkbox" name="activo" checked /> Activo 
							<?php else: ?>
								<input type="checkbox" name="activo" /> Activo 								
							<?php endif ?>
						</label>
					</div>
				</div>
				<input type="submit" value="Guardar" class="btn btn-success pull-right" />
			</form>			
		</div>
	</div>
</div>