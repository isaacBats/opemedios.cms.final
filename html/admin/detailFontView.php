<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header"><?= $font['nombre'] ?></h1>
	</div>
	<div class="col-md-4">
		<img src="/<?= $font['logo']  ?>" alt="<?= $font['nombre'] ?>" width="320">
	</div>
	<div class="col-md-8">
		<?php foreach ($font as $key => $value): 
				if( $key != 'id_fuente' && $key != 'id_cobertura' && $key != 'logo' && $key != 'id_tipo_fuente' && $key != 'id_senal' ): ?>
					<p><strong><?= ucwords( $key ) ?>: </strong><?= $value ?></p>
		<?php endif; endforeach; ?>
	</div>
</div>