<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
</head>
<body style="background: #f8f8f8;">
<table style="width: 100%; border-collapse: collapse;">
	<tr>
		<td>
			<table style="width: 580px;border-collapse: collapse;" align="center">
				<tr>
					<td style="margin:0;padding: 0;border: 0">
						<img src="<?=base_url('assets/img/sony.jpg"')?>" style="max-width: 100%;display: block;">
					</td>
				</tr>
			</table>
			<table style="width: 580px;border-collapse: collapse;font-size: 12px;font-family: Arial, Helvetica, sans-serif;" align="center">
				<tr>
					<td style="padding: 15px 30px;background: #000000;text-align: right; color: #fff">
						<?= $date['name'] . " " . $date['day'] . " de " . $date['month'] . " del " . $date['year']?>
					</td>
	            </tr>

	            <?php

				$array = array("Prensa", "Sitios Web","Redes Sociales","Radio","Televisión");

				foreach ($news as $ns) { 

				switch ($i = $ns['type']) {
				    case 1:
				        $newsType = $array[0];
				        break;
				    case 2:
				        $newsType = $array[1];
				        break;
				    case 3:
				        $newsType = $array[2];
				        break;
				    case 4:
				        $newsType = $array[3];
				        break;
				    case 5:
				        $newsType = $array[4];
				        break;
				}

				echo '
	            <tr>
					<td style="padding: 15px 30px;background: white;border-bottom: solid 1px #e8e8e8">
						<p style="margin: 0;padding: 0;font-size: 12px;font-family: Arial, Helvetica, sans-serif;line-height: 1.25;font-weight: normal;text-align: left !important;"><span style="font-weight: bold">'.$ns['nameCategory'].'</span><br><a href="'.$ns['link'].'" style="color: #015199;font-weight: bold;text-decoration:none">'.$ns['title'].'</a><br>
	                    	'.$ns['text'].'<br><span style="color: #950a16;font-weight: bold;">'. $newsType . " | " .  $ns['source'] .'</span>
	                    </p>
	                </td>
	            </tr>'; } ?>

			</table>
			<table style="width: 580px;border-collapse: collapse;font-size: 12px;font-family: Arial, Helvetica, sans-serif;" align="center">
				<tr>
					<td style="padding: 30px 30px;">
						<p style="margin: 0;padding: 0;text-align: center;">
						<?php if (!empty($newsletter['link1'])) : ?>
							<a href="<?=$newsletter['link1'];?>" style="color: #015199;text-decoration: none;">PRIMERAS PLANAS</a>
						<?php endif; ?><?php if (!empty($newsletter['link2'])) : ?>
							<a href="<?=$newsletter['link2'];?>" style="color: #015199;text-decoration: none;"> | PORTADAS NEGOCIOS</a>
						<?php endif; ?><?php if (!empty($newsletter['link3'])) : ?>
							<a href="<?=$newsletter['link3'];?>" style="color: #015199;text-decoration: none;"> | CARTONES</a>
						<?php endif; ?><?php if (!empty($newsletter['link4'])) : ?>
							<a href="<?=$newsletter['link4'];?>" style="color: #015199;text-decoration: none;"> | COLUMNAS NEGOCIOS</a>
						<?php endif; ?><?php if (!empty($newsletter['link5'])) : ?>
							<a href="<?=$newsletter['link5'];?>" style="color: #015199;text-decoration: none;"> | COLUMNAS POLÍTICAS</a>
						<?php endif; ?><?php if (!empty($newsletter['link6'])) : ?>
							<a href="<?=$newsletter['link6'];?>" style="color: #015199;text-decoration: none;"> | PORTADA ESPECTACULOS</a>
						<?php endif; ?>
                         </p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>