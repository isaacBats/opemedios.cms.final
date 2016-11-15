<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header"><?= $font['nombre'] ?></h1>
	</div>
	<div class="col-md-4">
		<img src="/<?= $font['logo']  ?>" alt="<?= $font['nombre'] ?>" width="320">
	</div>
	<div class="col-md-8">
		<strong>Empresa: </strong><span><?= $font['empresa'] ?></span>
		<br><strong>Activo: </strong><span><?= ($font['activo'])? 'SI':'NO'; ?></span>
		<strong></strong>
		<strong></strong>
		<strong></strong>
	</div>
</div>