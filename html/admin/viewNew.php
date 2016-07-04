<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?= $newSelected['encabezado'] ?></h1>
	</div>	
</div>
<h4>Noticia de <?= $newSelected['tipofuente'] ?></h4>
<p>Síntesis: </p>
<p><?= $newSelected['sintesis'] ?></p>
<p>Autor: <strong><?= $newSelected['autor'] . ' ( ' . $newSelected['tipoautor'] . ' )' ?></strong></p>
<p>Fecha: <strong><?= getFechaLarga($newSelected['fecha']) ?></strong></p>
<?= $html ?>
<p>Fuente: <strong><?= $newSelected['fuente'] ?></strong></p>
<p>Sección: <strong><?= $newSelected['seccion'] ?></strong></p>
<p>Sector: <strong><?= $newSelected['sector'] ?></strong></p>
<p>Género: <strong><?= $newSelected['genero'] ?></strong></p>
<p>Tendencia: <strong><?= $newSelected['tendencia'] ?></strong></p>
<p>Comentarios: <strong><?= $newSelected['comentario'] ?></strong></p>
<p>Usuario que subio la nota : </p><strong><?= $newSelected['usuario'] ?></strong>
