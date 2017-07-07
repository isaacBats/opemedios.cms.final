<div class="row">
	<div class="media">
		<div class="media-left media-middle">
		    <img class="media-object" src="/<?= $font['logo'] ?>" alt="<?= $font['nombre'] ?>" style="max-width: 200px;">
	  	</div>
	  	<div class="media-body">
	  		<div class="row">
	  			<div class="col-sm-3 col-sm-offset-2">
	  				<p>
	  					<strong>Pagina:</strong> <span class="info-text"><?= $encabezado['num_pagina']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Sección:</strong> <span class="info-text"><?= $encabezado['seccion']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Cms<sup>2</sup>:</strong> <span class="info-text"><?= $encabezado['tamanio']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Tiraje:</strong> <span class="info-text"><?= $encabezado['tiraje']; ?></span>
	  				</p>
	  			</div>
	  			<div class="col-sm-3">
	  				<p>
	  					<strong>Impactos:</strong> <span class="info-text"><?= $encabezado['impactos']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Fracción:</strong> <span class="info-text"><?= $fraccion['string']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Porcentaje:</strong> <span class="info-text"><?= $encabezado['porcentaje']; ?>%</span>
	  				</p>
	  				<p>
	  					<strong>Fecha:</strong> <span class="info-text"><?= $fecha->format('d-M-Y'); ?></span>
	  				</p>
	  			</div>
	  			<div class="col-sm-3">
	  				<p>
	  					<strong>Costo/Cm<sub>2</sub>:</strong> <span class="info-text">$<?= $encabezado['costo_cm']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Costo/Nota:</strong> <span class="info-text">$<?= $encabezado['costo_nota']; ?></span>
	  				</p>
	  			</div>
	  		</div>
	  	</div>
	</div>
</div>