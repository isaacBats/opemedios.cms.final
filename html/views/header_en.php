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
							<ul>
								<li>
									<a href="<?php echo $this->url( $lang , "/catalog/casual" ) ?>">Casual</a>
									<?php echo $this->catMenu( $lang ,  "casual" ) ?>
								</li>
								<li>
									<a href="<?php echo $this->url( $lang , "/catalog/metro" ) ?>">Metro</a>
									<?php echo $this->catMenu( $lang ,  "metro" ) ?>
								</li>
							</ul>

						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/products") ?>">
								Products
							</a>
							<?php echo $this->catMenu( $lang ,  "" ) ?>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/catalog/finishes") ?>">
								Finishes
							</a>
							<ul>
								<li>
									<a href="<?php echo $this->url($lang , "/catalog/wood") ?>">
									Wood Finishes
									</a>
								</li>
								<li>
									<a href="<?php echo $this->url($lang , "/catalog/painted") ?>">
									Painted Finishes
									</a>
								</li>
							</ul>
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
                <li>
                	<a href="<?php echo $this->url($lang , "/press") ?>">Press</a>
            		<ul>
            			<li>
						<a href="<?php echo $this->url($lang , "/press/publicity") ?>">
								Publicity
							</a>
						</li>
						<li>
							<a href="<?php echo $this->url($lang , "/press/brochure") ?>">
								Brochure
							</a>
						</li>
            		</ul>
                </li>

                
				<li><a href="<?php echo $this->url($lang , "/contact") ?>">Contact</a></li>
			</ul>
		</nav><!-- #main-nav -->
		<div id="aux-nav">
			<nav>
				
					

					<ul>
						<?php if( isset( $_SESSION["user"] ) ) {?>
							<li>Greetings - <?php echo $_SESSION["user"]["nombre"] ?> &nbsp;</li>
							<li> <a href="/logout">Logout</a></li>
						<?php }else{
						?>	
							<li><a href="<?php echo $this->url($lang , "/login") ?>">Sign in</a></li>
							<li><a href="<?php echo $this->url($lang , "/register") ?>">Registro</a></li>
						<?php
							} 
						?>
		            </ul>
	        </nav>
	        <a href="javascript:void(0);">My Favorites</a>
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
	