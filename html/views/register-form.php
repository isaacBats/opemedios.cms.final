<div class="registro">        
		<div class="acerca-principal-quienes acerca-principal-quienes-form">
			<p><img alt="Registro" src="/assets/images/imgRegistro.jpg"></p>
		</div>		
		<div class="acerca-secundario-quienes acerca-secundario-quienes-form">
			<h2><?php echo $this->trans($lang, 'Registro<br>profesionistas','Register <br>to the trade') ?></h2>
			<p id="mensaje"></p>
			<form method="post" id="frmRegistro" name="form-registro" action="/<?php echo $lang ?>/register"> 
			    <div class="separador">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Nombre(s)','First name') ?>" name="nombre" id="Nombre">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Apellidos','Last name') ?>" name="apellidos" id="Apellidos">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Nombre de usuario','Username') ?>" name="nombreusuario" id="NombreUsuario">
			        <input type="password" value="" class="requerido" placeholder="<?php echo $this->trans($lang, 'Contraseña','Password') ?>" name="passworduno" id="passworduno">
			        <input type="password" value="" class="requerido" placeholder="<?php echo $this->trans($lang, 'Confirmar contraseña','Confirm password') ?>" name="passworddos" id="passworddos">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Correo electrónico','E-mail adress') ?>" name="email" id="Email" >
			    </div>
			    <div class="separador">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Empresa','Company') ?>" name="empresa" id="Empresa">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Puesto','Job title') ?>" name="puesto" id="Puesto">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Website empresa','Website company') ?>" name="website" id="Website">
			    </div>
			    <div class="separador">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Dirección','Address') ?>" name="direccion1" id="Direccion1">
			        <input type="text" class="requerido" value="" placeholder="<?php echo $this->trans($lang, 'Colonia','Region') ?>" name="direccion2" id="Direccion2">
			        <br>
			        <select name="pais">
					<option value=""><?php echo $this->trans($lang,'País','Country'); ?></option>
					<?php echo $countries;?>
				</select>
			        <br>
			        <input type="text" value="" placeholder="<?php echo $this->trans($lang, 'Estado / Municipio','State') ?>" name="estado" id="Estado" class="mediano2 requerido">
			        <input type="text" value="" placeholder="<?php echo $this->trans($lang, 'Código Postal','Zip code') ?>" name="codigopostal" id="CodigoPostal" class="mediano2">
			        <input type="text" value="" placeholder="<?php echo $this->trans($lang, 'Móvil','Mobile') ?>" name="movil" id="Movil" class="mediano2">
			        <input type="text" value="" placeholder="<?php echo $this->trans($lang, 'Teléfono','Phone') ?>" name="telefono" id="Telefono" class="mediano2">
			    </div>
			    <div class="separador">
			        <label>
			            <?php echo $this->trans($lang, 'Organización Profesional','Organization') ?></label>
			        <br>
			        <label>
			            <input type="checkbox" value="American Society of Interior Designers" name="organizacion[]" id="RegistroAsid">
			        ASID</label>
			        <label>
			            <input type="checkbox" value="American Institute of Architects" name="organizacion[]" id="RegistroAia">
			            AIA</label>
			        <label>
			            <input type="checkbox" value="IBD" name="organizacion[]" id="RegistroIbd">
			            IBD</label>
			        <br>
			        <select title="Motivo de afiliación" placeholder="<?php echo $this->trans($lang, 'Motivo de afiliación','Reason') ?>" name="motivo" id="Motivo">
				        <option value=""><?php echo $this->trans($lang, 'Motivo de afiliación','Reason') ?></option>
						<option value="Soy Decorador">Soy Decorador</option>
						<option value="Soy Arquitecto">Soy Arquitecto</option>
						<option value="Soy Especificador">Soy Especificador</option>
						<option value="Otro">Otro</option>
					</select>
			        <select title="¿Cómo se enteró de nosotros?" placeholder="<?php echo $this->trans($lang, '¿Cómo se enteró de nosotros?','How did you find us?') ?>" name="comoseentero" id="ComoSeEntero">
			        	<option value=""><?php echo $this->trans($lang, '¿Cómo se enteró de nosotros?','How did you find us?') ?></option>
						<option value="Revista">Revista</option>
						<option value="Diseñador">Diseñador</option>
						<option value="Arquitecto">Arquitecto</option>
						<option value="Correo Electrónico/Newsletter">Correo Electrónico/Newsletter</option>
						<option value="Sitio Web/Buscador">Sitio Web/Buscador</option>
						<option value="Blog">Blog</option>
						<option value="Redes Sociales">Redes Sociales</option>
						<option value="Conocido/Amigo">Conocido/Amigo</option>
						<option value="Periódico">Periódico</option>
						<option value="Representante de Ventas">Representante de Ventas</option>
						<option value="Cuenta Existente">Cuenta Existente</option>
					</select>
			        <br>
			    </div>
			    <div class="separador">
			        <label>
			            * Campos obligatorios</label>
			        <br>
			        <label>
			            <input type="checkbox" value="true" name="registroftk" id="RegistroFtk">
			            <?php echo $this->trans($lang, 'Registrarme a', 'Add me to the list') ?> <em>Be the First to know</em>
			        </label><br>
			        <label>
			            <input type="checkbox" value="true" name="registromailing" id="RegistroMailing">
			            <?php echo $this->trans($lang, 'Añadirme a la', 'Add mi to the') ?> <em><?php echo $this->trans($lang, 'Lista de correo','Email list') ?></em>
			        </label>
			        <br>
			    </div>
			    <div class="separador">
			        <a href="/terms" target="_blank"><?php echo $this->trans($lang, 'Leer términos y condiciones', 'Terms and conditions') ?></a>
			    </div>
			    <div class="separador">
			        <input id="btn-registro" type="submit" value="<?php echo $this->trans($lang , 'Enviar' , 'Send') ?>">
			    </div>
			</form>
		</div>
		<br class="clear">
</div>