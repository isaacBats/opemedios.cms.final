<?php $dev_src = ""; 

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport"    content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$new['sintesis']?>">
    <meta name="author"      content="<?= $new['autor'] ?>">

    <meta property="og:url"                content="<?=$actual_link?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?= $new['encabezado'] ?>" />
    <meta property="og:description"        content="<?=$new['autor'].', '.$new['fuente'].' - '.$new['sintesis']?>" />
    <meta property="og:image"              content="https://opemedios.mx/assets/images/share.jpg" />

    <meta property="og:site_name" content="Opemedios" />

    <title><?=$titleTab?></title>

    <link rel="shortcut icon" href="<?=$dev_src?>/assets/images/favicon.ico">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" media="screen" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="<?=$dev_src?>/assets/assets_client/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$dev_src?>/assets/assets_client/css/font-awesome.min.css">

    <!-- 2018
        <link rel="stylesheet" href="<?=$dev_src?>/assets/css/font-awesome.min.css">
    -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- /2018 -->

    <link rel="stylesheet" href="<?=$dev_src?>/assets/assets_client/css/bootstrap-theme.css">
    <?= $css ?>

    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="<?=$dev_src?>/assets/assets_client/css/main.css">
    <link href="<?=$dev_src?>/assets/assets_client/css/1-col-portfolio.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top headroom" >
        <div class="container">
            <div class="navbar-header">
                <!-- Button for smallest screens -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="/">
                    <img src="https://opemedios.mx/assets/assets_home/img/logo.png" alt="Opemedios" class="op-logo">
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right op-nav">
                    <?php if( !isset( $_SESSION['user'] ) ): ?>

                        <li><a href="/">Inicio</a></li>
                        <li><a href="/quienes-somos">Quiénes somos</a></li>
                        <li><a href="/clientes">Clientes</a></li>
                        <li><a href="/contacto">Contacto</a></li>
                        <li><a class="btn" href="/sign-in">Iniciar Sesión</a></li>
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
                                Columnas <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="/columnas-financieras">Columnas Financieras</a></li>
                                <li><a href="/columnas-politicas">Columnas Politicas</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a class="btn dropdown-toggle user" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="javascript:void(0);">
                                Reportes <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="/reporte/cliente">Noticias por cliente</a></li>
                                <li><a href="#">Reporte de notas por día</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a class="btn dropdown-toggle user" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="javascript:void(0);">
                                <?=$_SESSION['user']['usuario'] ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="/sign-out">Salir</a></li>
                            </ul>
                        </li>
                        
                    <?php endif; ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
    <!-- /.navbar -->
