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

    
