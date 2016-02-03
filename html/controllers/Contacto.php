<?php


/**
*  Controlador de contacto
*/

class Contacto extends Controller
{
	function saveForm($lang){
		if( !empty($_POST) ){

			$resultado = new stdClass();

			/*************************** INSERT DEL CONTACTO ****************************************/

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
			if($contacto){
				$cuerpo_email = 'HTML del correo';
				$cabeceras='From: adan@denumeris.com ' . "\r\n" .
				'Reply-To: adan@denumeris.com ' . "\r\n" .
				'Content-type: text/html; charset=utf-8' . "\r\n".
				'X-Mailer: PHP/' . phpversion();

				// TODO: @Contacto AGREGAR LA FUNCION PARA ENVIAR LOS CORREOS CON SMTP (4)
				if(mail('adan@denumeris.com','Ha recibido un nuevo contacto',$cuerpo_email,$cabeceras)){
					$resultado->exito = true;
					$resultado->mensaje = ( $lang == "en" ) ? 'Thank you, we will contact you as soon as possible' : "Gracias, te contactaremos lo más pronto posible";
				}
				else{
					$resultado->exito = false;
					$resultado->mensaje = "Se guardó el contacto pero no mandó el MAIL";	
				}
			}
			else{
				$resultado->exito = false;
				$resultado->error = 'No se insertó el registro';
			}
		}
		else{
			$resultado->exito = false;
			$resultado->error = 'El mensaje contiene valores vacios';
		}

		header('Content-type: text/json');
		echo json_encode($resultado);

	}

	function showForm($lang="es"){
		$this->addbread( array("url"=>"/contact" , "label"=>"Contacto ") );
		$this->header($lang);
		require $this->views."formulario-contacto.php";
		$this->footer($lang);
	}

}

