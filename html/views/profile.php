<div class="registro">        
			<div class="acerca-principal-quienes acerca-principal-quienes-form">
				<h2><?= $user['nombre'].' '.$user['apellidos'] ?></h2>
				<ul>
					<li><a href="#">Estado de Cuenta</a></li>
					<li><a href="#">Lista de precios</a></li>
					<li><a href="#">Descargar Catálogo</a></li>
					<li><a href="#">Mis Cotizaciones</a></li>
					<li><a href="#">Mi Perfil</a></li>
				</ul>
			</div>		
			<div class="acerca-secundario-quienes acerca-secundario-quienes-form">
				<p id="mensaje"></p>
				<form method="post" id="frmRegistro" name="form-registro" action="/update">	
				    <div class="separador">
				        <label><?php echo $this->trans($lang, "Nombre(s):","First Name:") ?></label><input type="text" class="requerido" value="<?= $user['nombre'] ?>" name="nombre" id="Nombre">
				        <label><?php echo $this->trans($lang, "Apellidos:","Last Name") ?></label><input type="text" class="requerido" value="<?= $user['apellidos'] ?>" name="apellidos" id="Apellidos">
				        </div>
				    <div class="separador">
				        <label><?php echo $this->trans($lang, "Empresa:","Company") ?></label><input type="text" class="requerido" value="<?= $user['empresa'] ?>" name="empresa" id="Empresa">
				        <label><?php echo $this->trans($lang, "Puesto:","Job title") ?></label><input type="text" class="requerido" value="<?= $user['puesto'] ?>" name="puesto" id="Puesto">
				        <label><?php echo $this->trans($lang, "Website Empresa:","Website company") ?></label><input type="text" class="requerido" value="<?= $user['website'] ?>"  name="website" id="Website">
				    </div>
				    <div class="separador">
				        <label><?php echo $this->trans($lang, "Dirección","Address") ?></label><input type="text" class="requerido" value="<?= $user['direccion1']?>" name="direccion1" id="Direccion1">
				        <label><?php echo $this->trans($lang, "Colonia:","Region") ?></label><input type="text" class="requerido" value="<?= $user['direccion2']?>" name="direccion2" id="Direccion2">
				        <br>
				        <label><?php echo $this->trans($lang, "País:","Country") ?></label>
				        <select title="País" name="pais" id="Pais">
					        <option value="">País</option>
					        <?php echo $country ?>
							<option value="Mexico">Mexico</option>
							<option value="Spain">Spain</option>
						</select>
				        <br>
				        <label><?php echo $this->trans($lang, "Estado / Municipio: ","State: ") ?></label><input type="text" value="<?= $user['estado']?>" name="estado" id="Estado" class="mediano2 requerido">
				        <label><?php echo $this->trans($lang, "Código Postal: ","Zip code: ") ?></label><input type="text" value="<?= $user['codigopostal']?>" name="codigopostal" id="CodigoPostal" class="mediano2">
				        <label><?php echo $this->trans($lang, "Mobil: ","Mobile: ") ?></label><input type="text" value="<?= $user['movil']?>" name="movil" id="Movil" class="mediano2">
				        <label><?php echo $this->trans($lang, "Teléfono: ","Phone: ") ?></label><input type="text" value="<?= $user['telefono']?>" name="telefono" id="Telefono" class="mediano2">
				    </div>
				    <div class="separador">
				        <input id="btn-registro" type="submit" value="<?php echo $this->trans($lang , "Actualizar mi perfil" , "Update profile") ?>">
				    </div>
				</form>
			</div>
			<br class="clear">
</div>