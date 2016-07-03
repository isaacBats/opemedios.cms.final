<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?= $newSelected['encabezado'] ?></h1>
	</div>	
</div>
<p>Síntesis: </p>
<p><?= $newSelected['sintesis'] ?></p>
<p>Autor: <strong><?= $newSelected['autor'] ?></strong></p>
<p>Fecha: <strong><?= getFechaLarga($newSelected['fecha']) ?></strong></p>
<?= $html ?>
<p>Fuente: <?= $newSelected['fuente']  ?></p>

