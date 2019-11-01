<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Administrador</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?=base_url('assets/system/dist/css/main.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/system/css/style.css')?>">
    </head>
    <body class="o-page">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <div class="o-page__sidebar js-page-sidebar">
            <div class="c-sidebar">
                <a class="c-sidebar__brand" href="#">
                    <img class="c-sidebar__brand-img" src="<?=base_url('assets/system/dist/img/logo.png')?>" alt="Logo"> Dashboard
                </a>
                <h4 class="c-sidebar__title">Dashboards</h4>
                <ul class="c-sidebar__list">
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link is-active" href="<?=base_url('index.php/admin/empresas')?>">
                            <i class="fa fa-home u-mr-xsmall"></i>Empresas
                        </a>
                    </li>
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="<?=base_url('index.php/admin/usuarios')?>">
                            <i class="fa fa-home u-mr-xsmall"></i>Usuarios
                        </a>
                    </li>
                </ul>
                <h4 class="c-sidebar__title">Menu</h4>
                <ul class="c-sidebar__list">
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="<?=base_url('index.php/admin/categorias')?>">
                            <i class="fa fa-home u-mr-xsmall"></i>Categorias
                        </a>
                    </li>
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="<?=base_url('index.php/admin/menu')?>">
                            <i class="fa fa-home u-mr-xsmall"></i>Menu
                        </a>
                    </li>
                </ul>
            </div><!-- // .c-sidebar -->
        </div><!-- // .o-page__sidebar -->

        <main class="o-page__content">
            <header class="c-navbar u-mb-medium">
                <button class="c-sidebar-toggle u-mr-small">
                    <span class="c-sidebar-toggle__bar"></span>
                    <span class="c-sidebar-toggle__bar"></span>
                    <span class="c-sidebar-toggle__bar"></span>
                </button><!-- // .c-sidebar-toggle -->

                <h2 class="c-navbar__title u-mr-auto">Account</h2>
                
                <div class="c-dropdown u-hidden-down@mobile">
                    <a class="c-notification dropdown-toggle" href="#" id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="c-notification__icon">
                            <i class="fa fa-user-o"></i>
                        </span>
                        <span class="c-notification__number">3</span>
                    </a>

                    <div class="c-dropdown__menu c-dropdown__menu--large dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuUser">
                        <a href="#" class="c-dropdown__item dropdown-item o-media">
                            <span class="o-media__img u-mr-xsmall">
                                <span class="c-avatar c-avatar--xsmall">
                                    <img class="c-avatar__img" src="img/avatar2-72.jpg" alt="User's Profile Picture">
                                </span>
                            </span>
                            <div class="o-media__body">
                                <h6 class="u-mb-zero">Someone mentioned you</h6>
                                <p class="u-text-mute">You have recieved a mention on twitter, check it out!</p>
                            </div>
                        </a>
                        <a href="#" class="c-dropdown__item dropdown-item o-media">
                            <span class="o-media__img u-mr-xsmall">
                                <span class="c-avatar c-avatar--xsmall">
                                    <img class="c-avatar__img" src="img/avatar3-72.jpg" alt="User's Profile Picture">
                                </span>
                            </span>
                            <div class="o-media__body">
                                <h6 class="u-mb-zero">Recieved a Payment</h6>
                                <p class="u-text-mute">You have recieved a mention on twitter, check it out!</p>
                            </div>
                        </a>
                        <a href="#" class="c-dropdown__item dropdown-item o-media">
                            <span class="o-media__img u-mr-xsmall">
                                <span class="c-avatar c-avatar--xsmall">
                                    <img class="c-avatar__img" src="img/avatar4-72.jpg" alt="User's Profile Picture">
                                </span>
                            </span>
                            <div class="o-media__body">
                                <h6 class="u-mb-zero">You got a promotion</h6>
                                <p class="u-text-mute">You have recieved a mention on twitter, check it out!</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="c-dropdown dropdown u-mr-medium u-ml-small u-hidden-down@mobile">
                    <a class="c-notification dropdown-toggle" href="#" id="dropdownMenuAlerts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="c-notification__icon">
                            <i class="fa fa-bell-o"></i>
                        </span>
                        <span class="c-notification__number">3</span>
                    </a>

                    <div class="c-dropdown__menu c-dropdown__menu--large dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuAlerts">
                        <a href="#" class="c-dropdown__item dropdown-item o-media">
                            <span class="o-media__img u-mr-xsmall">
                                <span class="c-avatar c-avatar--xsmall">
                                    <span class="c-avatar__img u-bg-success u-flex u-justify-center u-align-items-center">
                                        <i class="fa fa-check u-text-large u-color-white"></i>
                                    </span>
                                </span>
                                
                            </span>
                            <div class="o-media__body">
                                <h6 class="u-mb-zero">Completed a task</h6>
                                <p class="u-text-mute">You have recieved a mention on twitter, check it out!</p>
                            </div>
                        </a>

                        <a href="#" class="c-dropdown__item dropdown-item o-media">
                            <span class="o-media__img u-mr-xsmall">
                                <span class="c-avatar c-avatar--xsmall">
                                    <span class="c-avatar__img u-bg-fancy u-flex u-justify-center u-align-items-center">
                                        <i class="fa fa-calendar u-text-large u-color-white"></i>
                                    </span>
                                </span>
                                
                            </span>
                            <div class="o-media__body">
                                <h6 class="u-mb-zero">Company meetup</h6>
                                <p class="u-text-mute">You have recieved a mention on twitter, check it out!</p>
                            </div>
                        </a>
                        <a href="#" class="c-dropdown__item dropdown-item o-media">
                            <span class="o-media__img u-mr-xsmall">
                                <span class="c-avatar c-avatar--xsmall">
                                    <span class="c-avatar__img u-bg-primary u-flex u-justify-center u-align-items-center">
                                        <i class="fa fa-info u-text-large u-color-white"></i>
                                    </span>
                                </span>
                                
                            </span>
                            <div class="o-media__body">
                                <h6 class="u-mb-zero">Someone mentioned you</h6>
                                <p class="u-text-mute">You have recieved a mention on twitter, check it out!</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="c-dropdown dropdown">
                    <a  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="c-avatar__img" src="<?=base_url('assets/system/dist/img/avatar-72.jpg')?>" alt="User's Profile Picture">
                    </a>

                    <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                        <a class="c-dropdown__item dropdown-item" href="#">Edit Profile</a>
                        <a class="c-dropdown__item dropdown-item" href="#">View Activity</a>
                        <a class="c-dropdown__item dropdown-item" href="#">Manage Roles</a>
                    </div>
                </div>
            </header>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="c-table">
                            <caption class="c-table__title">
                                Empresas <small>Sub title</small>
                            </caption>
                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">Empresa</th>
                                    <th class="c-table__cell c-table__cell--head">E-mail</th>
                                    <th class="c-table__cell c-table__cell--head">Teléfono</th>
                                    <th class="c-table__cell c-table__cell--head">Ext.</th>
                                    <th class="c-table__cell c-table__cell--head">Delegación</th>
                                    <th class="c-table__cell c-table__cell--head">Direccion</th>
                                    <th class="c-table__cell c-table__cell--head">Representante</th>
                                    <th class="c-table__cell c-table__cell--head">Comentarios</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($company as $fo) { echo 
                                    '<tr class="c-table__row">
                                        <td class="c-table__cell">'.$fo['company_name'].'</td>
                                        <td class="c-table__cell">'.$fo['company_email'].'</td>
                                        <td class="c-table__cell">'.$fo['company_phone'].'</td>
                                        <td class="c-table__cell">'.$fo['company_ext'].'</td>
                                        <td class="c-table__cell">'.$fo['company_del'].'</td>
                                        <td class="c-table__cell">'.$fo['company_address'].'</td>
                                        <td class="c-table__cell">'.$fo['company_nameUser'].' '.$fo['company_lastNameUser'].'</td>
                                        <td class="c-table__cell">'.$fo['company_comments'].'</td>
                                    </tr>'; } ?>
                            </tbody>
                        </table>
                    </div>

                    
                </div><!-- // .row -->

            </div><!-- // .container -->
            
        </main><!-- // .o-page__content -->
        
        <script src="<?=base_url('assets/system/dist/js/main.min.js')?>"></script>
        <script src="<?=base_url('assets/system/js/scripts.js')?>"></script>
    </body>
</html>