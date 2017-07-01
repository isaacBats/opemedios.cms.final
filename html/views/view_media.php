<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema Integral de Administración de Opemedios">
    <meta name="author" content="Isaac Batista">

    <title><?= $this->titleTab(); ?></title>
    
    <!-- Bootstrap Core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">    

  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <section class="container">
    	<?php require $header; ?>
        <center>
    		<?= $media; ?>
    	</center>
    	<footer class="footer">
    	    <div class="container">
    	    	<p class="text-muted text-center"> © Opemedios 2016</p>
    	    </div>
        </footer>	
        <script type="text/javascript" src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    </section>
</body>
</html>
