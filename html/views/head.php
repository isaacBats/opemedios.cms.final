<head>
<meta charset="UTF-8">
<title>Alfonso Marina</title>

<?php if ( isset( $product ) ){ ?>
<!-- Meta tags de Facebook (Open Graph) -->
<!-- Con esta etiqueta declaramos el título que queremos que contenga al darle share -->
<meta property="og:title" content="<?php echo $product["nombre"] ?>" />
<!-- Con esta etiqueta mostramos una imagen al momento de dar share en facebook -->
<meta property="og:image" content="http://amarinav2.denumeris.com/<?php echo '/assets/images/product/'.$product['imagen']; ?>" />
<!-- Con esta etiqueta mostramos el nombre de nuestro sitio web al momento de dar share en facebook -->
<meta property="og:site_name" content="<?php echo $product["nombre"] ?>" />
<!-- Con esta etiqueta mostramos una descripción acerca de lo que trata nuestra página web al momento de dar share en facebook -->
<meta property="og:description" content="<?php echo $product["nombre"] ?>" />
<?php } ?>
<!-- Corre el sitio en modo full-screen dentro de los móbiles que lo soportan. -->
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- Hace que la barra de status aparezca negra con texto blanco en iphones. -->
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Deshabilita la detección automática de números de teléfono, es una cuestión de seguridad. -->
<meta name="format-detection" content="telephone=no">

<!-- Pone el sitio en el tamaño que debe ser y evita que el usuario pueda hacer zoom en la página. -->
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
     
<!-- Iconos para el navegador (los íconos que aparecen en los tabs y en los bookmarks) -->
<link rel="shortcut icon" href="/assets/images/icono.ico">
<link rel="bookmark" href="/assets/images/icono.ico">
    
<!-- Iconos para ipad e iphone (íconos que aparecen en el home al momento de guardar la página) -->
<!-- Ícono usado para iphone 3gs para atrás -->
<link rel="apple-touch-icon" href="/assets/images/icons/apple-touch-icon-precomposed.png">
<!-- Ícono usado en ipads de anterior generación -->
<link rel="apple-touch-icon" sizes="72x72" href="/assets/images/icons/apple-touch-icon-72x72-precomposed.png">
<!-- Ícono utilizado en iphone 4 para adelante -->
<link rel="apple-touch-icon" sizes="114x114" href="/assets/images/icons/apple-touch-icon-114x114-precomposed.png">
<!-- Ícono utilizado para ipads de nueva generación -->
<link rel="apple-touch-icon" sizes="144x144" href="/assets/images/icons/apple-touch-icon-144x144-precomposed.png">
    
<!-- Hojas de estilo base -->
<link rel="stylesheet" type="text/css" href="/assets/css/gallerific.css"><!-- Hoja de reset -->
<link rel="stylesheet" type="text/css" href="/assets/js/bower_components/jquery.fancybox/fancybox/jquery.fancybox-1.3.4.css"><!-- Hoja de reset -->

<link rel="stylesheet" type="text/css" href="/assets/css/style.css"><!-- Hoja personalizada -->

<!-- Librería de jquery que contiene también la librería de jquery tools -->
<script src="/assets/js/bower_components/jquery/jquery.js"></script>
<script src="/assets/js/bower_components/jquery.fancybox/fancybox/jquery.fancybox-1.3.4.js"></script>
<script src="/assets/js/bower_components/jquery.tools/src/tabs/tabs.js"></script>
<script src="/assets/js/bower_components/jquery.tools/src/tabs/tabs.slideshow.js"></script>
<script src="/assets/js/bower_components/jquery/jquery.validate.js"></script>
<script src="/assets/js/gallerific.js"></script>
<script src="/assets/js/custom.js"></script>

<!-- Código que sirve para que internet explorer rendereé correctamente las etiquetas de html5 -->
<!--[if IE]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

</head>