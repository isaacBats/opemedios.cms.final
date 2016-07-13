<head>
	<meta charset="utf-8">
</head>
<body style=" background: #E0E0F8; max-width: 750px; margin: 0 auto;">	
	<div style=" position: relative; ">	
		<h5 style=" position: absolute; right: 20px; top: 20px;"><?= $new['tipofuente'] ?> / Noticias</div>
		<div>
			<img src="http://www.opemedios.com.mx/images/logo.png" width="230" height="100">
		</div>
	</div>
	<div style=" background: #F5ECCE;">
		<h3 style="margin: 5px 10px 20px 10px; padding-top: 30px;"><a href="http://alfa.opemedios.dev/panel/new/view/<?= $new['id'] ?>" target="_blank"><?= $new{'encabezado'} ?></a></h3>
		<p style=" margin: 10px; padding: 25px;"><?= $new['sintesis'] ?></p>
		<p style="margin-left: 40px; margin-top: -20px; font-size: 20px;">Costo Beneficio: <strong>$<?= $relatedNew['costo'] ?></strong></p>
		<div style="text-align: center;">		
			<p style="margin: 0 ;"><strong>Fuente: </strong><?= $new['fuente'] ?></p>
			<p style="margin: 0 ;"><strong>Autor: </strong><?= $new['autor'] . ' ( ' . $new['tipoautor'] . ' )' ?></p>
			<p style="margin: 0 ;"><strong>Fecha: </strong><?= getFechaLarga( $new['fecha'] ) ?></p>
			<p style="margin: 0 ;"><strong>Tendencia: </strong><?= $new['tendencia']?></p>
			<p style="margin: 0 ;"><strong>Comentarios: </strong></p><p><?= $new['comentario'] ?></p>
		</div>
	</div>
</body>

