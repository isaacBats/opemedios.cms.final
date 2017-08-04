<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Noticia Opemedios</title>
  
     <!-- You can use Open Graph tags to customize link previews.
      Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    <meta property="og:url"           content="http://<?= $_SERVER['HTTP_HOST'] ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?= $new['titulo'] ?>" />
    <meta property="og:description"   content="<?= $new['sintesisCorta'] ?>" />
    <meta property="og:image"         content="http://<?= $_SERVER['HTTP_HOST'] . $new['path_archivo'] ?>" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
      body {margin: 0; padding: 0; min-width: 100%!important;}
      .content {width: 100%; max-width: 600px;}
      /* ------------------------------------- 
        ELEMENTS 
      ------------------------------------- */
        .btn {
          text-decoration:none;
          color: #FFF;
          background-color: #5bc0de;
            border-color: #46b8da;
            border-radius: 4px;
          padding:10px 16px;
          font-weight:bold;
          margin-right:10px;
          text-align:center;
          cursor:pointer;
          display: inline-block;
        }
      /* --------------------------------
        HEADER
      ---------------------------------- */
        .header-image {
          display: block;
          margin-left: 25px;
        }
      /* --------------------------------
        BODY
      ---------------------------------- */
        .title {
          color: #2e5187;
          font-size: 20px;
          font-weight: bolder;
        }

        .title .hr-rojo {
          border: 3px solid #ba3433;
        }
        .title .hr-azul {
          border: 5px solid #09b7ec;
          margin-bottom: -9px;
        }
        .info-costo td {
          color: #c54e62;
          font-weight: bolder;
        }
        .info-noticia {
          /*padding-left: 80px;*/
        }
        .info-noticia p {
          background: #7FC9D4;
          margin: 10px auto;
          padding: 5px 0 5px 40px;
          width: 70%;
        }
        .footer-sociales {
          font-size: 20px;
          font-weight: bolder;
        }
        .footer-sociales-links {
          padding: 15px 0;
        }
        .footer-sociales-links a {
          padding: 5px;
        }

      /* ----------------------------------
        MEDIA QUERY
      ------------------------------------ */
        @media only screen and (min-device-width: 601px) {
          .content {max-width: 600px !important;}
        }
    </style>
  </head>
  <body style="margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td>
      <!--[if (gte mso 9)|(IE)]>
      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
          <![endif]-->
          <table class="content" align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
            <tr>
              <td bgcolor="#ffffff" style="padding-top: 10px; padding-right: 0; padding-bottom: 5px; padding-left: 0;" >
                <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/images/logo_150X40.png" alt="Opemedios" width="120" class="header-image" />
              </td>
              <td align="center" style="font-size: 20px; padding-top: 5px;">
                <?= $new['tipoFuente'] ?> / Noticia
              </td>
            </tr>
            <tr>
              <td>
                &nbsp;
              </td>
              <td align="center" style="padding-left: 40px;" >
                <?= $new['fecha'] ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" colspan="2" style="padding-top: 40px; padding-right: 30px; padding-bottom: 40px; padding-left: 30px;" >
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td class="title" >
                      <?= $new['titulo'] ?>
                      <hr class="hr-azul">
                      <hr class="hr-rojo">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Fuente: <?= ucfirst(strtolower($new['fuente'])) ?></strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding-top: 25px;">
                      <?= $new['sintesis'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" style="padding-top: 15px;">
                      <a href="<?= $new['urlOpemedios'] ?>" class="btn" >Ver noticia completa</a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="padding-top: 40px; padding-right: 30px; padding-left: 30px;" >
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr class="info-costo">
                    <td style="padding-left: 60px;">Costo Beneficio: $<?= number_format($new['cb'], 2, '.', ',') ?></td>
                    <td>Alcance: <?= $new['alcance'] ?></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="padding-top: 20px; padding-right: 30px; padding-bottom: 10px; padding-left: 30px;" >
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td class="info-noticia" >
                      <p>Reportero: <?= ucwords(strtolower($new['autor'])) ?></p>
                      <p>Genero: <?= $new['genero'] ?></p>
                      <p>Tendencia: <?= $new['tendencia'] ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td style=" padding-top: 10px; padding-left: 80px;">
                      <span>URL:</span>
                      <span style="color: #43a0bf; font-size: 0.8em">
                        <a style="text-decoration: none" href="<?= $new['url'] ?>" target="_blank"><?= url_mini($new['url']) ?>
                        </a>
                      </span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="padding: 30px 30px 30px 30px;" >
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr align="center">
                    <td class="footer-sociales">
                      Compartir en Redes Sociales
                    </td>
                  </tr>
                  <tr align="center" style="font-size: 30px;">
                    <td class="footer-sociales-links">
                      <div id="fb-root"></div>
                      <a href="" target="_blank" style="color: #1DA1F2; text-decoration: none;">
                        <i class="fa fa-twitter"></i>
                      </a>
                      <a href="javascript:void(0);" class="fb-share-button" data-href="http://<?= $_SERVER['HTTP_HOST'] ?>" data-layout="button_count" style="color: #3B5998; text-decoration: none; padding-left: 12px; padding-right: 12px">
                        <i class="fa fa-facebook"></i>
                      </a>
                      <a href="" style="color: #262626; text-decoration: none;"><i class="fa fa-instagram"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td align="center" style="font-size: 10px">
                      <a target="_blank" style="text-decoration: none;" href="http://<?= $_SERVER['HTTP_HOST'] ?>">Copyright &copy; 2016, Opemedios</a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
      <!--[if (gte mso 9)|(IE)]>
          </td>
        </tr>
      </table>
      <![endif]-->
        </td>
      </tr>
    </table>
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
  </body>
</html>