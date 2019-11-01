<?php $dev_path = "https://opemedios.mx/assets/assets_home/";?>
<!DOCTYPE html>
<html lang="es">
    <head>
		<meta charset="utf-8">
		<meta name="viewport"    content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Operadora de Medios Informativos 2016">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $titleTab ?></title>
		<?= $css ?>
		<!-- Fonts -->
	    <link href='<?=$dev_path?>fonts/04.Geomanist_Regular_webfontkit/stylesheet.css' rel="stylesheet" type="text/css">
	    <link href='<?=$dev_path?>fonts/07.Geomanist_Bold_webfontkit/stylesheet.css' rel="stylesheet" type="text/css">
	    <!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!--Owl -->
		<link rel="stylesheet" href='<?=$dev_path?>jquery/owl/dist/assets/owl.carousel.min.css'>
		<link rel="stylesheet" href='<?=$dev_path?>jquery/owl/dist/assets/owl.theme.default.min.css'>
		<!-- Style -->
		<link href='<?=$dev_path?>css/style.css' media="all" rel="stylesheet" type="text/css">
	</head>
<body class="home">

	<header>
	<div class="container">
		<div class="row">
			<div class="col-6 col-sm-4">
				<figure class="logo"><img src='<?=$dev_path?>img/logo.png' class="img-fluid"></figure>
			</div>
			<div class="col-6 col-sm-8">
				<nav class="navbar navbar-dark d-md-none d-lg-none d-xl-none">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				</nav>
				<nav class="menu d-none d-md-block d-lg-block d-xl-block">
					<ul>
						<li><a href="https://opemedios.mx/sign-in" class="login">Iniciar Sesión</a></li>
						<li><a href="https://opemedios.mx/contacto">Contacto</a></li>
						<li><a href="https://opemedios.mx/clientes">Clientes</a></li>
						<li><a href="https://opemedios.mx/quienes-somos">Quiénes somos</a></li>
						<li><a href="https://opemedios.mx/" class="active">Inicio</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="collapse" id="navbarToggleExternalContent">
					<nav class="mobile  text-center">
						<?php if( !isset( $_SESSION['user'] ) ): ?>
						<ul>
							<li><a href="https://opemedios.mx/sign-in" class="login">Iniciar Sesión</a></li>
							<li><a href="https://opemedios.mx/contacto">Contacto</a></li>
							<li><a href="https://opemedios.mx/clientes">Clientes</a></li>
							<li><a href="https://opemedios.mx/quienes-somos">Quiénes somos</a></li>
							<li><a href="https://opemedios.mx/" class="active">Inicio</a></li>
						</ul>
						<?php else: ?>
						<ul>
							<li><a href="" class="login">Sesion iniciada</a></li>
							<li><a href="">Otro menu</a></li>
						</ul>
						<?php endif; ?>
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>
