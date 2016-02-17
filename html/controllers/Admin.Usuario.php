<?php

use ForceUTF8\Encoding;

class AdminUsuario extends Controller {

    public function updateStatus($lang) {
        if (!empty($_POST)) {

            $datos = explode(":", $_POST['id_registro']);
            $new_status = $datos[0];
            $id_registro = $datos[1];

            //get currente user
            $sql_user = 'Select * from usuarios   WHERE id_registro =:id_registro';
            $query_user = $this->pdo->prepare($sql_user);
            $query_user->bindParam(':id_registro', $id_registro);
            $rs_user = $query_user->execute();
            $user = $query_user->fetch(\PDO::FETCH_ASSOC);


            //update user
            $sql = 'UPDATE usuarios SET status=:status  WHERE id_registro =:id_registro';
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':status', $new_status);
            $query->bindParam(':id_registro', $id_registro);
            $rs = $query->execute();

            $resultado = new stdClass();


            if ($rs != false) {

                if ($new_status == 1 || $new_status == 2) {

                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465;
                    $mail->Username = "dcepero@denumeris.com";
                    $mail->Password = "elsamaria83";
                    $mail->SetFrom("dcepero@denumeris.com", "dcepero@denumeris.com");
                    $mail->AddAddress($user['email']);

                    if ($new_status == 1) {

                        if ($lang == "es") {
                            $mail->Subject = "Se Ha cambiado su status";
                            $mail->Body = '<p style="margin-bottom: 40px; width:100%; text-align:center;">'
                                    . '<img src="http://www.alfonsomarinaebanista.com/imgs/mail/header_logo.png" alt="ALFONSO MARINA EBANISTA"/>'
                                    . '</p>  <p style="margin-bottom: 20px;">GRACIAS POR REGISTRARTE EN '
                                    . '<a style="color: #807562;" href="http://www.alfonsomarinaebanista.com">www.alfonsomarinaebanista.com</a></p> '
                                    . ' <p style="margin-bottom: 20px;">  Bienvenido a Alfonso Marina para profesionistas.'
                                    . '<br />  Favor de darle click al link inferior o copie el URL en su navegador para ingresar.  </p>  '
                                    . '<p>  <a style="color: #807562;" href="http://www.alfonsomarinaebanista.com/es/login.aspx">http://www.alfonsomarinaebanista.com/es/login.aspx</a>  '
                                    . '</p>  <p style="margin-bottom: 30px;">  Usuario: <strong>' . $user['nombreusuario'] . '</strong><br/>  Contraseña: <strong>' . $user['pass'] . '</strong>  </p> '
                                    . ' <p style="margin-bottom: 20px;">  Gracias,<br />  Alfonso Marina y Compañia.  </p>  <p style="margin-bottom: 20px;">'
                                    . '<img src="http://www.alfonsomarinaebanista.com/imgs/mail/logo_am_250_2.jpg" width="160px" alt="LOGO"/></p>';
                        } else {
                            $mail->Subject = "Their status has changed";
                            $mail->Body = '<p style="margin-bottom: 40px; width:100%; text-align:center;"><img src="http://www.alfonsomarinaebanista.com/imgs/mail/header_logo.png" alt="ALFONSO MARINA EBANISTA"/>'
                                    . '</p>  <p style="margin-bottom: 20px;">THANK YOU FOR REGISTERING ON <a style="color: #807562;" href="http://www.alfonsomarinaebanista.com">www.alfonsomarinaebanista.com</a>'
                                    . '</p>  <p style="margin-bottom: 20px;">  Welcome to Alfonso Marina to the trade.<br />  Please follow the link below or copy-paste the URL into your browser to login.  </p> '
                                    . ' <p>  <a style="color: #807562;" href="http://www.alfonsomarinaebanista.com/en/login.aspx">http://www.alfonsomarinaebanista.com/en/login.aspx</a>  '
                                    . '</p>  <p style="margin-bottom: 30px;">  Username: <strong>' . $user['nombreusuario'] . '</strong><br/>  Password: <strong>' . $user['pass'] . '</strong>  </p>  '
                                    . '<p style="margin-bottom: 20px;">  Thank you, <br/>  Alfonso Marina & Co.  </p>  <p style="margin-bottom: 20px;">'
                                    . '<img src="http://www.alfonsomarinaebanista.com/imgs/mail/logo_am_250_2.jpg" width="160px" alt="LOGO"/></p>';
                        }
                    } else {
                        if ($lang == "es") {
                            $mail->Subject = "Se Ha cambiado su status";
                            $mail->Body = '<p style="margin-bottom: 40px; width:100%; text-align:center;"><img src="http://www.alfonsomarinaebanista.com/imgs/mail/header_logo.png" alt="ALFONSO MARINA EBANISTA"/></p>  '
                                    . '<p style="margin-bottom: 20px;">GRACIAS POR REGISTRARTE EN <a style="color: #807562;" href="http://www.alfonsomarinaebanista.com">www.alfonsomarinaebanista.com</a></p>  '
                                    . '<p style="margin-bottom: 20px;">  Lo sentimos pero tu registro no ha sido completado.<br />  Para mayor información contacta nuestra área de servicio a clientes.  </p>  <p>'
                                    . '  <a href="mailto:centroam@alfonsomarinaebanista.com?subject=Registro">centroam@alfonsomarinaebanista.com</a>  </p>  <p style="margin-bottom: 30px;">  1 888 489 38 39  '
                                    . '</p>  <p style="margin-bottom: 20px;">  Gracias,<br />  Alfonso Marina y Compañia.  </p>  <p style="margin-bottom: 20px;">'
                                    . '<img src="http://www.alfonsomarinaebanista.com/imgs/mail/logo_am_250_2.jpg" width="160px" alt="LOGO"/></p>';
                        } else {
                            $mail->Subject = "Their status has changed";
                            $mail->Body = '<p style="margin-bottom: 40px; width:100%; text-align:center;"><img src="http://www.alfonsomarinaebanista.com/imgs/mail/header_logo.png" alt="ALFONSO MARINA EBANISTA"/></p>  '
                                    . '<p style="margin-bottom: 20px;">THANK YOU FOR REGISTERING ON <a style="color: #807562;" href="http://www.alfonsomarinaebanista.com">www.alfonsomarinaebanista.com</a></p>  '
                                    . '<p style="margin-bottom: 20px;">  Sorry your request could not be completed.<br />  For further information contact our customer service area.  </p>  <p>  '
                                    . '<a href="mailto:info@alfonsomarinaebanista.com?subject=Registration">info@alfonsomarinaebanista.com</a>  </p>  <p style="margin-bottom: 30px;">  1 888 489 38 39  </p>  '
                                    . '<p style="margin-bottom: 20px;">  Thank you, <br/>  Alfonso Marina & Co.  </p>  <p style="margin-bottom: 20px;">'
                                    . '<img src="http://www.alfonsomarinaebanista.com/imgs/mail/logo_am_250_2.jpg" width="160px" alt="LOGO"/></p>';
                        }
                    }
                    $mail->Send();
                }

                $resultado->exito = true;
            } else {
                $resultado->exito = false;
            }
            header('Content-type: text/json');
            echo json_encode($resultado);
        }
    }

    public function exportContacts() {


        $sql = "SELECT * FROM contactos";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        if ($rs !== false) {
            $nr = $query->rowCount();
            if ($nr > 0) {

                $header = "NOMBRE\tEMAIL\tEMPRESA\tPUESTO\tPAIS\tESTADO\tCODIGO POSTAL\tTELEFONO\tEMAIL\tCOMO SE ENTERO\tFECHA\t";
                $line = '';

                $rows = $query->fetchAll();
                foreach ($rows as $row) {
                    $nombre = str_replace('"', '""', $row['nombre']);
                    $nombre = '"' . $nombre . '"' . "\t";
                }

                $line .= $nombre . "\n";
            }

            $data = str_replace("\r", "", $line);
            $data = Encoding::toUTF8($data);
            //$data = Encoding::toISO8859($data);
        }

        header("Content-type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=exporta_contactos_" . date('y-m-d') . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $header . "\n" . $data;
    }

    public function showUsers() {
        $this->header_admin($lang = "es");

        $sql = "SELECT * FROM usuarios";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        if ($rs !== false) {
            $nr = $query->rowCount();
            if ($nr > 0) {
                $rows = $query->fetchAll();
                require $this->adminviews . "list-users.php";
            }
        }
        $this->footer_admin($lang = "es");
    }

    public function detailUser($lang = "es", $id) {

        $this->header_admin($lang);

        $sql = "SELECT 
					id_registro,
					nombre,        
					apellidos,     
					nombreusuario, 
					pass,          
					email,         
					empresa,       
					puesto,        
					website,       
					direccion1,    
					direccion2,    
					pais,          
					estado,        
					codigopostal,  
					movil,         
					telefono,      
					organizacion,  
					status,        
					fecha 
				FROM usuarios 
				WHERE id_registro = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $rs = $query->execute();
        if ($rs !== false) {
            $user = $query->fetch(\PDO::FETCH_ASSOC);
            require $this->adminviews . "view-user.php";
        }
        $this->footer_admin($lang);
    }

}
