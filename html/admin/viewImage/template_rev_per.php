<html>
<meta charset="utf-8">
<head>
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


		footer{
			display: block;
			margin: 10px 5px;
			position: absolute;
			width: 95%;			
		}
			footer p{
				display: inline-block;
				font-size: 22px;
				float: right;
				position: relative;
				top: 19px; 
			}
			#img-empresa{
				display: inline-block;
				float: left;
			}
				#img-empresa img{
					width: 150px;
				}

		#img-principal {
			margin: 4px 20%;
		}

	</style>	
</head>
<body>	
	<header>
		<figure id="img-fuente">
			<img src="<?= $logo ?>">
			<figcaption>
				<?= $fecha ?>
			</figcaption>
		</figure>
		<table id="header-table">
			<tr>
				<th>Pag:</th>
				<td><?= $pagina ?></td>
				<th>Tiraje:</th>
				<td><?= $tiraje ?></td>
				<th>Porcentaje</th>
				<td><?= $porcentaje ?>%</td>
			</tr>
			<tr>
				<th>Seccion:</th>
				<td><?= $seccion ?></td>
				<th>Impactos:</th>
				<td><?= $impactos ?></td>
				<th>Costo/cm2:</th>
				<td>$<?= $costoXcm ?></td>
			</tr>
			<tr>
				<th>Cms2:</th>
				<td><?= $tamanio ?></td>
				<th>Fraccion:</th>
				<td><?= $fraccion['string'] ?></td>
				<th>Costo nota:</th>
				<td>$<?= $costoNota ?></td>
			</tr>
		</table>
	</header>	
	<figure id="img-principal">
		<img src="<?= $imageNota ?>">
	</figure>
	<footer>
		<figure id="img-empresa">
			<img src="/assets/images/logo_150X40.png">
		</figure>
		<p>© Opemedios</p>
	</footer>
</body>
</html>