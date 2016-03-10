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
  
  <!-- <link rel="stylesheet" href="/admin/lib/morrisjs/morris.css"> -->
  <link rel="stylesheet" href="/admin/lib/summernote/summernote.css">

  <link rel="stylesheet" href="/admin/lib/jquery-ui/jquery-ui.css">
  <link rel="stylesheet" href="/admin/css/quirk.css">
  <link rel="stylesheet" href="/admin/css/admin.css">

  <script src="/admin/lib/modernizr/modernizr.js"></script>
  

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="/admin/lib/html5shiv/html5shiv.js"></script>
  <script src="/admin/lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body>
<div class="alert alert-info fade in nomargin" id="confirmacion" title="">
  <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
  <p></p>
</div>
<header>
  <div class="headerpanel">

    <div class="logopanel">
      <h2><a href="/">Alfonso Marina</a></h2>
    </div><!-- logopanel -->

    <div class="headerbar">

      <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

     <!--  <div class="searchpanel">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </div>-->

      <div class="header-right">
        <ul class="headermenu">
        <li>
          <div class="btn-group">
            <button type="button" class="btn btn-logged" data-toggle="dropdown" aria-expanded="true">
              <img src="/assets/maquetas/quirk/images/photos/loggeduser.png" alt="">
              <?php echo @$_SESSION["admin"]["name"]; ?>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right">
              <li><a href="/panel/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
            </ul>
          </div>
        </li>
      </ul>
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
                <li><a href="/panel/catalog/list">Listar productos</a></li>
                <li><a href="/panel/catalog/product/add">Agregar producto</a></li>
                <li><a href="/panel/catalog/export">Exportar productos</a></li>
                <li><a href="/panel/catalog/import">Importar productos</a></li>
                <li><a href="/panel/catalog/categories/list">Listar Categorias</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-picture-o"></i> <span>Galeria</span></a>
              <ul class="children">
                <li><a href="/panel/gallery/list">Lista de imagenes</a></li>
                <li><a href="/panel/galleries/add/1">Agregar imagen</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-newspaper-o"></i> <span>Prensa</span></a>
              <ul class="children">
                <li><a href="/panel/press/list">Lista de Galerias</a></li>
                <li><a href="/panel/add/gallery">Agregar Galeria</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-user"></i> <span>Usuarios</span></a>
              <ul class="children">
                <li><a href="/panel/users/list">Listar usuarios</a></li>
                <li><a href="javascript:void(0);">Autorizar usuarios</a></li>
                <li><a href="javascript:void(0);">Editar usuario</a></li>
              </ul>
            </li>
            <li class="nav-parent"><a href=""><i class="fa fa-folder-o"></i> <span>Páginas</span></a>
              <ul class="children">
                <li><a href="/panel/plain/list">Lista páginas estaticas</a></li>
                <li><a href="/panel/plain/add/page">Agregar Página</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- tab-pane -->

      </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">
    <div class="contentpanel">
      <ol class="breadcrumb breadcrumb-quirk">
          <li><a href="/panel"><i class="fa fa-home mr5"></i> Panel </a></li>
          <!-- <li><a href="buttons.html">Pages</a></li>
          <li class="active">Asset Manager</li> -->
        </ol>