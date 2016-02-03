<div class="registro">        
			<div class="acerca-principal-quienes acerca-principal-quienes-form">
				<h2><?php echo $user['nombre'].' '.$user['apellidos'] ?></h2>
				<ul>
					<li><a href="/profile/account">Estado de Cuenta</a></li>
					<li><a href="/profile/prices-list">Lista de precios</a></li>
					<li><a href="/profile/download-catalog">Descargar Catálogo</a></li>
					<li><a href="/profile/my-quote">Mis Cotizaciones</a></li>
					<li><a href="/profile">Mi Perfil</a></li>
				</ul>
			</div>		
			<div class="acerca-secundario-quienes acerca-secundario-quienes-form">
				<p id="mensaje"></p>
				<?php echo $contentd ?>
			</div>
			<br class="clear">
</div>