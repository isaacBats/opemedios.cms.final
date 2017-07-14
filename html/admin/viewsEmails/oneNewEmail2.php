<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<title>Opemedios Email</title> 
	<!-- Web Font / @font-face : BEGIN -->
	<!-- NOTE: If web fonts are not required, lines 9 - 26 can be safely removed. -->
	
	<!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
	<!--[if mso]>
		<style>
			* {
				font-family: sans-serif !important;
			}
		</style>
	<![endif]-->
	
	<!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
	<!--[if !mso]><!-->
		<!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
	<!--<![endif]-->

	<!-- Web Font / @font-face : END -->
	
	<!-- CSS Reset -->
    <style type="text/css">

		/* What it does: Remove spaces around the email design added by some email clients. */
		/* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
	        margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        
        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        
        /* What is does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }
        
        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
                
        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto; 
        }

        .table-info {
            margin-top: 15px !important;
        }
        
        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }
        
        /* What it does: A work-around for iOS meddling in triggered links. */
        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color:inherit !important;
            text-decoration: underline !important;
        }
      
    </style>
    
    <!-- Progressive Enhancements -->
    <style>
        
        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid,
            .fluid-centered {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            /* And center justify these ones. */
            .fluid-centered {
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }
        
            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
                
        }

    </style>

</head>
<body bgcolor="#e6eef4" width="100%" style="margin: 0;">
    <center style="width: 100%; background: #e6eef4;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            (Optional) This text will appear in the inbox preview, but not the email body.
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Email Header : BEGIN -->
        <table cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            <tr>
                <td style="padding: 20px 0; text-align: center">
                    <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/images/logo.png" width="230" height="100" alt="opemedios logo" border="0">
                </td>
            </tr>
        </table>
        <!-- Email Header : END -->

        <table cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            <tr>
                <td bgcolor="#ffffff" style="padding: 20px 0; text-align: center">
                    <h1 style="margin: 10px; padding-top: 30px; text-align: center;"><?= utf8_decode($new{'encabezado'}) ?></h1>                                
                </td>
            </tr>
        </table>
        
        <!-- Email Body : BEGIN -->
        <table cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            
            <!-- Hero Image, Flush : BEGIN -->
            <tr>
                <td bgcolor="#ffffff">
                    <?php //echo $file ?>
                </td>
            </tr>
            <!-- Hero Image, Flush : END -->

            <!-- 1 Column Text : BEGIN -->
            <tr>
                <td bgcolor="#ffffff" style="padding: 40px; text-align: justify; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                    <?= utf8_decode(cortarTexto($new['sintesis'], 200)) ?>
                    <table cellpadding="5" class="table-info" width="100%" >
                        <tr>
                            <td><strong>Autor: </strong> <?= $new['autor'] ?></td>
                            <td><strong>Sección: </strong> <?= $new['seccion'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Alcance: </strong> <?= $new['alcance'] ?></td>
                            <td><strong>Tendencia: </strong> <?= $new['tendencia'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Fuente: </strong> <?= $new['fuente'] ?></td>
                            <td><strong>Fecha: </strong> <?= $new['fecha'] ?></td>
                        </tr>
                    </table>
                    <br><br>
                    <!-- Button : Begin -->
                    <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                        <tr>
                            <td style="border-radius: 3px; background: #1c0e0e; text-align: center;" class="button-td">
                                <a href="http://<?= "{$_SERVER['HTTP_HOST']}/noticia/".strtolower($new['tipofuente'])."/{$new['id']}" ?>" target="_blank" style="background: #1c0e0e; border: 15px solid #1c0e0e; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff">Ver noticia completa</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                </a>
                            </td>
                        </tr>
                    </table>
                    <!-- Button : END -->
                </td>
            </tr>
            <!-- 1 Column Text : BEGIN -->
        </table>
        <!-- Email Body : END -->
          
        <!-- Email Footer : BEGIN -->
        <table cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            <tr>
                <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;">
                    <webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion>
                    <br><br>
                    Opemedios<br><span class="mobile-link--footer">Ures 69, Col. Roma Sur CP. 06760, México, DF, Del. Cuauhtémoc</span><br><span class="mobile-link--footer">+52 1 55 55846410</span>
                    <br><br> 
                    <unsubscribe style="color:#888888; text-decoration:underline;">unsubscribe</unsubscribe>
                </td>
            </tr>
        </table>
        <!-- Email Footer : END -->

    </center>
</body>
</html>
