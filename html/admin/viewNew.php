<div class="row">
	<div class="col-sm-8">
		<h1 class="page-header"><?= $newSelected['encabezado'] ?></h1>
	</div>
	<div class="col-sm-2 col-sm-offset-2 mt-50">
		<div class="dropdown">
		  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    Acciones
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<?php if( $font === 'per' || $font === 'rev' ): ?>
			<li><a href="/panel/new/add-file/<?= $newSelected['id'] ?>">Agregar archivo</a></li>
		    <li role="separator" class="divider"></li>
			<?php endif; ?>
		    <li><a href="/panel/new/edit/<?= $newSelected['id'] ?>">Editar</a></li>
		    <li role="separator" class="divider"></li>
		    <li><a href="/panel/new/send/<?= $newSelected['id'] ?>">Enviar</a></li>
		    <!-- <li><a href="#">Something else here</a></li>
		    <li role="separator" class="divider"></li>
		    <li><a href="#">Separated link</a></li> -->
		  </ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<h4>Noticia de <?= $newSelected['tipofuente'] ?></h4>
		<p>Síntesis: </p>
		<p>
			<?= $newSelected['sintesis'] ?>
		</p>	
		<p>Autor: <strong><?= $newSelected['autor'] . ' ( ' . $newSelected['tipoautor'] . ' )' ?></strong></p>
		<p>Fecha: <strong><?= getFechaLarga($newSelected['fecha']) ?></strong></p>
		<?= $html ?>
		<p>Fuente: <strong><?= $newSelected['fuente'] ?></strong></p>
		<p>Sección: <strong><?= $newSelected['seccion'] ?></strong></p>
		<p>Género: <strong><?= $newSelected['genero'] ?></strong></p>
		<p>Tendencia: <strong><?= $newSelected['tendencia'] ?></strong></p>
		<p>Alcance: <strong><?= $newSelected['alcance'] ?></strong></p>
		<p>Usuario que subio la nota : </p><strong><?= $newSelected['usuario'] . ' ' . $newSelected['apellidos'] ?></strong>
		<div class="col-sm-6">
			<?php if( isset( $imageUbicacion ) ): ?>
				<?= $imageUbicacion; ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-md-8">
		<?= $htmlAdjunto ?>
	</div>	
</div>
