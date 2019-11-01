<?php
use utilities\Util;

class AdminUsuario extends Controller {

    private $usuariosRepo;
    
    function __construct()
    {
        $this->usuariosRepo = new UsuarioRepository();
        if(!Util::byPass("usuarios")){
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/news");
        }
    }

    public function showUsers() 
    {
        
        if( isset( $_SESSION['admin'] ) ){
            $js = '
                    <!-- Libreria jquery-bootpag --> 
                    <script src="/admin/js/vendors/bootstrap/jquery.bootpag.min.js"></script>
                    <!-- Libreria purl --> 
                    <script src="/admin/js/vendors/purl/purl.min.js"></script>
                    <!-- Paginador con js --> 
                    <script src="/assets/js/panel.paginador.js"></script>
                    <!-- Data Tables -->
                    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            ';

            $css = '

                    <!-- panel_paginator CSS -->
                    <link href="/admin/css/panel.main.css" rel="stylesheet">
                    <!-- data tables bootstrap CSS -->
                    <link href="/admin/css/dataTables.bootstrap.css" rel="stylesheet">
                    <!-- Data Tables --> 
                    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
            ';

            $limit = isset( $_GET['numpp'] ) ? $_GET['numpp'] : 10;
            $page = isset( $_GET['page'] ) ? ( $_GET['page'] * $limit ) - $limit : 0;

            $getUsers = $this->usuariosRepo->showAllUsers();

            if( $getUsers->exito ){
                $users = $getUsers->rows;
                $count = $getUsers->count;
            }

            $this->header_admin('Usuarios - ', $css);
            require $this->adminviews . 'showUsersView.php';
            $this->footer_admin( $js );

        }else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
    }

    public function userDetail( $id )
    {
        if( isset( $_SESSION['admin'] ) ){
            
            $user = $this->usuariosRepo->get( $id );
            $tipoUsuarios = $this->usuariosRepo->getUsersTypes();
            
            $this->header_admin('Detalle de ' . $user['nombre'] . ' ' . $user['apellidos'] . ' - ');
            require $this->adminviews . 'userDetailView.php';
            $this->footer_admin( );

        }else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }   
    }

    public function editUser( $id )
    {
        if( isset( $_SESSION['admin'] ) ){
            
            $user = $this->usuariosRepo->get( $id );
            //$_POST['password'] = ( $_POST['password'] != '' ) ? md5( $_POST['password'] ) : $user['password'];
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $_POST['activo'] = isset( $_POST['activo'] ) ? 1 : 0;
            $_POST['id'] = $id;
            
            $update = $this->usuariosRepo->edit( $_POST );

            $_SESSION['alerts']['usuario'] = $update;
            header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
        }else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }   
    }

    public function createUser()
    {
        if( isset( $_SESSION['admin'] ) ){
            
            $tipoUsuarios = $this->usuariosRepo->getUsersTypes();
            
            $this->header_admin('Crear usuario - ');
            require $this->adminviews . 'createUserView.php';
            $this->footer_admin( );

        }else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
    }

    public function createUserAction()
    {
        if( isset( $_SESSION['admin'] ) ){
            
            $rules = [
                        'nombre'    => 'required',
                        'apellidos' => 'required',
                        'tel_casa'  => 'required',
                        'username'  => 'required',
                        'password'  => 'required',
                        'tipo_usuario' => 'required',
                     ];
            $_POST['activo'] = TRUE;
            //$_POST['password'] = md5( $_POST['password'] );
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            $user = $this->usuariosRepo->create( $_POST );

            $_SESSION['alerts']['usuarios'] = $user;
            header( 'Location: /panel/users' );

        }else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
    }

    /*joz*/
    public function deleteUser( $id )
    {
        if( isset( $_SESSION['admin'] ) ){
            $deleteUser = $this->usuariosRepo->deleteUser( $id );
            if ($deleteUser->exito) {
                $response->success = true;
                $response->message = "Usuario eliminado correctamente.";
            }
            else {
                $response->success = false;
                $response->error = json_encode($deleteUser);
                $response->message = "No se pudo eliminar al usuario, intentalo más tarde.";
            }
            header('Content-type: text/json');
            echo json_encode($response);
        }else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
    }
    /*/joz*/

    private function validateForm( $data, $rules )
    {
        // Pendiente por crear
    }

    // TODO: @AdminUsuario Falta crear un nuevo usuario.
}
