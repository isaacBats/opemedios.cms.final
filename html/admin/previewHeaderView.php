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
<header>
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
				<th>Costo/cm2:</th>
				<td>$<?= $encabezado['costo_cm']; ?></td>
			</tr>
			<tr>
				<th>Cms2:</th>
				<td><?= $encabezado['tamanio']; ?></td>
				<th>Fraccion:</th>
				<td><?= $fraccion['string']; ?></td>
				<th>Costo nota:</th>
				<td>$<?= $encabezado['costo_nota']; ?></td>
			</tr>
		</table>
	</header>	
	<figure id="img-principal">
		<img src="/<?= $adjunto['carpeta'] . $adjunto['nombre_archivo'] ?>">
	</figure>

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Editar el encabezado
			</div>
			<div class="panel-body">
				<form action="" method="post">
					<input type="hidden" value="<?= $encabezado['id_adjunto'] ?>">
					<div class="form-group col-sm-2">
						<label>Pagina:</label>
						<input type="text" class="form-control" value="<?= $encabezado['num_pagina'] ?>">
					</div>
					<div class="form-group col-sm-2">
						<label>Porcentaje:</label>
						<input type="text" class="form-control" value="<?= $encabezado['porcentaje'] ?>">
					</div>
					<div class="col-sm-6 form-group">
                        <label>Fuente:</label>
                        <select id="selectFuente" class="select2 form-control" name="fuente" required >
                            <option value="">Seleccione una Fuente</option>
                            <?= $optionFont ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Sección:</label>
                         <select class="form-control" name="seccion" id="add-new-secction" disabled="disabled" >
                            <option value="">Sección</option>
                        </select>
                    </div>
				</form>
			</div>
		</div>
	</div>