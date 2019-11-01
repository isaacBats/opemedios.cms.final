<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Registro</title>
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
                    <h1 class="u-h3 u-text-center u-mb-zero">Registrate para Comenzar</h1>
                </header>
                
                <form class="c-card__body" id="forma_registrar_usuario">

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">Nombre</label> 
                        <input class="c-input" type="text" id="input1" name="user_name"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input2">Apellidos</label> 
                        <input class="c-input" type="text" id="input2" name="user_lastName"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="select1">Empresa</label>

                        <!-- Select2 jquery plugin is used -->
                        <select class="c-select" id="select1" name="user_company">
                            <?php foreach ($companies as $cat) { echo ' <option value="'.$cat['company_id'].'">'.$cat['company_name'].'</option>'; } ?>
                        </select>
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input3">E-mail</label> 
                        <input class="c-input" type="email" id="input3" placeholder="nombre@empresa.com" name="user_email"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input4">Teléfono</label> 
                        <input class="c-input" type="email" id="input4" name="user_phone"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input5">Password</label> 
                        <input class="c-input" type="password" id="input5" placeholder="Numeros, Letras..." name="user_password"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input6">Confirmar Password</label> 
                        <input class="c-input" type="password" id="input6" placeholder="Confirmar Password"> 
                    </div>

                    <button class="c-btn c-btn--info c-btn--fullwidth" type="submit" id="btn-registro-usuario" data-action="<?=base_url('index.php/users/registrar_usuario')?>">Registrar</button>
                    
                    <div class="c-alert c-alert--success w-none">
                        <i class="c-alert__icon fa fa-info-circle"></i> Favor de confirmar su correo para finzalizar el registro
                    </div>
                    
                </form>
            </div>

            <div class="o-line">
                <a class="u-text-mute u-text-small" href="<?=base_url('index.php/users/login')?>" title="Login">
                    <i class="fa fa-long-arrow-left u-mr-xsmall"></i> Ya tengo una cuenta, login 
                </a>
            </div>
        
        </div>

        <script src="<?=base_url('assets/system/dist/js/main.min.js')?>"></script>
        <script src="<?=base_url('assets/system/js/scripts.js')?>"></script>
    </body>
</html>