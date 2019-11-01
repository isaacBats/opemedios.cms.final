<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Workeat</title>
	<link rel="apple-touch-icon" sizes="57x57" href="assets/home/icons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/home/icons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/home/icons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/home/icons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/home/icons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/home/icons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/home/icons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/home/icons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/home/icons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="assets/home/icons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/home/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/home/icons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/home/icons/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="assets/home/icons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Owl -->
	<link rel="stylesheet" href="assets/node_modules/owl.carousel2/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/node_modules/owl.carousel2/dist/assets/owl.theme.default.min.css">
	<!-- Common -->
	<link rel="stylesheet" href="<?=base_url('assets/home/css/style.css')?>">
</head>
<body>
<div class="h-contact">
	<div class="container">
		<div class="row">
			<div class="col">
				<span class="right">¿ Tienes alguna duda ?</span>
				<span class="right"><i class="fas fa-phone"></i><span class="left">55 54605054</span></span>
				<span class="right"><i class="fas fa-envelope"></i><span class="left">contacto@workeat.com</span></span>
				<span class="right"><span class="left"><a href="<?=base_url('index.php/users/registro_empresas')?>">Empresas</a></span></span>
				<div class="links text-center in"><i class="fab fa-linkedin-in fa-lg"></i></div>
				<div class="links text-center insta"><i class="fab fa-instagram fa-lg"></i></div>
				<div class="links text-center fb"><i class="fab fa-facebook-f fa-lg"></i></div>
			</div>
		</div>
	</div>
</div>
<header>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<figure class="logo"><img src="assets/home/img/logo.svg"></figure>
			</div>
			<div class="col-sm-8">
				<nav>
					<ul>
						<li><a href="<?=base_url('index.php/users/login')?>"><button class="login">Iniciar Sesión</button></a></li>
						<li><a href="<?=base_url('index.php/users/registro')?>"><button class="sign">Registro</button></a></li>
						<li><a href="#">Menu</a></li>
						<li><a href="#">Quiénes somos</a></li>
						<li><a href="#">Inicio</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>
<section class="h-sliders owl-one owl-carousel  owl-theme text-center">
	<div class="slider cero">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-sm-8">
					<h1>TITULO SLIDER NO 1</h1>
					<p class="p-big">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="slider one">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-sm-8">
					<h1>TITULO SLIDER NO 2</h1>
					<p class="p-big">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="slider two">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-sm-8">
					<h1>TITULO SLIDER NO 3</h1>
					<p class="p-big">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="home-food">
	<div class="container">
		<div class="row">
			<div class="col">
				<h2 class="text-center">Platillos populares esta semana</h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="item">
					<figure>
						<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
						<img src="<?=base_url('assets/food/c1.jpg')?>" class="img-fluid"></figure>
					<div class="title">
						<p><span class="name">Nombre Platillo 1</span><br><span class="cat">Categoría</span></p>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="item">
					<figure>
						<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
						<img src="<?=base_url('assets/food/c2.jpg')?>" class="img-fluid"></figure>
					<div class="title">
						<p><span class="name">Nombre Platillo 2</span><br><span class="cat">Categoría</span></p>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="item">
					<figure>
						<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
						<img src="<?=base_url('assets/food/c3.jpg')?>" class="img-fluid"></figure>
					<div class="title">
						<p><span class="name">Nombre Platillo 3</span><br><span class="cat">Categoría</span></p>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="item">
					<figure>
						<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
						<img src="<?=base_url('assets/food/c4.jpg')?>" class="img-fluid"></figure>
					<div class="title">
						<p><span class="name">Nombre Platillo 4</span><br><span class="cat">Categoría</span></p>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="item">
					<figure>
						<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
						<img src="<?=base_url('assets/food/c5.jpg')?>" class="img-fluid"></figure>
					<div class="title">
						<p><span class="name">Nombre Platillo 5</span><br><span class="cat">Categoría</span></p>
					</div>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col text-center">
				<button type="" class="btn-rounded blue">Ver Menu Completo</button>
			</div>
		</div>
	</div>
