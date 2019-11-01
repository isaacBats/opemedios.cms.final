<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Registrar Empresa</title>
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
                    <h1 class="u-h3 u-text-center u-mb-zero">Registrar Empresa</h1>
                </header>
                
                <form class="c-card__body" id="forma_registrar_empresa">

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">Nombre de la Empresa</label> 
                        <input class="c-input" type="text" id="input1" name="company_name"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input3">E-mail</label> 
                        <input class="c-input" type="email" id="input3" placeholder="nombre@empresa.com" name="company_email"> 
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input4">Teléfono</label> 
                                <input class="c-input" type="email" id="input4" name="company_phone"> 
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input4">Ext.</label> 
                                <input class="c-input" type="email" id="input4" name="company_ext"> 
                            </div>
                        </div>
                    </div>

                    <div class="c-field u-mb-medium">
                        <label class="c-field__label" for="select1">Delegación</label>

                        <!-- Select2 jquery plugin is used -->
                        <select class="c-select" id="select1" name="company_del">
                            <option>ALVARO OBREGON</option>
                            <option>AZCAPOTZALCO</option>
                            <option>BENITO JUAREZ</option>
                            <option>COYOACAN</option>
                            <option>CUAJIMALPA DE MORELOS</option>
                            <option>CUAUHTEMOC</option>
                            <option>GUSTAVO A MADERO </option>
                            <option>IZTACALCO</option>
                            <option>BENITO JUAREZ</option>
                            <option>BENITO JUAREZ</option>
                            <option>IZTAPALAPA</option>
                            <option>LA MAGDALENA CONTRERAS</option>
                            <option>MIGUEL HIDALGO</option>
                            <option>MILPA ALTA</option>
                            <option>TLAHUAC</option>
                            <option>TLALPAN</option>
                            <option>VENUSTIANO CARRANZA</option>
                            <option>XOCHIMILCO</option>
                        </select>
                    </div>

                     <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input4">Dirección</label> 
                        <textarea class="c-textarea" name="company_address"></textarea> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">Número de Empleados</label> 
                        <input class="c-input" type="number" id="input1" name="company_employees"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">Nombre del Representante</label> 
                        <input class="c-input" type="text" id="input1" name="company_nameUser"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">Apellido(s) del Representante</label> 
                        <input class="c-input" type="text" id="input1" name="company_lastNameUser"> 
                    </div>

                     <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input4">Comentarios</label> 
                        <textarea class="c-textarea" name="company_comments"></textarea> 
                    </div>

                    <button class="c-btn c-btn--info c-btn--fullwidth" type="submit" id="btn-registro-empresa" data-action="<?=base_url('index.php/users/registrar_empresa')?>">Registrar</button>
                    
                    <div class="c-alert c-alert--success w-none">
                        <i class="c-alert__icon fa fa-info-circle"></i> Su empresa ha sido registrada, pronto nos pondremos en contacto con usted
                    </div>
                    
                </form>
            </div>
        
        </div>

        <script src="<?=base_url('assets/system/dist/js/main.min.js')?>"></script>
        <script src="<?=base_url('assets/system/js/scripts.js')?>"></script>
    </body>
</html>