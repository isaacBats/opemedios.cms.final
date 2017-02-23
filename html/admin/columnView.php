<?= $this->flashAlerts('columnas'); ?>
<div class="col-sm-12">
	<h1>
		<?= $column['titulo'] ?>
	</h1>
	<hr>
	<small>Fuente <cite title="Source Title"><?= $fuente['nombre'] ?></cite></small>			
	<br>
	<small>Autor <cite title="Source Title"><?= $column['autor'] ?></cite></small>			
</div>
<div class="col-sm-8">
	<p>
		<?= $column['contenido'] ?>
	</p>
	<img src="/<?= $column['imagen'] ?>" style="max-width: 100%; ">
</div>
<div class=" col-sm-2 col-sm-offset-2">
	<a href="/panel/prensa/editar/<?= str_replace(' ','-', strtolower($titulo)) . '/' . $id ?>" class="btn btn-success btn-lg btn-block">Editar</a>
	<button class="btn btn-danger btn-lg btn-block delete-column" data-id="<?= $id ?>" data-toggle="modal" data-target="#myModal" >Eliminar</button>
</div>
