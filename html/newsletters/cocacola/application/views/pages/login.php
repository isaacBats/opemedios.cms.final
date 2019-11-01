<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Log in Horizontal | Dashboard UI Kit</title>
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

        <div class="o-page__card o-page__card--horizontal">
            <div class="c-card u-mb-xsmall c-login-horizontal">
                <div class="c-login__content-wrapper">
                    <header class="c-login__header">
                        <a class="c-login__icon c-login__icon--rounded c-login__icon--left" href="<?=base_url()?>">
                            <img src="<?=base_url('assets/system/dist/img/logo-login.svg')?>" alt="Dashboard's Logo">
                        </a>

                        <h2 class="c-login__title">Iniciar Sesión</h2>

                        
                    </header>


                    
                    <form class="c-login__content">

                        <? if ($activation['status'] == true): ?>
                            <div class="c-alert c-alert--success">
                                <i class="c-alert__icon fa fa-check-circle"></i> Correo Confirmado!
                            </div>
                        <? endif; ?>

                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="input1">Email</label> 
                            <input class="c-input" type="email" id="input1" placeholder="nombre@empresa.com"> 
                        </div>

                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="input2">Password</label> 
                            <input class="c-input" type="password" id="input2"> 
                        </div>

                        <button class="c-btn c-btn--success c-btn--fullwidth" type="submit">Iniciar Sesión</button>

                        <span class="c-divider u-mv-small"></span>

                        <a href="<?=base_url('index.php/users/registro')?>" class="c-btn c-btn--secondary c-btn--fullwidth">Crear Cuenta</a>
                    </form>
                </div>

                <div class="c-login__content-image">
                    <img src="<?=base_url('assets/system/dist/img/login2.jpg')?>" alt="Welcome to Dashboard UI Kit">

                    <h3>Bienvenido a  Workeat</h3>
                    <p class="u-text-large">An interface designed for freelancers to help them manage their work and clients. Created with Dashboard UI Kit.</p>
                </div>
            </div>
            <div class="o-line">
                <a class="u-text-mute u-text-small" href="<?=base_url('index.php/users/recuperar_password')?>">Recuperar Contraseña</a>
            </div>
        </div>

        <script src="<?=base_url('assets/system/dist/js/main.min.js')?>"></script>
        <script src="<?=base_url('assets/system/js/scripts.js')?>"></script>
    </body>
</html>