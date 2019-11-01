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
                        <a class="c-sidebar__link" href="<?=base_url('index.php/admin/empresas')?>">
                            <i class="fa fa-home u-mr-xsmall"></i>Empresas
                        </a>
                    </li>
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link " href="<?=base_url('index.php/admin/usuarios')?>">
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
                        <a class="c-sidebar__link is-active" href="<?=base_url('index.php/admin/menu')?>">
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

                <h2 class="c-navbar__title u-mr-auto">Menu</h2>
                
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
                                <div class="c-dropdown dropdown">
                                    <button class="c-btn c-btn--secondary has-dropdown dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtrar</button>
                                    <div class="c-dropdown__menu dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php foreach ($categories as $cat) {
                                        echo 
                                        ' <a href="'.base_url('index.php/panel/food/filter/').$cat['category_id'].'" class="c-dropdown__item dropdown-item">'.$cat['category_name'].'</a> ';
                                        } ?>
                                    </div>
                                </div>
                                <a class="c-btn c-btn--blue u-ml-auto" href="#" data-toggle="modal" data-target="#modal1">Añadir Platillo</a>
                            </caption>
                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">Imagen</th>
                                    <th class="c-table__cell c-table__cell--head">Clave</th>
                                    <th class="c-table__cell c-table__cell--head">Categoría</th>
                                    <th class="c-table__cell c-table__cell--head">Nombre</th>
                                    <th class="c-table__cell c-table__cell--head">Descripción</th>
                                    <th class="c-table__cell c-table__cell--head">Status</th>
                                    <th class="c-table__cell c-table__cell--head">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($food as $fo) {
                                    if( $fo['food_status'] == 0 ) {
                                        $status = '<a href="'.base_url('index.php/admin/activar_platillo/'.$fo['food_id']).'"><span class="c-badge c-badge--warning c-badge--small">Inactivo</span></a>';
                                    }
                                    else 
                                    {
                                        $status = '<a href="'.base_url('index.php/admin/desactivar_platillo/'.$fo['food_id']).'"><span class="c-badge c-badge--success c-badge--small">Activo</span></a>';
                                    }
                                    $resultado = substr($fo['category_name'], 0, 2);
                                    echo 
                                    '<tr>
                                        <td class="c-table__cell">
                                            <div class="c-avatar c-avatar--xsmall">
                                                <img class="c-avatar__img" src="'.base_url('assets/food').'/'.$fo['food_thumb'].'"">
                                            </div>
                                        </td>
                                        <td class="c-table__cell">'.$resultado.'P00'.$fo['food_id'].'</td>
                                        <td class="c-table__cell">'.$fo['category_name'].'</td>
                                        <td class="c-table__cell">'.$fo['food_name'].'</td>
                                        <td class="c-table__cell">'.$fo['food_description'].'</td>
                                        <td class="c-table__cell">'.$status.'</td>
                                        <td class="c-table__cell">
                                            <a href="'.base_url('index.php/panel/thumb_food/'.$fo['food_id']).'"><span class="c-badge c-badge--info c-badge--small">Subir imagen</span></a> 
                                            <a href="'.base_url('index.php/panel/edit_food/'.$fo['food_id']).'"><span class="c-badge c-badge--info c-badge--small">Editar</span></a> 
                                            <a href="'.base_url('index.php/admin/borrar_platillo/'.$fo['food_id']).'"><span class="c-badge c-badge--danger c-badge--small">Borrar</span></a> 
                                        </td>
                                    </tr>';
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    
                </div><!-- // .row -->

            </div><!-- // .container -->
            
        </main><!-- // .o-page__content -->

        <!-- Modal -->
        <div class="c-modal c-modal--xsmall modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" data-backdrop="static">
            <div class="c-modal__dialog modal-dialog" role="document">
                <div class="c-modal__content">
                    <div class="c-modal__header">
                        <h3 class="c-modal__title">Añadir Platillo</h3>
                        <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </span>
                    </div>
                    <div class="c-modal__body">
                        <form id="forma-registro-platillo">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="select1">Categoría</label>
                                <select class="c-select" id="select1" name="food_category">
                                    <?php foreach ($categories as $cat) { echo ' <option value="'.$cat['category_id'].'">'.$cat['category_name'].'</option>'; } ?>
                                </select>
                            </div>
                             <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input1">Nombre del Platillo</label> 
                                <input class="c-input" type="text" id="input1" name="food_name" maxlength="100"> 
                            </div>
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input4">Descripción del Platillo</label> 
                                <textarea class="c-textarea" name="food_description" maxlength="255"></textarea> 
                            </div>
                            <button class="c-btn c-btn--info c-btn--fullwidth u-mb-small" type="submit" id="btn-registro-platillo" data-action="<?=base_url('index.php/admin/registrar_platillo')?>">Registrar</button>
                            <div class="c-alert c-alert--success w-none">
                                <i class="c-alert__icon fa fa-info-circle"></i> Platillo Agregado
                            </div>
                        </form>
                    </div>
                </div><!-- // .c-modal__content -->
            </div><!-- // .c-modal__dialog -->
        </div><!-- // .c-modal -->
        
        <script src="<?=base_url('assets/system/dist/js/main.min.js')?>"></script>
        <script src="<?=base_url('assets/system/js/scripts.js')?>"></script>
    </body>
</html>