<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->

  <title>Alfonso Marina - Administrador</title>

  <link rel="stylesheet" href="/admin/lib/Hover/hover.css">
  <link rel="stylesheet" href="/admin/lib/fontawesome/css/font-awesome.css">
  <link rel="stylesheet" href="/admin/lib/weather-icons/css/weather-icons.css">
  <link rel="stylesheet" href="/admin/lib/ionicons/css/ionicons.css">
  <link rel="stylesheet" href="/admin/lib/jquery-toggles/toggles-full.css">
  <link rel="stylesheet" href="/admin/lib/morrisjs/morris.css">
  <link rel="stylesheet" href="/admin/lib/summernote/summernote.css">

  <link rel="stylesheet" href="/admin/css/quirk.css">

  <script src="/admin/lib/modernizr/modernizr.js"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="/admin/lib/html5shiv/html5shiv.js"></script>
  <script src="/admin/lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body>

<header>
  <div class="headerpanel">

    <div class="logopanel">
      <h2><a href="javascript:void(0);">ADMIN</a></h2>
    </div><!-- logopanel -->

    <div class="headerbar">

      <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

      <div class="searchpanel">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span>
        </div><!-- input-group -->
      </div>

      <div class="header-right">
        
      </div><!-- header-right -->
    </div><!-- headerbar -->
  </div><!-- header-->
</header>

<section>

  <div class="leftpanel">
    <div class="leftpanelinner">

      <ul class="nav nav-tabs nav-justified nav-sidebar">
        
      </ul>

      <div class="tab-content">

        <!-- ################# MAIN MENU ################### -->

        <div class="tab-pane active" id="mainmenu">
          
          <h5 class="sidebar-title">MENU</h5>
          <ul class="nav nav-pills nav-stacked nav-quirk">
            <li class="nav-parent">
              <a href=""><i class="fa fa-check-square"></i> <span>Contactos</span></a>
              <ul class="children">
                <li><a href="/panel/contacts/list">Listar contactos</a></li>
                <li><a href="/panel/contacts/export">Exportar contactos</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-suitcase"></i> <span>Noticias</span></a>
              <ul class="children">
                <li><a href="/panel/news/list">Listar noticias</a></li>
                <li><a href="/panel/news/add">Agregar noticia</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-th-list"></i> <span>Catálogo</span></a>
              <ul class="children">
                <li><a href="javascript:void(0);">Listar productos</a></li>
                <li><a href="javascript:void(0);">Agregar producto</a></li>
                <li><a href="javascript:void(0);">Exportar productos</a></li>
                <li><a href="javascript:void(0);">Importar productos</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-picture-o"></i> <span>Galeria</span></a>
              <ul class="children">
                <li><a href="/panel/gallery/list">Lista de imagenes</a></li>
                <li><a href="/panel/gallery/add;">Agregar imagen</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-newspaper-o"></i> <span>Prensa</span></a>
              <ul class="children">
                <li><a href="/panel/press/list">Lista de Galerias</a></li>
                <li><a href="/panel/press/add;">Agregar Galeria</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-user"></i> <span>Usuarios</span></a>
              <ul class="children">
                <li><a href="/panel/users/list">Listar usuarios</a></li>
                <li><a href="javascript:void(0);">Autorizar usuarios</a></li>
                <li><a href="javascript:void(0);">Editar usuario</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- tab-pane -->

      </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">

    <!--<div class="pageheader">
      <h2><i class="fa fa-home"></i> Dashboard</h2>
    </div>-->

    <div class="contentpanel">