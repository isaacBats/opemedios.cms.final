<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema Integral de Administración de Opemedios">
    <meta name="author" content="Isaac Batista">

    <title><?= $titleTab ?></title>
    
    <!-- Bootstrap Core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Jquery-ui CSS -->
    <link href="/admin/css/jquery-ui.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    -->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">

    <?= $stylesheet ?>

    <link rel="stylesheet" type="text/css" href="/admin/css/admin.css">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
  

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/panel">Sistema de administracion Opemedios</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Bienvenido 
                        <?php if( isset( $_SESSION['admin'] ) )
                        {
                            $user = $_SESSION['admin']['nombre'] . ' ' . $_SESSION['admin']['apellidos'];

                            echo $user;
                        } ?> 
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/panel/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/panel"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-plus-square-o fa-fw"></i> Noticias<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="javascript:void(0)">Agregar Noticia <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/panel/new/add/new-television"><i class="fa fa-television fa-fw"></i> Televisión</a>
                                        </li>
                                        <li>
                                            <a href="/panel/new/add/new-radio"><i class="fa fa-microphone fa-fw"></i> Radio</a>
                                        </li>
                                        <li>
                                            <a href="/panel/new/add/new-periodico"><i class="fa fa-newspaper-o fa-fw"></i> Periódico</a>
                                        </li>
                                        <li>
                                            <a href="/panel/new/add/new-revista"><i class="fa fa-columns fa-fw"></i> Revista</a>
                                        </li>
                                        <li>
                                            <a href="/panel/new/add/new-internet"><i class="fa fa-chrome fa-fw"></i> Internet</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/panel/news">Noticias de hoy</a>
                                </li>
                                <li>
                                    <a href="/panel/news/advanced-search">Búsqueda avanzada</a>
                                </li>
                                <li>
                                    <a href="/panel/news/blocks">Bloques de noticias</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-link fa-fw"></i> Fuentes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="javascript:void(0)">Agregar Fuente <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/panel/font/add/font-television"><i class="fa fa-television fa-fw"></i> Televisión</a>
                                        </li>
                                        <li>
                                            <a href="/panel/font/add/font-radio"><i class="fa fa-microphone fa-fw"></i> Radio</a>
                                        </li>
                                        <li>
                                            <a href="/panel/font/add/font-periodico"><i class="fa fa-newspaper-o fa-fw"></i> Periódico</a>
                                        </li>
                                        <li>
                                            <a href="/panel/font/add/font-revista"><i class="fa fa-columns fa-fw"></i> Revista</a>
                                        </li>
                                        <li>
                                            <a href="/panel/font/add/font-internet"><i class="fa fa-chrome fa-fw"></i> Internet</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/panel/fonts/show-list">Administrar Fuentes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-th fa-fw"></i> Sectores<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/panel/sector/add">Agregar Sector</a>
                                </li>
                                <li>
                                    <a href="/panel/sector/show-list">Administrar Sectores</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-newspaper-o fa-fw"></i> Prensa<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Primeras planas</a>
                                </li>
                                <li>
                                    <a href="morris.html">Portadas financieras</a>
                                </li>
                                <li>
                                    <a href="morris.html">Columnas Políticas</a>
                                </li>
                                <li>
                                    <a href="morris.html">Columnas Financieras</a>
                                </li>
                                <li>
                                    <a href="morris.html">Cartones</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-check-square-o fa-fw"></i> Asignación<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Noticias por Clientes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-excel-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Noticias por Clientes</a>
                                </li>
                                <li>
                                    <a href="flot.html">Reporte de Notas por día</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pie-chart fa-fw"></i> Gráficas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Noticias por Clientes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Usuarios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Agregar Usuario</a>
                                </li>
                                <li>
                                    <a href="flot.html">Administrar Usuarios</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="alert"></div>
              