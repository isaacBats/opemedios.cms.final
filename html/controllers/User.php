<?php

/**
 * Clase para el perfil del usuario  
 */

class User extends Controller {

    public function resetPass($lang) {
        $resultado = new stdClass();
        $user = $this->pdo->quote($_POST["usuario"]);
        $sql = "SELECT * FROM usuarios WHERE nombreusuario LIKE LOWER(" . $user . ") ";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        if ($rs !== false) {
            $nr = $query->rowCount();
            if ($nr > 0) {

                $user = $query->fetch(\PDO::FETCH_ASSOC);

                $length = 8;
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $count = mb_strlen($chars);

                $newPass = '';
                for ($i = 0; $i < $length; $i++) {
                    $index = rand(0, $count - 1);
                    $newPass .= mb_substr($chars, $index, 1);
                }

                $sql = 'UPDATE usuarios SET pass=:pass  WHERE id_registro =:id_registro';
                $query = $this->pdo->prepare($sql);
                $query->bindParam(':pass', $newPass);
                $query->bindParam(':id_registro', $user['id_registro']);
                $rs = $query->execute();


                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->Username = "dcepero@denumeris.com";
                $mail->Password = "";
                $mail->SetFrom("dbautista@denumeris.com", "dbautista@denumeris.com");
                $mail->AddAddress($user['email']);
                if ($lang == "es") {
                    $resultado->mensaje = "Su nueva contraseña se ha enviado";
                    $mail->Subject = "Nueva Contraseña";
                    $mail->Body = '<p style="margin-bottom: 40px; width:100%; text-align:center;"><img src="http://www.alfonsomarinaebanista.com/imgs/mail/header_logo.png" '
                            . 'alt="ALFONSO MARINA EBANISTA"/></p>  <p style="margin-bottom: 20px;">GRACIAS POR REGISTRARTE EN <a style="color: #807562;" '
                            . 'href="http://www.alfonsomarinaebanista.com">www.alfonsomarinaebanista.com</a></p>  <p style="margin-bottom: 20px;">  '
                            . 'Bienvenido a Alfonso Marina para profesionistas.<br />  '
                            . 'Favor de darle click al link inferior o copie el URL en su navegador para ingresar.  </p>  <p>  '
                            . '<a style="color: #807562;" href="http://www.alfonsomarinaebanista.com/es/login.aspx">http://www.alfonsomarinaebanista.com/es/login.aspx</a>  '
                            . '</p>  <p style="margin-bottom: 30px;">  Usuario: <strong>' . $user['nombreusuario'] . '</strong><br/>  Contraseña: <strong>' . $newPass . '</strong>  '
                            . '</p>  <p style="margin-bottom: 20px;">  Gracias,<br />  Alfonso Marina y Compañia.  </p>  <p style="margin-bottom: 20px;">'
                            . '<img src="http://www.alfonsomarinaebanista.com/imgs/mail/logo_am_250_2.jpg" width="160px" alt="LOGO"/></p>';
                } else {
                    $resultado->mensaje = "Your new password has been sent";
                    $mail->Subject = "New Password";
                    $mail->Body = '<p style="margin-bottom: 40px; width:100%; text-align:center;"><img src="http://www.alfonsomarinaebanista.com/imgs/mail/header_logo.png" '
                            . 'alt="ALFONSO MARINA EBANISTA"/></p>  <p style="margin-bottom: 20px;">THANK YOU FOR REGISTERING ON <a style="color: #807562;" '
                            . 'href="http://www.alfonsomarinaebanista.com">www.alfonsomarinaebanista.com</a></p>  <p style="margin-bottom: 20px;">  '
                            . 'Welcome to Alfonso Marina to the trade.<br />  Please follow the link below or copy-paste the URL into your browser to login.  </p>  <p>  '
                            . '<a style="color: #807562;" href="http://www.alfonsomarinaebanista.com/en/login.aspx">http://www.alfonsomarinaebanista.com/en/login.aspx</a> '
                            . ' </p>  <p style="margin-bottom: 30px;">  Username: <strong>' . $user['nombreusuario'] . '</strong><br/>  Password: <strong>' . $newPass . '</strong>  '
                            . '</p>  <p style="margin-bottom: 20px;">  Thank you, <br/>  Alfonso Marina & Co.  </p>  <p style="margin-bottom: 20px;">'
                            . '<img src="http://www.alfonsomarinaebanista.com/imgs/mail/logo_am_250_2.jpg" width="160px" alt="LOGO"/></p>';
                }
                $mail->Send();
                $resultado->exito = true;
                echo json_encode($resultado);
            } else {
                $resultado->exito = false;                
                $resultado->mensaje = "El usuario no es correcto";
                echo json_encode($resultado);
            }
        }
    }