</section>
<section class="home-steps">
	<div class="owl-two owl-carousel  owl-theme">
		<div class="container">
			<div class="row text-center">
				<div class="col-sm-6">
					<div class="item pad">
						<div class="icon"><img src="assets/home/img/1a.png"></div>
						<h3><span class="color-blue">1.</span> Elige tus comidas</h3>
						<div></div>
						<p>Para realizar tu pedido debes seleccionar tus 3 tiempos. Escoge tu entrada, tu guarnición y plato fuerte.</p>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="item pad">
						<div class="icon"><img src="assets/home/img/2a.png"></div>
						<h3><span class="color-blue">2.</span> Programa tus comidas</h3>
						<div></div>
						<p>Una vez que escojas tus comidas, podrás elegir los días en los cuales recibirás cada una de las comidas que elegiste.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row text-center">	
				<div class="col-sm-6">
					<div class="item pad">
						<div class="icon"><img src="assets/home/img/3a.png"></div>
						<h3><span class="color-blue">3.</span> Hora de la comida</h3>
						<div></div>
						<p>Recibe tus comidas los días programados en un horario de 12 a 13:30 hrs.</p>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="item pad">
						<div class="icon"><img src="assets/home/img/4a.png"></div>
						<h3><span class="color-blue">4.</span> Solo calienta y disfruta</h3>
						<div></div>
						<p>Tu comida llegará en un práctico “toper” con el cual podrás calentar en microondas para disfrutar de tu comida, tu tiempo y de tus compañeros</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="home-test d-none">
	<div>
		<div class="container">
			<div class="row text-center">
				<div class="col-sm-3">
					<div class="item pad">
						<div class="icon"><img src="assets/home/img/1.png"></div>
						<span class="bold"><span class="color-blue">1.</span> Elige tus comidas</span>
						<div></div>
						<p>Para realizar tu pedido debes seleccionar tus 3 tiempos. Escoge tu entrada, tu guarnición y plato fuerte.</p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item pad">
						<div class="icon"><img src="assets/home/img/2.png"></div>
						<span class="bold"><span class="color-blue">2.</span> Programa tus comidas</span>
						<div></div>
						<p>Una vez que escojas tus comidas, podrás elegir los días en los cuales recibirás cada una de las comidas que elegiste.</p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item pad">
						<div class="icon"><img src="assets/home/img/3.png"></div>
						<span class="bold"><span class="color-blue">3.</span> Hora de la comida</span>
						<div></div>
						<p>Recibe tus comidas los días programados en un horario de 12 a 13:30 hrs.</p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item pad">
						<div class="icon"><img src="assets/home/img/4.png"></div>
						<span class="bold"><span class="color-blue">4.</span> Solo calienta y disfruta</span>
						<div></div>
						<p>Tu comida llegará en un práctico “toper” con el cual podrás calentar en microondas para disfrutar de tu comida, tu tiempo y de tus compañeros</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="home-test d-none">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="item">
						<div class="num">1</div>
						<div class="icon-2"><img src="assets/home/img/1.png"></div>
						<div class="pad">
							<span class="bold">Elige tus comidas</span>
							<div></div>
							<p>Para realizar tu pedido debes seleccionar tus 3 tiempos. Escoge tu entrada, tu guarnición y plato fuerte.</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item">
						<div class="num">2</div>
						<div class="icon-2"><img src="assets/home/img/2.png"></div>
						<div class="pad">
							<span class="bold">Programa tus comidas</span>
							<div></div>
							<p>Una vez que escojas tus comidas, podrás elegir los días en los cuales recibirás cada una de las comidas que elegiste.</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item">
						<div class="num">3</div>
						<div class="icon-2"><img src="assets/home/img/3.png"></div>
						<div class="pad">
							<span class="bold">Hora de la comida</span>
							<div></div>
							<p>Recibe tus comidas los días programados en un horario de 12 a 13:30 hrs.</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item">
						<div class="num">4</div>
						<div class="icon-2"><img src="assets/home/img/4.png"></div>
						<div class="pad">
							<span class="bold">Solo calienta y disfruta</span>
							<div></div>
							<p>Tu comida llegará en un práctico “toper” con el cual podrás calentar en microondas para disfrutar de tu comida, tu tiempo y de tus compañeros</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="home-we">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h2>Acerca de Nosotros</h2>
				<p>En Workeat sabemos las necesidades que tienen los empleados a la hora de buscar comida, así como tú, nosotros también fuimos Godínez; es por ello que en Workeat nos preocupamos por brindarte un excelente servicio, porciones necesarias, precios accesibles y sobretodo, un exquisito sabor hogareño.</p>
				<button class="btn-rounded white">Conocenos</button>
			</div>
			<div class="col-sm-6 adjust">
				<img src="assets/home/img/site-img01.png" class="img-fluid">
			</div>
		</div>
	</div>
</section>
<footer>
	<div class="container">
    	<div class="row">
        	<div class="col-sm-8">
            	<p><span class="bold color-blue">&#169; <?=date('Y')?> WORKEAT S.A. de C.V.</span>  <span class="legal-spacer">|</span> Aviso de Privacidad<span class="legal-spacer">|</span> Términos y Condiciones</p>
            </div>
        </div>
    </div>
</footer>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Font Awasome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
<!-- Owl -->
<script src="<?=base_url('assets/node_modules/owl.carousel2/dist/owl.carousel.js')?>"></script>
<!-- Common -->
<script src="<?=base_url('assets/home/js/scripts.js')?>"></script>
</body>
</html>