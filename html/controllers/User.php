<?php

/**
 * 
 */
require_once(__DIR__ . '/../admin/lib/php-mailer/PHPMailerAutoload.php');

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

    public function loginAction($lang) {
        $user = $this->pdo->quote($_POST["username"]);
        $pass = $_POST["password"];

        $sql = "SELECT * FROM usuarios WHERE nombreusuario LIKE LOWER(" . $user . ") ";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        if ($rs !== false) {
            $nr = $query->rowCount();
            if ($nr > 0) {
                $user = $query->fetchAll(PDO::FETCH_ASSOC);
                if (isset($user[0]["nombreusuario"])) {
                    if ($user[0]["pass"] == $pass) {
                        $_SESSION["user"] = $user[0];
                        header('Location: ./profile');
                    } else {
                        header('Location: ./login');
                    }
                } else {
                    header('Location: ./login');
                }
            } else {
                header('Location: ./login');
            }
        } else {
            header('Location: ./login');
        }
    }

    public function logout($lang) {
        session_destroy();
        header('Location: ./login');
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

    function saveRegistro($lang) {

        $resultado = new stdClass();

        if (!empty($_POST)) {

            $resultado = new stdClass();

            /*             * ************************* INSERT DEL CONTACTO *************************************** */

            $sql = "INSERT INTO usuarios 
						(nombre,apellidos,nombreusuario,pass,email,empresa,puesto,website,direccion1,direccion2,pais,estado,codigopostal,movil,telefono,organizacion,motivo,comoseentero,registroftk,registromailing) 
						VALUES 
						(:nombre,:apellidos,:nombreusuario,:pass,:email,:empresa,:puesto,:website,:direccion1,:direccion2,:pais,:estado,:codigopostal,:movil,:telefono,:organizacion,:motivo,:comoseentero,:registroftk,:registromailing);
					";




            $registroftk = isset($_POST['registromailing']) ? "1" : "0";
            $registromailing = isset($_POST['registromailing']) ? "1" : "0";


            $query = $this->pdo->prepare($sql);
            $query->bindParam(':nombre', $_POST['nombre']);
            $query->bindParam(':apellidos', $_POST['apellidos']);
            $query->bindParam(':nombreusuario', $_POST['nombreusuario']);
            $query->bindParam(':pass', $_POST['passworduno']);
            $query->bindParam(':email', $_POST['email']);
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
            $organizacion = implode(",", $_POST['organizacion']);
            $query->bindParam(':organizacion', $organizacion);
            $query->bindParam(':motivo', $_POST['motivo']);
            $query->bindParam(':comoseentero', $_POST['comoseentero']);
            $query->bindParam(':registroftk', $registroftk);
            $query->bindParam(':registromailing', $registromailing);

            $registro = $query->execute();
            if ($registro) {


                date_default_timezone_set("Mexico/General");

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->isHTML(true);
                $mail->SMTPAuth = true;

                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->Username = "dcepero@denumeris.com";
                $mail->Password = "9milymasmurieron";
                $mail->SetFrom("dcepero@denumeris.com", "dcepero@denumeris.com");

                $mail->AddAddress("dcepero@denumeris.com");
                $mail->Subject = "Ha recibido un nuevo contacto";

                $registroftkms = isset($_POST['registromailing']) ? "Si" : "No";
                $registromailingms = isset($_POST['registromailing']) ? "Si" : "No";
                $mail->Body = '<p>
                                <strong>Nombre:</strong>  ' . $_POST['nombre'] . ' <br />
                                <strong>Apellidos:</strong>  ' . $_POST['apellidos'] . ' <br />
                                <strong>Nombre de usuario:</strong>   ' . $_POST['nombreusuario'] . '<br />
                                <strong>Email:</strong>  <a href="mailto:' . $_POST['email'] . '"> ' . $_POST['email'] . ' </a><br />
                                <strong>Empresa:</strong> ' . $_POST['empresa'] . ' <br />
                                <strong>Puesto:</strong>  ' . $_POST['puesto'] . ' <br />
                                <strong>Website:</strong>  <a href="' . $_POST['website'] . '"> ' . $_POST['website'] . ' </a><br />
                                <strong>Dirección:</strong><br />  ' . $_POST['direccion1'] . ' <br />' . $_POST['direccion2'] . '<br />
                                <strong>Pais:</strong>  ' . $_POST['pais'] . '<br />
                                <strong>Estado:</strong>  ' . $_POST['estado'] . '<br />
                                <strong>C.P.:</strong>  ' . $_POST['codigopostal'] . '<br />
                                <strong>Teléfono:</strong>  ' . $_POST['telefono'] . ' <br />
                                <strong>Movil:</strong>   ' . $_POST['movil'] . '<br />
                                <strong>Organización:</strong>   ' . $organizacion . '<br />
                                <strong>Motivo Afiliación:</strong>  ' . $_POST['motivo'] . '<br />
                                <strong>Como se entero:</strong>   ' . $_POST['comoseentero'] . '<br />
                                <strong>Registrar Be the First to know:</strong>  ' . $registroftkms . ' <br />
                                <strong>Añadir a Lista de Correo:</strong>  ' . $registromailingms . '<br />
                            </p>
                            ';
                if ($mail->Send()) {
                    $resultado->exito = true;
                    $resultado->mensaje = ( $lang == "en" ) ? 'Thank you, we will check your info, and your will recive the confimation throug and email' : "Gracias, revisaremos tu información y recibirás la confirmación a través de un correo electrónico";
                } else {
                    $resultado->exito = false;
                    $resultado->mensaje = "Se guardó el contacto pero no mandó el MAIL";
                }
            } else {
                $resultado->exito = false;
                $resultado->error = 'No se insertó el registro';
            }
        } else {
            $resultado->exito = false;
            $resultado->error = 'El mensaje contiene valores vacios';
        }

        header('Content-type: text/json');
        echo json_encode($resultado);
    }

    function showForm($lang = "es") {
        $this->addbread(array("url" => "/register", "label" => $this->trans($lang, "Registro", "Register")));
        $this->header($lang, $this->trans($lang, "Registro - ", "Register - "), false, false, "who");
        $countries = "";
        foreach ($this->getCountries() as $country) {
            $countries .= '<option value="' . $country['nombre'] . '" >' . $country['nombre'] . '</option>';
        }
        require $this->views . "register-form.php";
        $this->footer($lang);
    }

    private function getCountries() {
        $sql = "SELECT * FROM countries ";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getUserCountry($pais) {
        $countries = $this->getCountries();
        $html = "";
        foreach ($countries as $country) {

            if ($pais == $country['nombre']) {
                $html .= '<option value="' . $pais . '" selected >' . $pais . '</option>';
            } else {
                $html .= '<option value="' . $country['nombre'] . '" >' . $country['nombre'] . '</option>';
            }
        }
        return $html;
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
