<style type="text/css">
	header{
		display: block;
		margin: 15px 20%;
	}
		header #img-fuente{
			bottom: 10px;
			display: inline-block;
			position: relative;
		}
		header #img-fuente img{
			margin-bottom: 15px;
			width: 130px;
		}
		header #img-fuente figcaption{
			padding-left: 30px;
		}
		header time {
			display: block;
		}
		header table{
			display: inline-block;
		}
		header table tr th {
			background-color: black;
			color: white;
			padding: 2px 2px;
			text-align: left;				
		}
		header table tr td {
			padding: 0 .5em;
		}

	#img-principal{
		max-width: 800px;
	}

	#img-principal img{
		width: 100%;
	}
</style>
<?= $this->flashAlerts('update-header'); ?>
<nav class="col-sm-offset-9" id="actions-headers">
	<bottom class="btn btn-success" id="editar-encabezado">Editar</bottom>
	<bottom id="eliminar-encabezado" class="btn btn-danger" data-idencabezado="<?= $encabezado['id'] ?>" data-idnew="<?= $new['id'] ?>" data-idadjunto="<?= $encabezado['id_adjunto'] ?>" data-toggle="modal" data-target="#myModal" >Eliminar Adjunto</bottom>		
</nav>
<div id="headers-edit" class="col-sm-12" style="display: none">
	<div class="panel panel-default">
		<div class="panel-heading">
			Editar el encabezado
		</div>
		<div class="panel-body">
			<form action="/panel/new/encabezado/edit" method="post">
				<input type="hidden" name="encabezadoId" value="<?= $encabezado['id'] ?>">
				<input type="hidden" name="adjuntoId" value="<?= $encabezado['id_adjunto'] ?>">
				<input type="hidden" name="tipo_fuente" value="<?= $fuente ?>">
				<div class="form-group col-sm-12">
                    <label>Fuente:</label>
                    <select id="selectFuente" class="select2 form-control" name="fuente" required >
                        <option value="">Seleccione una Fuente</option>
                        <?php foreach ($fuentes as $f): ?>
                        	<option value="<?= $f['id_fuente'] ?>" <?= ($f['id_fuente'] == $seccion['id_fuente']) ? 'selected' : '' ?>><?= $f['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label>Sección:</label>
                     <select class="form-control" name="seccion" id="add-new-secction" >
                        <option value="<?= $seccion['id_seccion'] ?>"><?= $seccion['nombre'] ?></option>
                    </select>
                </div>
				<div class="form-group col-sm-2">
					<label>Pagina:</label>
					<input type="text" name="num_pagina" class="form-control" value="<?= $encabezado['num_pagina'] ?>">
				</div>
				<div class="form-group col-sm-2">
					<label>Porcentaje:</label>
					<input type="text" name="porcentaje" class="form-control" value="<?= $encabezado['porcentaje'] ?>">
				</div>
				<div class="form-group col-sm-2">
					<label>Tamaño Cm<sup>2</sup></label>
					<input type="text" name="cm2" class="form-control" value="<?= $encabezado['tamanio'] ?>">
				</div>
				<div class="form-group col-sm-2">
					<label>Costo Cm<sup>2</sup></label>
					<input type="text" name="costocm2" class="form-control" value="<?= $encabezado['costo_cm'] ?>">
				</div>
				<div class="form-group col-sm-2">
					<label>Costo de la nota:</label>
					<input type="text" name="costonota" class="form-control" value="<?= $encabezado['costo_nota'] ?>">
				</div>
				<div class="col-sm-4 col-sm-offset-6 mt-20">
					<input type="submit" value="Guardar" class="btn btn-success">
					<button id="cancel-edit-headers" type="button" class="btn btn-warning mr-10" >Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<header id="encabezados-adjunto">
		<figure id="img-fuente">
			<img src="/assets/data/fuentes/<?= $encabezado['logo']; ?>">
			<figcaption>
				<?= $fecha->format('d-M-Y'); ?>
			</figcaption>
		</figure>
		<table id="header-table">
			<tr>
				<th>Pag:</th>
				<td><?= $encabezado['num_pagina']; ?></td>
				<th>Tiraje:</th>
				<td><?= $encabezado['tiraje']; ?></td>
				<th>Porcentaje</th>
				<td><?= $encabezado['porcentaje']; ?>%</td>
			</tr>
			<tr>
				<th>Seccion:</th>
				<td><?= $encabezado['seccion']; ?></td>
				<th>Impactos:</th>
				<td><?= $encabezado['impactos']; ?></td>
				<th>Costo/cm<sup>2</sup>:</th>
				<td>$<?= $encabezado['costo_cm']; ?></td>
			</tr>
			<tr>
				<th>Cms<sup>2</sup>:</th>
				<td><?= $encabezado['tamanio']; ?></td>
				<th>Fraccion:</th>
				<td><?= $fraccion['string']; ?></td>
				<th>Costo nota:</th>
				<td>$<?= $encabezado['costo_nota']; ?></td>
			</tr>
		</table>
	</header>
	<div id="img-principal">
		<?= $this->getMedia($adjunto) ?>
	</div>