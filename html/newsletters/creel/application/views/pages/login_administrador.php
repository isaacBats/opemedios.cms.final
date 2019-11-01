<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Log in | Dashboard UI Kit</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?=base_url('assets/system/dist/css/main.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/system/css/style.css')?>">
    </head>
    <body class="o-page o-page--center">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <div class="o-page__card">
            <div class="c-card u-mb-xsmall">
                <header class="c-card__header u-pt-large">
                    <a class="c-card__icon" href="<?=base_url()?>">
                        <img src="<?=base_url('assets/system/dist/img/logo-login.svg')?>" alt="Dashboard UI Kit">
                    </a>
                    <h1 class="u-h3 u-text-center u-mb-zero">Administrador</h1>
                </header>
                
                <form class="c-card__body">
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">E-mail</label> 
                        <input class="c-input" type="email" id="input1"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input2">Password</label> 
                        <input class="c-input" type="password" id="input2"> 
                    </div>

                    <a href="<?=base_url('index.php/admin/dashboard')?>" class="c-btn c-btn--info c-btn--fullwidth">Iniciar Sesión</a>

                  
                </form>
            </div>
            <div class="o-line">
                <a class="u-text-mute u-text-small" href="<?=base_url('index.php/users/recuperar_password')?>">Recuperar Contraseña</a>
            </div>
           
        </div>

        <script src="<?=base_url('assets/system/dist/js/main.min.js')?>"></script>
        <script src="<?=base_url('assets/system/js/scripts.js')?>"></script>
    </body>
</html>