<head>
	<meta charset="utf-8">
</head>
<body style="margin: 0 auto; width: 700px;">	
	<div style=" position: relative; ">	
		<h5 style="float: left;"><?= $new['tipofuente'] ?> / Noticias</div>
		<div style="text-align: center;">
			<img src="http://www.opemedios.com.mx/images/logo.png" width="230" height="100">
		</div>
	</div>
	<div>
		<h1 style="margin: 10px; padding-top: 30px; text-align: justify;"><a href="http://alfa.opemedios.dev/panel/new/view/<?= $new['id'] ?>" target="_blank"><?= $new{'encabezado'} ?></a></h1>
		<p style="font-size: 20px; text-align: right; margin-right: 20px;">Costo Beneficio: <strong>$<?= $relatedNew['costo'] ?></strong></p>
		<p style=" margin: 30px 10px; font-size: 23px; text-align: justify;"><?= $new['sintesis'] ?></p>
		<table>
			<tr>
				<th style=" text-align: left;">Fuente:</th>
				<td><?= $new['fuente'] ?></td>
				<th style=" text-align: left;">Tendencia:</th>
				<td><?= $new['tendencia'] ?></td>
			</tr>
			<tr>
				<th style=" text-align: left;">Autor:</th>
				<td><?= $new['autor'] . ' ( ' . $new['tipoautor'] . ' )' ?></td>
				<th style=" text-align: right;">Fecha:</th>
				<td><?= getFechaLarga( $new['fecha'] ) ?></td>
			</tr>
		</table>
		<br>
		<p style="margin: 0 ;"><strong>Comentarios: </strong></p><p style="margin: 0 ;"><?= $new['comentario'] ?></p>
	</div>
</body>

