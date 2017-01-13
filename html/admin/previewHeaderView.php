<!-- <style type="text/css">
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
</style> -->
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