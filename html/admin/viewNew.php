<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?= $newSelected['encabezado'] ?></h1>
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
		<p>Sector: <strong><?= $newSelected['sector'] ?></strong></p>
		<p>Género: <strong><?= $newSelected['genero'] ?></strong></p>
		<p>Tendencia: <strong><?= $newSelected['tendencia'] ?></strong></p>
		<p>Alcance: <strong><?= $newSelected['alcance'] ?></strong></p>
		<p>Comentarios:</p><p><?= $newSelected['comentario'] ?></p>
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
