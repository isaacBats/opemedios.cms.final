<!doctype html>
<html>
<?php require "head.php" ?>
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
				<li>
					<a href="javascript:void(0)">Catálogo</a>
					<ul>
						<li>
							<a href="/catalog/lifestyle">
								Estílo de vida
							</a>
						</li>
						<li>
							<a href="/catalog/products">
								Productos
							</a>
						</li>
						<li>
							<a href="/catalog/finishes">
								Acabados
							</a>
						</li>
						<li>
							<a href="/catalog/product-care">
								Cuidado de productos
							</a>
						</li>
						<li>
							<a href="/catalog/new-products">
								Productos Nuevos
							</a>
						</li>
					</ul>
				</li>
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
			<?php if( isset( $this ) ){ if( !$nobeard ) { $this->bread($lang ); } }?>
		</div>
	