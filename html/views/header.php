<!doctype html>
<html>
<?php require "head.php" ?>
<body>

<div id="body">
	<header id="main-header">
		<a href="/"><h1>Alfonso Marina</h1></a>
		<nav id="main-nav">
			<ul>
				<li><a href="/"><?php echo $this->trans($lang , "Inicio" , "Home") ?></a></li>
				<li>
					<a href="javascript:void(0);"><?php echo $this->trans($lang , "About" , "Acerca de") ?></a>
					<ul>
						<li>
							<a href="<?php echo $this->url($lang , '/acerca-de/quienes-somos') ?>">
								<?php echo $this->trans($lang , "Qui&eacute;nes Somos" , "Who we are") ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , '/acerca-de/fabrica-alfonso-marina') ?>">
								<?php echo $this->trans($lang , "F&aacute;brica Alfonso Marina" , "Factory Alfonso Marina") ?>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0)"><?php echo $this->trans($lang , "Catálogo" , "Catalog") ?></a>
					<ul>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/products") ?>">
								<?php echo $this->trans($lang , "Productos" , "Products") ?>
							</a>
							<?php echo $this->catMenu( $lang ,  "" ) ?>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/finishes") ?>">
								<?php echo $this->trans($lang , "Acabados" , "Finishes") ?>
							</a>
							<ul>
								<li>
									<a href="<?php echo $this->url($lang , "/catalog/wood") ?>">
									<?php echo $this->trans($lang , "Acabados Madera" , "Wood Finishes") ?>
									</a>
								</li>
								<li>
									<a href="<?php echo $this->url($lang , "/catalog/painted") ?>">
									<?php echo $this->trans($lang , "Acabados Pintados" , "Painted Finishes") ?>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/product-care") ?>">
								<?php echo $this->trans($lang , "Cuidado de productos" , "Product Care") ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/new-products") ?>">
								<?php echo $this->trans($lang , "Productos Nuevos" , "New Products") ?>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="<?php echo $this->url($lang , "/news") ?>">
						<?php echo $this->trans($lang , "Noticias" , "News") ?>
					</a>
				</li>
				<li><a href="<?php echo $this->url($lang , "/gallery") ?>">
				<?php echo $this->trans($lang , "Galería" , "Gallery") ?></a></li>
                <li>
                	<a href="/press"><?php echo $this->trans($lang , "Prensa" , "Catalog") ?></a>
                	<ul>
						<li>
							<a href="/press/publicity">
								<?php echo $this->trans($lang , "Publicidad" , "Catalog") ?>
							</a>
						</li>
						<li>
							<a href="/press/brochure">
								<?php echo $this->trans($lang , "Brochure" , "Catalog") ?>
							</a>
						</li>
					</ul>
                </li>
				<li><a href="/contact"><?php echo $this->trans($lang , "Contacto" , "Catalog") ?></a></li>
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
	        <a href="<?php echo $this->url($lang , "/favs") ?>">Mis Favoritos</a>
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
	