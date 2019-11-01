<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Noticia Opemedios</title>
    <meta property="og:url"           content="http://<?= $_SERVER['HTTP_HOST'] ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?= $new['titulo'] ?>" />
    <meta property="og:description"   content="<?= $new['sintesisCorta'] ?>" />
    <meta property="og:image"         content="http://<?= $_SERVER['HTTP_HOST'] . $new['path_archivo'] ?>" />
	<style type="text/css">
		body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
	    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
	    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
	    /* RESET STYLES */
	    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
	    table{border-collapse: collapse !important;}
	    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
	    /* iOS BLUE LINKS */
	    a[x-apple-data-detectors] {
	        color: inherit !important;
	        text-decoration: none !important;
	        font-size: inherit !important;
	        font-family: inherit !important;
	        font-weight: inherit !important;
	        line-height: inherit !important;
	    }
	</style>
</head>
<body style="background-color: #E8EAF6;font-family: Arial, Helvetica, sans-serif;">
<table style="width: 100%;border-collapse: collapse;">
	<tr>
		<td>
			<table align="center" style="width: 580px;background-color: #ffffff;padding: 20px;border: 0;border-collapse: collapse;color: #263238;font-size: 12px;margin-top: 10px;">
				<tr>
					<td style="padding: 20px;">
						<img src="https://opemedios.mx/assets/assets_home/img/logo.png" width="150px">
					</td>
					<td style="text-align: right;padding: 20px;">
						<?=$currentDate;?>
					</td>
				</tr>
			</table>
			<table align="center" style="width: 580px;padding: 0;border: 0;border-collapse: collapse;background-color: #ffffff;">
				<tr>
					<td>
						<img src="http://<?=$_SERVER['HTTP_HOST']?>/admin/images/bg_newsletter.jpg" class="image" style="max-width: 100%;height: auto;">
					</td>
				</tr>
			</table>
			<table align="center" style="width: 580px;padding: 0;border: 0;border-collapse: collapse;background-color: #ffffff;margin-bottom: 100px;">
				<tr>
					<td colspan="2" style="padding: 15px 0;"></td>
				</tr>
				<tr>
					<td colspan="2">
						<table style="width: 580px;border: 0;border-collapse: collapse;">
							<tr>
								<td style="padding: 20px 10px;background-color: #1976D2;"></td>
								<td style="padding-left: 10px;color: #1976D2;">
									<span style="font-size: 12px;">
										<?= utf8_decode(strtoupper($new['tipoFuente'])) ?>
									</span><br>
									<span style="font-size: 18px;">
										<?= utf8_decode(strtoupper($new['titulo'])) ?>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="padding: 15px 0;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 10px 30px;">
						<p style="color: #263238;font-size: 14px;margin: 0;margin-top: 2px;margin-bottom: 0px;">
							<?=$new['sintesis'] ?>
						</p>
						<p style="font-size: 12px;margin-bottom: 30px;margin-top: 10px;color: #263238;"><?=$new['tipoFuente']?> / <span class="c1" style="color: #1976D2;">
							<?=$new['fuente']?>, <?=ucwords(strtolower($new['autor']))?></span></p>
						<a href="<?= $new['urlOpemedios'] ?>" style="color: #ffffff;padding: 15px 30px;text-decoration: none;font-size: 12px;background-color: #1976D2;">Ver noticia completa</a>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 30px 0;"></td>
				</tr><tr>
				</tr><tr style="font-size: 12px;border-top: 1px solid #E3F2FD;background-color: #1976D2;color: #ffffff;">
					<td style="padding: 20px  0 20px 60px;">
						<a href="http://<?= $_SERVER['HTTP_HOST'] ?>" style="color: #ffffff;text-decoration: none;">www.opemedios.mx</a>
					</td>
					<td style="padding: 20px  60px 20px 0;text-align: center;">
						Comparte esta noticia:<br>

						<a href="https://facebook.com/sharer.php?u=<?=$new['urlOpemedios']?>" style="color: #ffffff;text-decoration: none;">
							<img src="http://<?=$_SERVER['HTTP_HOST']?>/admin/images/fb_logo.png" width="32px" height="32px" style="margin-top: 15px"></a>	

						<a href="https://twitter.com/intent/tweet?url=<?=$new['urlOpemedios']?>&text=<?=$new['titulo']?>&via=DeMonitoreo" style="color: #ffffff;text-decoration: none;">
							<img src="http://<?=$_SERVER['HTTP_HOST']?>/admin/images/tw_logo.png" width="32px" height="32px" style="margin-left: 20px; margin-top: 15px"></a>

					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>
</body>
</html>