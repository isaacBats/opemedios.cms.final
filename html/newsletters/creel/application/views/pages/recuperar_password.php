<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Recuperar Contraseña</title>
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
                <header class="c-card__header u-text-center u-pt-large">
                    <a class="c-card__icon" href="<?=base_url()?>">
                       <img src="<?=base_url('assets/system/dist/img/logo-login.svg')?>" alt="Dashboard UI Kit">
                    </a>
                    <div class="row u-justify-center">
                        <div class="col-9">
                            <h1 class="u-h3">Recuperar Contraseña</h1>
                        </div>
                    </div>
                </header>
                
                <form class="c-card__body" id="forma-recuperar-password">
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">Email:</label>
                        <input class="c-input" type="email" id="input1" name="user_email"> 
                    </div>

                    <button class="c-btn c-btn--info c-btn--fullwidth u-mb-small" type="submit" id="btn-recuperar-password" data-action="<?=base_url('index.php/users/enviar_password')?>">Recuperar Contraseña</button>

                    <div class="c-alert c-alert--success w-none">
                        <i class="c-alert__icon fa fa-check-circle"></i> Contraseña Enviada
                    </div>
                </form>
            </div>

            <a class="u-text-mute u-text-small" href="<?=base_url('index.php/users/registro')?>">
                No tienes una cuenta aún? Registrate
            </a>
        </div>

        <script src="<?=base_url('assets/system/dist/js/main.min.js')?>"></script>
        <script src="<?=base_url('assets/system/js/scripts.js')?>"></script>
    </body>
</html>