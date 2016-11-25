<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header"><?= $user['nombre'] . ' ' . $user['apellidos'] ?></h1>
	</div>
	<!-- <div class="col-md-6">
		<img src="/<?php //echo $client['logo']  ?>" alt="<?php //echo $client['nombre'] ?>" width="320">
	</div> -->
	<div class="col-md-6">
		<?php foreach ($user as $key => $value): 
				if( $key != 'id_usuario' && $key != 'nombre' && $key != 'id_tipo_usuario' && $key != 'activo' && $key != 'apellidos' ): ?>
					<p><strong><?= ucwords( $key ) ?>: </strong><?= $value ?></p>
		<?php endif; endforeach; ?>
		<p><strong><?= ($user['activo'] == TRUE ) ? 'Usuario Activo' : 'Usuario Inactivo' ?></strong></p>
	</div>
</div>