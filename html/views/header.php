<!DOCTYPE html>
<html>
    <?php require "head.php" ?>
<body class="home">
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="/"><img src="assets/images/logo.png" alt="Opemedios"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<?php if( !isset( $_SESSION['user'] ) ): ?>

						<li><a href="/">Inicio</a></li>
						<li><a href="/quienes-somos">Quiénes somos</a></li>
						<li><a href="/clientes">Clientes</a></li>
						<li><a href="/contacto">Contacto</a></li>
						<!-- <form class="navbar-form navbar-left" method="POST" action="/login">
							<div class="form-group">
						    	<input type="text" class="form-control" required="true" name="user" placeholder="Usuario">
						  	</div>
						  	<div class="form-group">
						    	<input type="password" class="form-control" required="true" name="password" placeholder="Contraseña">
						  	</div>
						  <button class="btn btn-default">Ingresar</button>
						</form> -->
						<li><a class="btn" href="/sign-in">Mi cuenta</a></li>
					<?php else: ?>
						<li><a href="/noticias">Noticias</a></li>
						<li class="dropdown">
							<a class="btn dropdown-toggle user" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="javascript:void(0);">
					        	Portadas
					        	<span class="caret"></span>
					      	</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								<li><a href="/primeras-planas">Primeras Planas</a></li>
								<li><a href="/portadas-financieras">Portadas Financieras</a></li>
								<li><a href="/cartones">Cartones</a></li>								
							</ul>
						</li>
						<li class="dropdown">
							<a class="btn dropdown-toggle user" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="javascript:void(0);">
					        	Columnas
					        	<span class="caret"></span>
					      	</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								<li><a href="/columnas-financieras">Columnas Financieras</a></li>
								<li><a href="/columnas-politicas">Columnas Politicas</a></li>
							</ul>
						</li>
						<li><a href="/reporte">Reporte</a></li>								
						<li>
							<div class="dropdown">
							 	<button class="btn dropdown-toggle user" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							    <?= $_SESSION['user']['usuario'] ?>
							    	<span class="caret"></span>
							  	</button>
							  	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								    <!-- <li><a href="#">Action</a></li>
								    <li><a href="#">Another action</a></li>
								    <li><a href="#">Something else here</a></li>
								    <li role="separator" class="divider"></li> -->
								    <li><a href="/sign-out">Salir</a></li>
							  </ul>
							</div>
						</li>
					<?php endif; ?>				
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	