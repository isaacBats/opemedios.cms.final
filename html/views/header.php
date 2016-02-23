<?php
$sqldates = "SELECT DISTINCT DATE_FORMAT( DATE(created),'%M %Y') as datec FROM product where created <>'-' order by DATE(created) desc;";
$sqldates = $this->pdo->prepare($sqldates);
$sqldates->execute();
$dates = $sqldates->fetchAll(\PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
    <?php require "head.php" ?>
<body>
<div id="body">
	<header id="main-header">
		<a href="<?php echo $this->url( $lang , "/"); ?>"><h1>Alfonso Marina</h1></a>
		<nav id="main-nav">
			<ul>
				<li><a href="<?php echo $this->url( $lang , "/"); ?>"><?php echo $this->trans($lang , "Inicio" , "Home") ?></a></li>
				<li>
					<a href="javascript:void(0);"><?php echo $this->trans($lang ,  "Acerca de" ,  "About") ?></a>
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
                    <a href="<?php echo $this->url($lang, "/news") ?>">
                        <?php echo $this->trans($lang, "Noticias", "News") ?>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->url($lang, "/news") ?>">
                                <?php echo $this->trans($lang, "Noticias y Próximos Eventos", "News and Events") ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->url($lang, "/news") ?>">
                                <?php echo $this->trans($lang, "Nuevos Lanzamientos", "News Releases") ?>
                            </a>
                        </li>
                    </ul>
                </li>
				<li><a href="<?php echo $this->url($lang , "/gallery") ?>">
					<?php echo $this->trans($lang , "Galería" , "Gallery") ?></a></li>
                <li>
                	<a href="<?php echo $this->url($lang , "/press") ?>">
                	<?php echo $this->trans($lang , "Prensa" , "Press") ?></a>
                	<ul>
						<li>
							<a href="<?php echo $this->url($lang , "/press/publicity") ?>">
								<?php echo $this->trans($lang , "Publicidad" , "Publicity") ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/press/brochure") ?>">
								<?php echo $this->trans($lang , "Brochure" , "Brochure") ?>
							</a>
						</li>
					</ul>
                </li>
				<li><a href="<?php echo $this->url($lang , "/contact") ?>"><?php echo $this->trans($lang , "Contacto" , "Contact") ?></a></li>
			</ul>
		</nav><!-- #main-nav -->
		<div id="aux-nav">
			<nav>
				<ul>
					<?php if( isset( $_SESSION["user"] ) ) {?>
						<li><a href="<?php echo $this->url($lang , "/profile") ?>"><?php echo $_SESSION["user"]["nombre"] ?> </a> </li>
						<li> <a href="<?php echo $this->url($lang , "/logout") ?>"> <?php echo $this->trans($lang , "Salir", "Logout"); ?></a></li>
					<?php }else{
					?>	
						<li><a href="<?php echo $this->url($lang , "/register") ?>"><?php echo $this->trans($lang , "Registro", "Register"); ?></a></li>
						<li><a href="<?php echo $this->url($lang , "/login") ?>"><?php echo $this->trans($lang , "Iniciar Sesión", "Sign in"); ?></a></li>
					<?php
						} 
					?>
					
	            </ul>
	        </nav>
	        <br class="clear" />
	        <a href="<?php echo $this->url($lang , "/favs") ?>"><?php echo $this->trans($lang , "Mis Favoritos", "My Favorites"); ?></a>
	        <?php if( $lang == "es") {?>
	        <a href="javascript:void(0)" class="selected">ESP</a> -
	        <a href="<?php echo $this->url("en") ?>" >ENG</a>
	        <?php }else{ ?>
	        <a href="<?php echo $this->url("es") ?>" >ESP</a> -
	        <a href="javascript:void(0)" class="selected" >ENG</a>
	        <?php } ?>
	        
	        <?php require "browser.php" ?>
	    </div><!-- #aux-nav -->
	</header><!-- #main-header -->
	<div id="wrapper">
		<?php if( isset( $this ) ){ if( !$nobeard ) {?>
		<div class="breadcrumb vertical <?php echo isset( $bread_class )?$bread_class:""; ?>">
			 <?php $this->bread($lang ); ?>
		</div>
		<?php } }	?>