<div class="row">
	<div class="media">
		<div class="media-left media-middle">
		    <img class="media-object" src="/<?= $font['logo'] ?>" alt="<?= $font['nombre'] ?>" style="max-width: 200px;">
	  	</div>
	  	<div class="media-body">
	  		<div class="row">
	  			<div class="col-sm-3 col-sm-offset-2">
	  				<p>
	  					<strong>Fuente:</strong> <span class="info-text"><?= $font['nombre']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Sección:</strong> <span class="info-text"><?= $noticia['seccion']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Fecha:</strong> <span class="info-text"><?= $fecha->format('d-M-Y'); ?></span>
	  				</p>
	  			</div>
	  			<div class="col-sm-3">
	  				<p>
	  					<strong>Autor:</strong> <span class="info-text"><?= $noticia['autor']; ?></span>
	  				</p>
	  				<p>
	  					<strong>Tendencia:</strong> <span class="info-text"><?= $noticia['tendencia']; ?></span>
	  				</p>
	  			</div>
	  			<div class="col-sm-3">
	  				
	  			</div>
	  		</div>
	  	</div>
	</div>
</div>