<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Bloque de noticias</title>
	<meta name="viewport" content="whidth=device-width, inicia-scale=1.0" />
</head>
<body style=" margin: 0; padding: 0;">
	<table border="0",cellpadding="0",cellspacing="0",width="600" style="border-collapse: collapse;">
		<tr>
			<td align="center" bgcolor="#FFEBCD" style="padding: 30px 150px 30px 150px;"> 
			 	<img src="http://www.opemedios.com.mx/images/logo.png" alt="Operadora de medios" width="300" height="230" style="display: block;" />			 
			</td>
		</tr>
		<tr>
			<td bgcolor="#FFEBCD" style="padding: 40px 30px 40px 30px;">
				<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
					<?php foreach ($noticias as $key => $noticia) { ?>
						<tr>				 
							<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;"><?= $noticia['encabezado'] ?></td>				 
						</tr>				 
						<tr>
							<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;"><?= $noticia['sintesis'] ?></td>				 
						</tr>				 
					<?php } ?>				 
				</table>
			</td>
		</tr>
		<tr>
			<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>						
						<td width="75%" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
							&reg;© Operadora de Medios Informativos 2016<br/>
						</td>
						<td align="right">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<a href="https://twitter.com/DeMonitoreo" target="_blank">
											<img src="http://www.vencolibrary.org/sites/default/files/images/flat-social-icons_0008_twitter.png" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
										</a>
									</td>
									<td style="font-size: 0; line-height: 0;" width="20">
										&nbsp;
									</td>
									<td>
										<a href="https://www.facebook.com/OPEMEDIOS/" target="_blank">
											<img src="http://www.vencolibrary.org/sites/default/files/images/flat-social-icons_0002_facebook.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
										</a>
									</td>
								</tr>
							</table>
						</td>
					 </tr>
				</table>
			</td>
		</tr>
	</table>	
</body>
</html>