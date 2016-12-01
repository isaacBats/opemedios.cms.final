<div class="row" id="user-create">
	<form action="/panel/user/add" id="form-add-user" class="form-horizontal" autocomplete="off" method="POST">
		<div class="col-sm-6">
			<p>Datos personales: </p>
			<hr>
			<div class="form-group">
				<label class="col-sm-2 control-label">Nombre*</label>
				<div class="col-sm-8">
					<input type="text" placeholder="Juan" class="form-control" name="nombre" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Apellidos*</label>
				<div class="col-sm-8">
					<input type="text" placeholder="Perez" class="form-control col-sm-8" name="apellidos" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Correo*</label>
				<div class="col-sm-8">
					<input type="email" placeholder="juan@opemedios.com.mx" class="form-control col-sm-8" name="correo" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Tel. Casa*</label>
				<div class="col-sm-8">
					<input type="tel" placeholder="5545768789" maxlength="12" minlength="8" class="form-control col-sm-8" name="tel_casa" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Celular</label>
				<div class="col-sm-8">
					<input type="tel" placeholder="0445567890485" maxlength="15" minlength="10" class="form-control col-sm-8" name="celular" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Dirección</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="direccion" rows="6" ></textarea>					
				</div>
			</div>			
		</div>
		<div class="col-sm-6">
			<p>Datos laborales: </p>
			<hr>
			<div class="form-group">
				<label class="col-sm-2 control-label">Tipo*</label>
				<div class="col-sm-8">
					<select name="tipo_usuario" class="form-control" required="required">
						<option>Tipo usuario</option>
						<?php foreach( $tipoUsuarios as $userType ): ?>
							<option value="<?= $userType['id_tipo_usuario'] ?>" >
								<?= $userType['descripcion'] ?>
							</option>									
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Cargo</label>
				<div class="col-sm-8">
					<input type="text" placeholder="Encargado de Internet" class="form-control col-sm-8" name="cargo">
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
					<input placeholder="juan1234" class="form-control col-sm-8" name="username" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Password*</label>
				<div class="col-sm-8">
					<input type="password" class="form-control col-sm-8" name="password" required="required" >
				</div>
			</div>
			<!-- <div class="checkbox">
				<label>
					<input type="checkbox" name="activo" > Activo 
				</label>
			</div> -->
			<input type="submit" value="Crear" class="btn btn-primary btn-lg pull-right" />
		</div>
	</form>		
</div>