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
		$html = '<div class="contact-info">
		<img src="/assets/images/contacto.jpg">
		<div class="info alt">
			<img src="/assets/images/mapa.jpg">
		</div><!-- .info -->
		<div class="info">
			<h2>Showroom México</h2>
			<p>Bosques de Duraznos 187 local 33,<br>
				Col. Bosques de las Lomas,<br>
				Del. Miguel Hidalgo<br>
				México, D.F., 11700<br>
				(+52) 55 5596-8364</p>
				<a href="mailto:centroam@alfonsomarinaebanista.com?subject=Contácto">centroam@alfonsomarinaebanista.com</a>
				<a href="https://maps.google.com/maps?q=19.407274,-99.239815&num=1&t=m&z=17" target="_blank" class=""><i class="fa fa-plus-square-o fa-lg"></i> Ver mapa</a>
				<select class="falta">
					<option>Showroom México</option>
				</select>
			</div><!-- .info -->
			<br class="clear">
		</div><!-- .coontact-info -->
		<div class="contact-form">
			<p id="mensaje"></p>
			<form id="contact-form" name="contact-form" action="'.$this->url($lang , "/contact").'" method="post">
				<h2 class="product-title">'.$this->trans($lang,'Contacto', 'Contact us').'</h2>
				<div class="field name">
					<input name="nombre" class="requerido" type="text" placeholder="'.$this->trans($lang,'Nombre','Name').'">				
				</div><!-- .field-->
				<div class="field">
					<input name="empresa" class="requerido" type="text" placeholder="'.$this->trans($lang,'Empresa','Company').'">
				</div><!-- .field -->
				<div class="field">
					<input name="puesto" type="text" placeholder="'.$this->trans($lang,'Puesto','Position').'">
				</div><!-- .field -->
				<div class="field">
					<select name="pais">
						<option value="">'.$this->trans($lang,'País','Country').'</option>
						<option value="mexico">México</option>
					</select>
				</div><!-- .field -->
				<div class="field">
					<input name="estado" class="requerido" type="text" placeholder="'.$this->trans($lang,'Estado / Municipio','City / State').'">
				</div><!-- .field -->
				<div class="field">
					<input name="codigopostal" class="requerido" type="text" placeholder="'.$this->trans($lang,'Código Postal','Zip Code').'">
				</div><!-- .field -->
				<div class="field">
					<input name="telefono" class="requerido" type="text" placeholder="'.$this->trans($lang,'Teléfono','Phone').'">
				</div><!-- .field -->
				<div class="field">
					<input name="email" type="email" class="requerido" placeholder="'.$this->trans($lang,'Correo electrónico','EMail').'">
				</div><!-- .field -->
				<div class="field how">
					<select name="comoseentero">
						<option value="">'.$this->trans($lang,'¿Cómo se enteró de nosotros?','How did you hear of us?').'</option>
						<option value="un amigo">A través de un amigo</option>
					</select>
					<br class="clear">
				</div><!-- .field -->
				<br class="clear">
				<div class="required-fields">
					* '.$this->trans($lang,'Campos Obligatorios','Required').'
				</div><!-- .required-fields -->
				<textarea name="comentario" placeholder="'.$this->trans($lang,'Comentario','Comment').'"></textarea>
				<input name="enviar" id="btn-submit" type="submit" class="general-btn" value="'.$this->trans($lang,'Enviar','Send').'">
			</form>
		</div><!-- .contact-form -->';

		$this->addbread( array("url"=>"/contact" , "label"=>"Contacto ") );
		$this->header($lang);

		echo $html;
		$this->footer($lang);
	}

}

