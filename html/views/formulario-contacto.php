<div class="contact-info">
	<img src="/assets/images/contacto.jpg">
	<div class="info alt">
		<img class="mexico" src="/assets/images/mapa.jpg">
		<img class="headquarters" src="/assets/images/headquarters.png">
		<img class="highPoint" src="/assets/images/highpoint.png">
	</div><!-- .info -->
	<div class="info mexico">
		<h2>Showroom México</h2>
		<p>Bosques de Duraznos 187 local 33,<br>
			Col. Bosques de las Lomas,<br>
			Del. Miguel Hidalgo<br>
			México, D.F., 11700<br>
			(+52) 55 5596-8364
		</p>
		<a href="mailto:centroam@alfonsomarinaebanista.com?subject=Contácto">centroam@alfonsomarinaebanista.com</a>
		<a href="https://maps.google.com/maps?q=19.407274,-99.239815&num=1&t=m&z=17" target="_blank" class=""><i class="fa fa-plus-square-o fa-lg"></i> Ver mapa</a>
		<select class="falta">
			<option data-geo-lat=\'19.407274\' data-geo-long=\'-99.239815\' mapaUb="https://maps.google.com/maps?q=19.407274,-99.239815&amp;num=1&amp;t=m&amp;z=17" value="Showroom México">Showroom México</option>
			<option data-geo-lat=\'19.403378\' data-geo-long=\'-99.076898\' mapaUb="https://maps.google.com.mx/maps?q=19.403378,-99.076898&amp;num=1&amp;t=m&amp;z=17" value="Headquarters">Headquarters</option>
			<option data-geo-lat=\'35.9609696\' data-geo-long=\'-80.006355\' mapaUb="https://maps.google.com/maps?q=35.9609696,-80.006355" value="High Point">High Point</option>
		</select>
	</div><!-- .info -->
	<div class="info headquarters">
		<h2>Headquarters</h2>
		<p>Oriente 233 No. 151<br>
			México, D.F., 08500<br>
			1 888 489 38 39<br>
			(+52)55 5716 - 9275</p>
			<a href="mailto:info@alfonsomarinaebanista.com?subject=Contácto">info@alfonsomarinaebanista.com</a>
			<a href="https://maps.google.com.mx/maps?q=19.403378,-99.076898&amp;num=1&amp;t=m&amp;z=17" target="_blank" class=""><i class="fa fa-plus-square-o fa-lg"></i> Ver mapa</a>
			<select class="falta">
				<option data-geo-lat=\'19.407274\' data-geo-long=\'-99.239815\' mapaUb="https://maps.google.com/maps?q=19.407274,-99.239815&amp;num=1&amp;t=m&amp;z=17" value="Showroom México">Showroom México</option>
				<option data-geo-lat=\'19.403378\' data-geo-long=\'-99.076898\' mapaUb="https://maps.google.com.mx/maps?q=19.403378,-99.076898&amp;num=1&amp;t=m&amp;z=17" value="Headquarters">Headquarters</option>
				<option data-geo-lat=\'35.9609696\' data-geo-long=\'-80.006355\' mapaUb="https://maps.google.com/maps?q=35.9609696,-80.006355" value="High Point">High Point</option>
			</select>
		</div><!-- .info -->
		<div class="info highPoint">
			<h2>High Point</h2>
			<p>301 North Hamilton Street<br>
				High Point, NC 27260<br>
				Phone: 336 887 9320
			</p>
			<a href="https://maps.google.com/maps?q=35.9609696,-80.006355" target="_blank" class=""><i class="fa fa-plus-square-o fa-lg"></i> Ver mapa</a>
			<select class="falta">
				<option data-geo-lat=\'19.407274\' data-geo-long=\'-99.239815\' mapaUb="https://maps.google.com/maps?q=19.407274,-99.239815&amp;num=1&amp;t=m&amp;z=17" value="Showroom México">Showroom México</option>
				<option data-geo-lat=\'19.403378\' data-geo-long=\'-99.076898\' mapaUb="https://maps.google.com.mx/maps?q=19.403378,-99.076898&amp;num=1&amp;t=m&amp;z=17" value="Headquarters">Headquarters</option>
				<option data-geo-lat=\'35.9609696\' data-geo-long=\'-80.006355\' mapaUb="https://maps.google.com/maps?q=35.9609696,-80.006355" value="High Point">High Point</option>
			</select>
		</div><!-- .info -->
		<br class="clear">
	</div><!-- .coontact-info -->
	<div class="contact-form">
		<p id="mensaje"></p>
		<form id="contact-form" name="contact-form" action="<?php echo $this->url($lang , "/contact"); ?>" method="post">
			<h2 class="product-title"><?php echo $this->trans($lang,'Contacto', 'Contact us'); ?></h2>
			<div class="field name">
				<input name="nombre" class="requerido" type="text" placeholder="<?php echo $this->trans($lang,'Nombre','Name'); ?>">				
			</div><!-- .field-->
			<div class="field">
				<input name="empresa" class="requerido" type="text" placeholder="<?php echo $this->trans($lang,'Empresa','Company'); ?>">
			</div><!-- .field -->
			<div class="field">
				<input name="puesto" type="text" placeholder="<?php echo $this->trans($lang,'Puesto','Position'); ?>">
			</div><!-- .field -->
			<div class="field">
				<select name="pais">
					<option value=""><?php echo $this->trans($lang,'País','Country'); ?></option>
					<option value="mexico">México</option>
				</select>
			</div><!-- .field -->
			<div class="field">
				<input name="estado" class="requerido" type="text" placeholder="<?php echo $this->trans($lang,'Estado / Municipio','City / State'); ?>">
			</div><!-- .field -->
			<div class="field">
				<input name="codigopostal" class="requerido" type="text" placeholder="<?php echo $this->trans($lang,'Código Postal','Zip Code'); ?>">
			</div><!-- .field -->
			<div class="field">
				<input name="telefono" class="requerido" type="text" placeholder="<?php echo $this->trans($lang,'Teléfono','Phone'); ?>">
			</div><!-- .field -->
			<div class="field">
				<input name="email" type="email" class="requerido" placeholder="<?php echo $this->trans($lang,'Correo electrónico','EMail'); ?>">
			</div><!-- .field -->
			<div class="field how">
				<select name="comoseentero">
					<option value=""><?php echo $this->trans($lang,'¿Cómo se enteró de nosotros?','How did you hear of us?'); ?></option>
					<option value="un amigo">A través de un amigo</option>
				</select>
				<br class="clear">
			</div><!-- .field -->
			<br class="clear">
			<div class="required-fields">
				* <?php echo $this->trans($lang,'Campos Obligatorios','Required'); ?>
			</div><!-- .required-fields -->
			<textarea name="comentario" placeholder="<?php echo $this->trans($lang,'Comentario','Comment'); ?>"></textarea>
			<input name="enviar" id="btn-submit" type="submit" class="general-btn" value="<?php echo $this->trans($lang,'Enviar','Send'); ?>">
		</form>
		</div><!-- .contact-form -->