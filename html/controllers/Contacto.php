<?php

/**
 *  Controlador de contacto
 */
require_once(__DIR__ . '/../admin/lib/php-mailer/PHPMailerAutoload.php');

class Contacto extends Controller {

    private function getCountries() {
        $sql = "SELECT * FROM countries ";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        $html = "";
        foreach ($query->fetchAll(\PDO::FETCH_ASSOC) as $country) {
            $html .= '<option value="' . $country['nombre'] . '" >' . $country['nombre'] . '</option>';
        }
        return $html;
    }

    function saveForm($lang) {
        if (!empty($_POST)) {

            $resultado = new stdClass();

            /*             * ************************* INSERT DEL CONTACTO *************************************** */

            $query = $this->pdo->prepare("INSERT INTO contactos (nombre, empresa,puesto,pais,estado,codigopostal,telefono,email,comoseentero) VALUES (:nombre, :empresa,:puesto,:pais,:estado,:codigopostal,:telefono,:email,:comoseentero);");
            $query->bindParam(':nombre', $_POST['nombre']);
            $query->bindParam(':empresa', $_POST['empresa']);
            $query->bindParam(':puesto', $_POST['puesto']);
            $query->bindParam(':pais', $_POST['pais']);
            $query->bindParam(':estado', $_POST['estado']);
            $query->bindParam(':codigopostal', $_POST['codigopostal']);
            $query->bindParam(':telefono', $_POST['telefono']);
            $query->bindParam(':email', $_POST['email']);
            $query->bindParam(':comoseentero', $_POST['comoseentero']);

            $contacto = $query->execute();
            if ($contacto) {

                date_default_timezone_set("Mexico/General");

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->isHTML(true);
                $mail->SMTPAuth = true;

                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->Username = "dcepero@denumeris.com";
                $mail->Password = "elsamaria83";
                $mail->SetFrom("dcepero@denumeris.com", "dcepero@denumeris.com");

                $mail->AddAddress("dcepero@denumeris.com");
                $mail->Subject = "Ha recibido un nuevo contacto";
                $mail->Body = '<p>
                                            <strong>Nombre:</strong>' . $_POST['nombre'] . '<br />
                                            <strong>Compañia:</strong> ' . $_POST['empresa'] . ' <br />
                                            <strong>Email:</strong>  <a href="mailto:' . $_POST['email'] . '"> ' . $_POST['email'] . ' </a><br />
                                            <strong>Puesto:</strong>  ' . $_POST['puesto'] . ' <br />
                                            <strong>Pais:</strong>  ' . $_POST['pais'] . ' <br />
                                            <strong>Estado:</strong> ' . $_POST['estado'] . ' <br />
                                            <strong>C.P.:</strong>  ' . $_POST['telefono'] . ' <br />
                                            <strong>Teléfono:</strong>  ' . $_POST['telefono'] . ' <br />
                                            <strong>Como se entero:</strong>  ' . $_POST['comoseentero'] . ' <br />
                                            <strong>Comentario:</strong>  ' . $_POST['comoseentero'] . ' <br />
                                        </p>';
                if ($mail->Send()) {
                    $resultado->exito = true;
                    $resultado->mensaje = ( $lang == "en" ) ? 'Thank you, we will contact you as soon as possible' : "Gracias, te contactaremos lo más pronto posible";
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
        $this->addbread(array("url" => "/contact", "label" => $this->trans($lang, "Contacto ", "Contact Us ")));
        $countries = $this->getCountries();
        $this->header($lang, false, false, "contacto");
        require $this->views . "formulario-contacto.php";
        $this->footer($lang);
    }

}