    public function loginAction() {
        $user = $this->pdo->quote($_POST["username"]);
        $pass = $_POST["password"];


        $sql = "SELECT c.id_cuenta, CONCAT(c.nombre, ' ', c.apellidos) as usuario, c.cargo, c.telefono1, c.email, c.username, c.password, e.id_empresa, e.nombre as empresa, e.direccion, e.telefono as tel_empresa, e.contacto as contacto_empresa, e.email as email_empresa, e.giro, e.logo as logo_empresa FROM cuenta c INNER JOIN empresa e ON c.id_empresa = e.id_empresa WHERE c.username LIKE LOWER(" . $user . ") ";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        if ($rs !== false) {
            $nr = $query->rowCount();
            if ($nr > 0) {
                $user = $query->fetch(PDO::FETCH_ASSOC);                
                if (isset($user["username"])) {
                    if ($user["password"] == md5( $pass ) ) {

                        $queryTemas = $this->pdo->prepare('SELECT * FROM tema WHERE id_empresa = ' . $user['id_empresa']);
                        if( $queryTemas->execute() ){

                            $temas = ( $queryTemas->rowCount() > 0 ) ? $queryTemas->fetchAll(\PDO::FETCH_ASSOC) : 'Sin temas disponibles';
                        }
                        $_SESSION["user"] = $user;
                        if( is_array( $temas ) ){
                            $_SESSION['user']['temas'] = $temas;
                        }
                        header('Location: ./noticias');
                    } else {
                        header('Location: ./sign-in');
                    }
                } else {
                    header('Location: ./sign-in');
                }
            } else {
                header('Location: ./sign-in');
            }
        } else {
            header('Location: ./sign-in');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ./sign-in');
    }

    public function login($lang) {

        if (isset($_SESSION["user"])) {
            header('Location: .');
            exit;
        }

        $this->addBread(array("label" => "Login"));
        $this->header($lang, $this->trans($lang, "Iniciar Sesión - ", "Sign in - "), false, false, "who");
        require $this->views . "login.php";
        $this->footer($lang);
    }

    public function getProfile($lang = "es") {

        if (isset($_SESSION["user"])) {

            $this->addbread(array("url" => "/profile", "label" => $this->trans($lang, "Mi Perfil", "My profile")));
            $this->header($lang, $this->trans($lang, "Mi Perfil - ", "My profile - "));


            $sqlUser = "SELECT * FROM usuarios WHERE id_registro = :id";
            $query = $this->pdo->prepare($sqlUser);
            $query->bindParam(
                    ':id', $_SESSION['user']['id_registro'], \PDO::PARAM_INT
            );

            $rs = $query->execute();
            $user = $query->fetch();
            $country = $this->getUserCountry($user['pais']);

            require $this->views . "profile.php";
            $this->footer($lang);
        } else {
            header("Location: http://{$_SERVER["HTTP_HOST"]}/login");
        }
    }

    public function updateProfile($lang = "es") {
        $resultado = new stdClass();

        if (!empty($_POST)) {

            $resultado = new stdClass();

            $sql = "UPDATE usuarios SET
						nombre = :nombre, 
						apellidos = :apellidos,
						empresa = :empresa,
						puesto = :puesto,
						website = :website,
						direccion1 = :direccion1,
						direccion2 = :direccion2,
						pais = :pais,
						estado = :estado,
						codigopostal = :codigopostal,
						movil = :movil,
						telefono = :telefono
					WHERE id_registro = :id
					LIMIT 1;
					";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':nombre', $_POST['nombre']);
            $query->bindParam(':apellidos', $_POST['apellidos']);
            $query->bindParam(':empresa', $_POST['empresa']);
            $query->bindParam(':puesto', $_POST['puesto']);
            $query->bindParam(':website', $_POST['website']);
            $query->bindParam(':direccion1', $_POST['direccion1']);
            $query->bindParam(':direccion2', $_POST['direccion2']);
            $query->bindParam(':pais', $_POST['pais']);
            $query->bindParam(':estado', $_POST['estado']);
            $query->bindParam(':codigopostal', $_POST['codigopostal']);
            $query->bindParam(':movil', $_POST['movil']);
            $query->bindParam(':telefono', $_POST['telefono']);
            $query->bindParam(':id', $_POST['id']);

            $registro = $query->execute();
            if ($registro) {
                $cuerpo_email = 'HTML del correo';
                $cabeceras = 'From: dbautista@denumeris.com ' . "\r\n" .
                        'Reply-To: dbautista@denumeris.com ' . "\r\n" .
                        'Content-type: text/html; charset=utf-8' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                if (mail('dbautista@denumiers.com', 'Se actualizo un contacto', $cuerpo_email, $cabeceras)) {
                    $resultado->exito = true;
                    $resultado->mensaje = ( $lang == "en" ) ? 'Thank you, profile updated' : "Gracias, perfil actualizado";
                } else {
                    $resultado->exito = false;
                    $resultado->mensaje = "Se guardó el contacto pero no mandó el MAIL";
                }
            } else {
                $resultado->exito = false;
                $resultado->error = 'No se actualizo el registro';
            }
        } else {
            $resultado->exito = false;
            $resultado->error = 'El mensaje contiene valores vacios';
        }

        header('Content-type: text/json');
        echo json_encode($resultado);
    }

}
