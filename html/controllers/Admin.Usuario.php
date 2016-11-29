<?php

class AdminUsuario extends Controller {

    private $usuariosRepo;
    
    function __construct()
    {
        $this->usuariosRepo = new UsuarioRepository();
    }

    public function showUsers() {
        
        if( isset( $_SESSION['admin'] ) ){
            $js = '
                    <!-- Libreria jquery-bootpag --> 
                    <script src="/admin/js/vendors/bootstrap/jquery.bootpag.min.js"></script>
                    <!-- Libreria purl --> 
                    <script src="/admin/js/vendors/purl/purl.min.js"></script>
                    <!-- Paginador con js --> 
                    <script src="/assets/js/panel.paginador.js"></script>
            ';

            $css = '

                    <!-- panel_paginator CSS -->
                    <link href="/admin/css/panel.main.css" rel="stylesheet">
                    <!-- data tables bootstrap CSS -->
                    <link href="/admin/css/dataTables.bootstrap.css" rel="stylesheet">
            ';

            $limit = isset( $_GET['numpp'] ) ? $_GET['numpp'] : 10;
            $page = isset( $_GET['page'] ) ? ( $_GET['page'] * $limit ) - $limit : 0;

            $getUsers = $this->usuariosRepo->showAllUsers( $limit, $page);

            if( $getUsers->exito ){
                $users = $getUsers->rows;
                $count = $getUsers->count;
            }

            $ini = $page + 1;
            $end = ( $page + $limit >= $count ) ? $count : $page + $limit;

            $this->header_admin('Usuarios - ', $css);
            require $this->adminviews . 'showUsersView.php';
            $this->footer_admin( $js );

        }else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
    }

    public function userDetail( $id )
    {
        if( isset( $_SESSION['admin'] ) ){
            
            $user = $this->usuariosRepo->get( $id );
            $tipoUsuarios = $this->usuariosRepo->getUsersTypes();
            // echo '<pre>'; print_r($tipoUsuarios); exit;

            $this->header_admin('Detalle de ' . $user['nombre'] . ' ' . $user['apellidos'] . ' - ');
            require $this->adminviews . 'userDetailView.php';
            $this->footer_admin( );

        }else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }   
    }

    // TODO: @AdminUsuario Falta editar un usuario.
    // TODO: @AdminUsuario Falta crear un nuevo usuario.
}
