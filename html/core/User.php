<?php 

/**
 * 
 */
 class User extends Controller
 {
 	

 	public function login( $lang ){
 		$this->addBread( array( "label"=> "Login" ) );
 		$this->header( $lang );

 		require $this->views."login.php";
 	}

 	function saveRegistro($lang){
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

			$registro = $query->execute();
			if($registro){
				$cuerpo_email = 'HTML del correo';
				$cabeceras='From: adan@denumeris.com ' . "\r\n" .
				'Reply-To: adan@denumeris.com ' . "\r\n" .
				'Content-type: text/html; charset=utf-8' . "\r\n".
				'X-Mailer: PHP/' . phpversion();

				if(mail('adan@denumiers.com','Ha recibido un nuevo contacto',$cuerpo_email,$cabeceras)){
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
		$html = '<div class="registro">        
			<div class="acerca-principal-quienes acerca-principal-quienes-form">
				<p><img alt="Registro" src="images/imgRegistro.jpg"></p>
			</div>		
			<div class="acerca-secundario-quienes acerca-secundario-quienes-form">
				
				<form method="post" id="frmRegistro" data-ajax-update="#target" data-ajax-success="RFSuccess()" data-ajax-mode="replace" data-ajax-method="POST" data-ajax-failure="RFError()" data-ajax="true" action="/umbraco/Surface/Account/RegisterUser" novalidate="novalidate">    <h2>Registro<br>profesionistas</h2>
				    <div class="separador">
				        <input type="text" value="" placeholder="Nombre(s)" name="Nombre" id="Nombre" data-val-required="*" data-val="true" class="requerido text-label">
				        <input type="text" value="" placeholder="Apellidos" name="Apellidos" id="Apellidos" data-val-required="*" data-val="true" class="requerido text-label">
				        <input type="text" value="" placeholder="Nombre de usuario" name="NombreUsuario" id="NombreUsuario" data-val-required="*" data-val="true" class="requerido text-label">
				        <input type="email" value="" placeholder="Correo electrónico" name="Email" id="Email" data-val-required="The Email field is required." data-val-regex-pattern="^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$" data-val-regex="!" data-val="true" class="requerido text-label">
				    </div>
				    <div class="separador">
				        <input type="text" value="" placeholder="Empresa" name="Empresa" id="Empresa" data-val-required="*" data-val="true" class="requerido text-label">
				        <input type="text" value="" placeholder="Puesto" name="Puesto" id="Puesto" data-val-required="*" data-val="true" class="requerido text-label">
				        <input type="text" value="" placeholder="Website empresa" name="Website" id="Website" data-val-required="*" data-val="true" class="requerido text-label">
				    </div>
				    <div class="separador">
				        <input type="text" value="" placeholder="Dirección" name="Direccion1" id="Direccion1" data-val-required="*" data-val="true" class="requerido mediano text-label">
				        <input type="text" value="" placeholder="Colonia" name="Direccion2" id="Direccion2" class="mediano text-label">
				        <br>
				        <select title="País" placeholder="País" name="Pais" id="Pais">
					        <option value="0">País</option>
							<option value="Mexico">Mexico</option>
							<option value="Spain">Spain</option>
						</select>
				        <br>
				        <input type="text" value="" placeholder="Estado / Municipio" name="Estado" id="Estado" data-val-required="*" data-val="true" class="requerido mediano2 text-label">
				        <input type="text" value="" placeholder="Código Postal" name="CodigoPostal" id="CodigoPostal" class="mediano2 text-label">
				        <input type="text" value="" placeholder="Mobil" name="Movil" id="Movil" class="mediano2 text-label">
				        <input type="text" value="" placeholder="Teléfono" name="Telefono" id="Telefono" class="mediano2 text-label">
				    </div>
				    <div class="separador">
				        <label>
				            Organización Profesional</label>
				        <br>
				        <label>
				            <input type="checkbox" value="true" title="American Society of Interior Designers" name="RegistroAsid" id="RegistroAsid" data-val-required="The RegistroAsid field is required." data-val="true"><input type="hidden" value="false" name="RegistroAsid">
				        ASID</label>
				        <label>
				            <input type="checkbox" value="true" title="American Institute of Architects" name="RegistroAia" id="RegistroAia" data-val-required="The RegistroAia field is required." data-val="true"><input type="hidden" value="false" name="RegistroAia">
				            AIA</label>
				        <label>
				            <input type="checkbox" value="true" title="IBD" name="RegistroIbd" id="RegistroIbd" data-val-required="The RegistroIbd field is required." data-val="true"><input type="hidden" value="false" name="RegistroIbd">
				            IBD</label>
				        <br>
				        <select title="Motivo de afiliación" placeholder="Motivo de afiliación" name="Motivo" id="Motivo">
					        <option value="0">Motivo de afiliación</option>
							<option value="Soy Decorador">Soy Decorador</option>
							<option value="Soy Arquitecto">Soy Arquitecto</option>
							<option value="Soy Especificador">Soy Especificador</option>
							<option value="Otro">Otro</option>
						</select>
				        <select title="¿Cómo se enteró de nosotros?" placeholder="¿Cómo se enteró de nosotros?" name="ComoSeEntero" id="ComoSeEntero">
				        	<option value="0">Cómo se enteró de nosotros</option>
							<option value="Revista">Revista</option>
							<option value="Diseñador">Diseñador</option>
							<option value="Arquitecto">Arquitecto</option>
							<option value="Correo Electrónico/Newsletter">Correo Electrónico/Newsletter</option>
							<option value="Sitio Web/Buscador">Sitio Web/Buscador</option>
							<option value="Blog">Blog</option>
							<option value="Redes Sociales">Redes Sociales</option>
							<option value="Conocido/Amigo">Conocido/Amigo</option>
							<option value="Periódico">Periódico</option>
							<option value="Representante de Ventas">Representante de Ventas</option>
							<option value="Cuenta Existente">Cuenta Existente</option>
						</select>
				        <br>
				    </div>
				    <div class="separador">
				        <label>
				            * Campos obligatorios</label>
				        <br>
				        <label>
				            <input type="checkbox" value="true" name="RegistroFtk" id="RegistroFtk" data-val-required="The RegistroFtk field is required." data-val="true"><input type="hidden" value="false" name="RegistroFtk">
				            Registrarme a <em>Be the First to know</em>
				        </label><br>
				        <label>
				            <input type="checkbox" value="true" name="RegistroMailing" id="RegistroMailing" data-val-required="The RegistroMailing field is required." data-val="true"><input type="hidden" value="false" name="RegistroMailing">
				            Añadirme a la <em>Lista de correo</em>
				        </label>
				        <br>
				    </div>
				    <div class="separador">
				        <a href="http://www.alfonsomarinaebanista.com/es/terminos.aspx">Leer términos y condiciones</a>
				    </div>
				</form>
			</div>
			<br class="clear">
		</div>';

		$this->addbread( array("url"=>"/register" , "label"=>"Registro ") );
		$this->header($lang);

		echo $html;
	}

 } 

 ?>