<!doctype html>
<html>
<?php require "head.php" ?>
<body>

<div id="body">
	<header id="main-header">
		<a href="/"><h1>Alfonso Marina</h1></a>
		<nav id="main-nav">
			<ul>
				<li><a href="<?php echo $this->url($lang , '/') ?>/">Home</a></li>
				<li>
					<a href="javascript:void(0);">About</a>
					<ul>
						<li>
							<a href="<?php echo $this->url($lang , '/acerca-de/quienes-somos') ?>">
								Who we are
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , '/acerca-de/fabrica-alfonso-marina') ?>">
								Factory Alfonso Marina
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0) ?>">Catalog</a>
					<ul>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/lifestyle") ?>">
								Lifestyle
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/products") ?>">
								Products
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/finishes") ?>">
								Finishes
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/product-care") ?>">
								Product Care
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/new-products") ?>">
								New Products
							</a>
						</li>
					</ul>
				</li>
				<li><a href="<?php echo $this->url($lang , "/news") ?>">News</a></li>
				<li><a href="<?php echo $this->url($lang , "/gallery") ?>">Gallery</a></li>
                <li><a href="<?php echo $this->url($lang , "/press") ?>">Press</a></li>
				<li><a href="<?php echo $this->url($lang , "/contact") ?>">Contact</a></li>
			</ul>
		</nav><!-- #main-nav -->
		<div id="aux-nav">
			<nav>
				<ul>
					<li><a href="<?php echo $this->url($lang , "/login") ?>">Sign in</a></li>
					<li><a href="<?php echo $this->url($lang , "/register") ?>">Registro</a></li>
	            </ul>
	        </nav>
	        <a href="javascript:void(0);">Mis Favoritos</a>
	        <a href="<?php echo $this->url("es") ?>" >ESP</a> -
	        <a href="<?php echo $this->url("en") ?>" class="selected">ENG</a>
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
	