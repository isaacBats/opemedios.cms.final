<?php


/**
*  Controlador de noticias
*/

class Noticias extends Controller
{
	
	/**
	 * Este es el template base para las funciones
	 * @param string $lang 
	 * @param integer $id 
	 * @return string
	 */
	function mostrarTodas($lang="es",$id=null){
		
		$html = $this->cabecera();

		if( $id == null ){
			if ($lang == "es"){
				$sql = "SELECT * FROM noticias";
				$query = $this->pdo->prepare($sql);
				$rs = $query->execute();
				if($rs!==false){
					$nr = $query->rowCount();
					if( $nr > 0 ){
						$noticias = $query->fetchAll();
						foreach ($noticias as $noticia) {
							$html .= '<div class="listado">
										<div class="list-item">
							                <div class="img-listado">
												<a href="noticias-detalle.html">
							                    	<img src="../images/'.$noticia['imagen'].'" alt="">
												</a>
							                </div>
							                <div class="texto-listado">
							                    <a href="noticias-detalle.html"><h2>'.$noticia['titulo'].'</h2></a>
							                    '.$noticia['extracto'].'
							                    <p>
							                    	<a href="noticias-detalle.html">[ + ] Leer Todo</a>
							                    </p>
							                </div>
							                <br class="clear">
							            </div>
							         </div>';
						}
					}
				}
			}
			else if ($lang == "en") {
				$html .= 'Devuelve en inglés';
			}
			else
			{
				$html .= 'No existe lang';
			}
		}
		else{
			
		}

		$html .= $this->footer();

		return $html;
	}

	function footer(){
		$html = '
				<br class="clear"/>
	            </div>
						<footer id="main-footer">
							<footer id="inner-footer">
								<form >    
									<div id="newsletter">
						        		<input type="email" value="" placeholder="Email" name="Email" id="Email" data-val-required="The Email field is required." data-val-regex-pattern="^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$" data-val-regex="*" data-val="true" class="text-label">
						        		<input type="submit" id="news-submit" value="Suscribir" name="Submit">
						    		</div><!-- #newsletter --> 
								</form>
						        <p>&copy;Alfonso Marina Ebanista. Derechos Reservados 2015.</p>
						        <div id="social-media">
						        	<span class="tagline">Síguenos:</span>
				                    <a class="btn-social facebook" href="https://www.facebook.com/pages/Alfonso-Marina-Ebanista/216426771801026?ref=aymt_homepage_panel" target="_blank">Facebook</a>
				                    <a class="btn-social twitter" href="https://twitter.com/alfonsomarinamx" target="_blank">Twitter</a>
				                    <a class="btn-social pinterest" href="http://pinterest.com/alfonsomarina/boards/" target="_blank">Pinterest</a>
				                    <a class="btn-social instagram" href="http://instagram.com/alfonsomarinamx" target="_blank">Instagram</a>
				                    <a class="btn-social dh" href="http://www.deringhall.com/designers/Alfonso-marina-ebanista" target="_blank">Dering Hall</a>
				                </div><!-- #social-media -->
				            </footer><!-- #main-footer -->
				        </footer><!-- #inner-footer -->
				</div><!-- #body -->
				</body>
				</html>';
		return $html;
	}

	function cabecera(){
	$html = '<!doctype html>
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
				<link rel="shortcut icon" href="images/icono.ico">
				<link rel="bookmark" href="images/icono.ico">
				    
				<!-- Iconos para ipad e iphone (íconos que aparecen en el home al momento de guardar la página) -->
				<!-- Ícono usado para iphone 3gs para atrás -->
				<link rel="apple-touch-icon" href="images/icons/apple-touch-icon-precomposed.png">
				<!-- Ícono usado en ipads de anterior generación -->
				<link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-touch-icon-72x72-precomposed.png">
				<!-- Ícono utilizado en iphone 4 para adelante -->
				<link rel="apple-touch-icon" sizes="114x114" href="images/icons/apple-touch-icon-114x114-precomposed.png">
				<!-- Ícono utilizado para ipads de nueva generación -->
				<link rel="apple-touch-icon" sizes="144x144" href="images/icons/apple-touch-icon-144x144-precomposed.png">
				    
				<!-- Hojas de estilo base -->
				<link rel="stylesheet" type="text/css" href="../css/style.css"><!-- Hoja personalizada -->

				<!-- Librería de jquery que contiene también la librería de jquery tools -->

				<script src="../../bower_components/jquery/jquery.js"></script>
				<script src="../js/custom.js"></script>

				<!-- Código que sirve para que internet explorer rendereé correctamente las etiquetas de html5 -->
				<!--[if IE]>
				<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
				<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
				<![endif]-->

				</head>
				<body>

				<div id="body">
					<header id="main-header">
						<h1><a href="index.html">Alfonso Marina</a></h1>
						<nav id="main-nav">
							<ul>
								<li><a href="index.html">Inicio</a></li>
								<li><a href="quienes-somos.html">Acerca de</a></li>
								<li><a href="portada.html">Catálogo</a></li>
								<li><a href="noticias.html">Noticias</a></li>
								<li><a href="galeria.html">Galería</a></li>
				                <li><a href="prensa.html">Prensa</a></li>
								<li><a href="contacto.html">Contacto</a></li>
							</ul>
						</nav><!-- #main-nav -->
						<div id="aux-nav">
							<nav>
								<ul>
									<li><a href="login.html">Sign in</a></li>
									<li><a href="javascript:void(0);">Registro</a></li>
					            </ul>
					        </nav>
					        <a href="javascript:void(0);">Mis Favoritos</a>
					        <a href="javascript:void(0);" class="selected">ESP</a> -
					        <a href="javascript:void(0);">ENG</a>
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
							<a href="index.html">Inicio</a> <span class="breadPipe">|</span> Noticias
						</div>
					';

				return $html;

				}

}

