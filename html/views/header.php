<!doctype html>
<html><head>
<meta charset="UTF-8">
<title>Alfonso Marina</title>

<!-- Meta tags de Facebook (Open Graph) -->
<!-- Con esta etiqueta declaramos el título que queremos que contenga al darle share -->
<meta property="og:title" content="Denumeris" />
<!-- Con esta etiqueta mostramos una imagen al momento de dar share en facebook -->
<meta property="og:image" content="" />
<!-- Con esta etiqueta mostramos el nombre de nuestro sitio web al momento de dar share en facebook -->
<meta property="og:site_name" content="Denumeris Interactive" />
<!-- Con esta etiqueta mostramos una descripción acerca de lo que trata nuestra página web al momento de dar share en facebook -->
<meta property="og:description" content="En Denumeris hacemos cosas" />

<!-- Corre el sitio en modo full-screen dentro de los móbiles que lo soportan. -->
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- Hace que la barra de status aparezca negra con texto blanco en iphones. -->
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Deshabilita la detección automática de números de teléfono, es una cuestión de seguridad. -->
<meta name="format-detection" content="telephone=no">

<!-- Pone el sitio en el tamaño que debe ser y evita que el usuario pueda hacer zoom en la página. -->
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
     
<!-- Iconos para el navegador (los íconos que aparecen en los tabs y en los bookmarks) -->
<link rel="shortcut icon" href="/images/icono.ico">
<link rel="bookmark" href="/images/icono.ico">
    
<!-- Iconos para ipad e iphone (íconos que aparecen en el home al momento de guardar la página) -->
<!-- Ícono usado para iphone 3gs para atrás -->
<link rel="apple-touch-icon" href="/images/icons/apple-touch-icon-precomposed.png">
<!-- Ícono usado en ipads de anterior generación -->
<link rel="apple-touch-icon" sizes="72x72" href="/images/icons/apple-touch-icon-72x72-precomposed.png">
<!-- Ícono utilizado en iphone 4 para adelante -->
<link rel="apple-touch-icon" sizes="114x114" href="/images/icons/apple-touch-icon-114x114-precomposed.png">
<!-- Ícono utilizado para ipads de nueva generación -->
<link rel="apple-touch-icon" sizes="144x144" href="/images/icons/apple-touch-icon-144x144-precomposed.png">
    
<!-- Hojas de estilo base -->
<link rel="stylesheet" type="text/css" href="/css/style.css"><!-- Hoja personalizada -->

<!-- Librería de jquery que contiene también la librería de jquery tools -->
<script src="/js/bower_components/jquery/jquery.js"></script>
<script src="/js/bower_components/jquery.tools/src/tabs/tabs.js"></script>
<script src="/js/bower_components/jquery.tools/src/tabs/tabs.slideshow.js"></script>
<script src="/js/bower_components/jquery/jquery.js"></script>
<script src="/js/bower_components/jquery/jquery.validate.js"></script>
<script src="/js/custom.js"></script>

<!-- Código que sirve para que internet explorer rendereé correctamente las etiquetas de html5 -->
<!--[if IE]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

</head>
<body>

<div id="body">
	<header id="main-header">
		<a href="/"><h1>Alfonso Marina</h1></a>
		<nav id="main-nav">
			<ul>
				<li><a href="/">Inicio</a></li>
				<li>
					<a href="javascript:void(0);">Acerca de</a>
					<ul>
						<li>
							<a href="/acerca-de/quienes-somos">
								Qui&eacute;nes Somos
							</a>
						</li>
						<li>
							<a href="/acerca-de/fabrica-alfonso-marina">
								F&aacute;brica Alfonso Marina
							</a>
						</li>
					</ul>
				</li>
				<li><a href="/catalog">Catálogo</a></li>
				<li><a href="/news">Noticias</a></li>
				<li><a href="/gallery">Galería</a></li>
                <li><a href="/press">Prensa</a></li>
				<li><a href="/contact">Contacto</a></li>
			</ul>
		</nav><!-- #main-nav -->
		<div id="aux-nav">
			<nav>
				<ul>
					<li><a href="/login">Sign in</a></li>
					<li><a href="/register">Registro</a></li>
	            </ul>
	        </nav>
	        <a href="javascript:void(0);">Mis Favoritos</a>
	        <a href="<?php echo $this->url("es") ?>" class="selected">ESP</a> -
	        <a href="<?php echo $this->url("en") ?>">ENG</a>
	        <div class="search-box">
	        	<form action="/" id="frmBuscar" novalidate="novalidate">
	        	   	<input type="text" autocomplete="off" maxlength="50" id="q" name="q" placeholder="Búsqueda" class="text-label">
	                <input type="submit" title="Buscar" value="Buscar">
					<div class="listadoProductosAutoCompletar" id="listadoProductosAutoCompletar"></div>
	               	<div style="clear:both;"></div>
	            </form>
	        </div><!-- .search-box -->
	    </div><!-- #aux-nav -->
	</header><!-- #main-header -->
	<div id="wrapper">
		<div class="breadcrumb vertical">
			<?php if( !$nobeard ) { $this->bread($lang ); } ?>
		</div>
	