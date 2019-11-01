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
						<img src="<?=base_url('assets/img/creel.jpg"')?>" style="max-width: 100%;display: block;">
					</td>
				</tr>
			</table>
			<table style="width: 580px;border-collapse: collapse;font-size: 12px;font-family: Arial, Helvetica, sans-serif;" align="center">
				<tr>
					<td style="padding: 15px 30px;background: #000000;text-align: right; color: #fff">
						<?= $date['name'] . " " . $date['day'] . " de " . $date['month'] . " del " . $date['year']?>
					</td>
	            </tr>
	            <tr>
					<td style="padding: 15px 30px;background: white;">
						<h2 style="font-size:18px;font-weight:normal;color: #2084f3;">Su Newsletter <?=$newsletter['horary']?> esta listo:</h2>
					</td>
				</tr>
				<tr>
					<td style="padding: 15px 30px;background: white;text-align: center">
						 <a href="<?=$link?>" class="myButton" style="-moz-box-shadow: inset 0px -3px 7px 0px #0688fa;-webkit-box-shadow: inset 0px -3px 7px 0px #0688fa;box-shadow: inset 0px -3px 7px 0px #0688fa;background-color: #2083f3;-moz-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;border: 1px solid #1b73d1;display: inline-block;cursor: pointer;color: #ffffff;font-family: Arial;font-size: 16px;font-weight: bold;padding: 20px 40px;text-decoration: none;text-shadow: 0px 1px 0px #263666;">Ver Newsletter</a>
                	</td>
           		</tr>
           		<tr>
					<td style="padding: 15px 30px;background: white;">
					</td>
				</tr>
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