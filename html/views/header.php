<!doctype html>
<html>
<?php require "head.php" ?>
<body>

<div id="body">
	<header id="main-header">
		<a href="<?php echo $this->url($lang , "/"); ?>"><h1>Alfonso Marina</h1></a>
		<nav id="main-nav">
			<ul>
				<li><a href="<?php echo $this->url($lang , "/"); ?>">Inicio</a></li>
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
							<ul>
								<li>
									<a href="/catalog/casual">
										Casual
									</a>
									<?php echo $this->catMenu( $lang ,  "casual" ) ?>
								</li>
								<li>
									<a href="/catalog/metro">
										Metro
									</a>
									<?php echo $this->catMenu( $lang ,  "metro" ) ?>
								</li>
							</ul>
						</li>
						<li>
							<a href="/catalog/productos">
								Productos
							</a>
							<?php echo $this->catMenu( $lang ,  "" ) ?>
						</li>
						<li>
							<a href="/catalog/finishes">
								Acabados
							</a>
							<ul>
								<li>
									<a href="/catalog/wood">
									Acabados Madera
									</a>
								</li>
								<li>
									<a href="/catalog/painted">
									Acabados Pintados
									</a>
								</li>
							</ul>
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
                <li>
                	<a href="/press">Prensa</a>
                	<ul>
						<li>
							<a href="/press/publicity">
								Publicidad
							</a>
						</li>
						<li>
							<a href="/press/brochure">
								Brochure
							</a>
						</li>
					</ul>
                </li>
				<li><a href="/contact">Contacto</a></li>
			</ul>
		</nav><!-- #main-nav -->
		<div id="aux-nav">
			<nav>
				<ul>
					<?php if( isset( $_SESSION["user"] ) ) {?>
						<li>Saludos - <?php echo $_SESSION["user"]["nombre"] ?> &nbsp;</li>
						<li> <a href="/logout">Salir</a></li>
					<?php }else{
					?>	
						<li><a href="/register">Registro</a></li>
						<li><a href="/login">Sign in</a></li>
					<?php
						} 
					?>
					
	            </ul>
	        </nav>
	        <br class="clear" />
	        <a href="<?php echo $this->url($lagn , "/favs") ?>">Mis Favoritos</a>
	        <a href="<?php echo $this->url("es") ?>" class="selected">ESP</a> -
	        <a href="<?php echo $this->url("en") ?>">ENG</a>
	        <?php require "browser.php" ?>
	    </div><!-- #aux-nav -->
	</header><!-- #main-header -->
	<div id="wrapper">
		<?php if( isset( $this ) ){ if( !$nobeard ) {?>
		<div class="breadcrumb vertical">
			 <?php $this->bread($lang ); ?>
		</div>
		<?php } }	?>