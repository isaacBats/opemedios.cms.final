<?php 

/**
 * 
 */
 class User extends Controller
 {
 	

 	public function loginAction( $lang ){
 		$user = $this->pdo->quote( $_POST["username"] );
 		$pass = $_POST["password"];
 			
 			$sql =  "SELECT * FROM registros WHERE nombreusuario LIKE LOWER(".$user.") ";
 			
 			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if($rs!==false){
				$nr = $query->rowCount();
				if( $nr > 0 ){
					$user = $query->fetchAll(PDO::FETCH_ASSOC);
					if( isset( $user[0]["nombreusuario"] ) ){
						if($user[0]["pass"] == $pass){
							$_SESSION[ "user"] = $user[0];	
							header('Location: .');
						}else{
							header('Location: ./login');
						}
					}else{
						header('Location: ./login');
					}
				}
			}

		
 		
 	}
 	public function logout( $lang ){
 		session_destroy();
 		header('Location: ./login');
 	}

 	public function login( $lang ){

 		if( isset($_SESSION["user"] ) ){

 			header('Location: .');
 			exit;

 		}

 		$this->addBread( array( "label"=> "Login" ) );
 		$this->header( $lang );
 		require $this->views."login.php";
 	}

 	function saveRegistro($lang){
		
		$resultado = new stdClass();

		if( !empty($_POST) ){

			$resultado = new stdClass();

			/*************************** INSERT DEL CONTACTO ****************************************/

			$sql = "INSERT INTO registros 
						(nombre,apellidos,nombreusuario,pass,email,empresa,puesto,website,direccion1,direccion2,pais,estado,codigopostal,movil,telefono,organizacion,motivo,comoseentero) 
						VALUES 
						(:nombre,:apellidos,:nombreusuario,:pass,:email,:empresa,:puesto,:website,:direccion1,:direccion2,:pais,:estado,:codigopostal,:movil,:telefono,:organizacion,:motivo,:comoseentero);
					";
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
			$organizacion = implode(",", $_POST['organizacion'] );
			$query->bindParam(':organizacion', $organizacion);
			$query->bindParam(':motivo', $_POST['motivo']);
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
					$resultado->mensaje = ( $lang == "en" ) ? 'Thank you, we will check your info, and your will recive the confimation throug and email' : "Gracias, revisaremos tu información y recibirás la confirmación a través de un correo electrónico";
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
				<p><img alt="Registro" src="'.$this->url($lang,'/../').'images/imgRegistro.jpg"></p>
			</div>		
			<div class="acerca-secundario-quienes acerca-secundario-quienes-form">
				<h2>'.$this->trans($lang, "Registro<br>profesionistas","Register <br>to the trade").'</h2>
				<p id="mensaje"></p>
				<form method="post" id="frmRegistro" name="form-registro" action="/'.$lang.'/register"> 

					
				    <div class="separador">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Nombre(s)","First name").'" name="nombre" id="Nombre">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Apellidos","Last name").'" name="apellidos" id="Apellidos">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Nombre de usuario","Username").'" name="nombreusuario" id="NombreUsuario">
				        <input type="password" value="" class="requerido" placeholder="'.$this->trans($lang, "Contraseña","Password").'" name="passworduno" id="passworduno">
				        <input type="password" value="" class="requerido" placeholder="'.$this->trans($lang, "Confirmar contraseña","Confirm password").'" name="passworddos" id="passworddos">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Correo electrónico","E-mail adress").'" name="email" id="Email" >
				    </div>
				    <div class="separador">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Empresa","Company").'" name="empresa" id="Empresa">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Puesto","Job title").'" name="puesto" id="Puesto">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Website empresa","Website company").'" name="website" id="Website">
				    </div>
				    <div class="separador">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Dirección","Address").'" name="direccion1" id="Direccion1">
				        <input type="text" class="requerido" value="" placeholder="'.$this->trans($lang, "Colonia","Region").'" name="direccion2" id="Direccion2">
				        <br>
				        <select title="País" placeholder="'.$this->trans($lang, "País","Country").'" name="pais" id="Pais">
					        <option value="">País</option>
							<option value="Mexico">Mexico</option>
							<option value="Spain">Spain</option>
						</select>
				        <br>
				        <input type="text" value="" placeholder="'.$this->trans($lang, "Estado / Municipio","State").'" name="estado" id="Estado" class="mediano2 requerido">
				        <input type="text" value="" placeholder="'.$this->trans($lang, "Código Postal","Zip code").'" name="codigopostal" id="CodigoPostal" class="mediano2">
				        <input type="text" value="" placeholder="'.$this->trans($lang, "Mobil","Mobile").'" name="movil" id="Movil" class="mediano2">
				        <input type="text" value="" placeholder="'.$this->trans($lang, "Teléfono","Phone").'" name="telefono" id="Telefono" class="mediano2">
				    </div>
				    <div class="separador">
				        <label>
				            '.$this->trans($lang, "Organización Profesional","Organization").'</label>
				        <br>
				        <label>
				            <input type="checkbox" value="American Society of Interior Designers" name="organizacion[]" id="RegistroAsid">
				        ASID</label>
				        <label>
				            <input type="checkbox" value="American Institute of Architects" name="organizacion[]" id="RegistroAia">
				            AIA</label>
				        <label>
				            <input type="checkbox" value="IBD" name="organizacion[]" id="RegistroIbd">
				            IBD</label>
				        <br>
				        <select title="Motivo de afiliación" placeholder="'.$this->trans($lang, "Motivo de afiliación","Reason").'" name="motivo" id="Motivo">
					        <option value="">'.$this->trans($lang, "Motivo de afiliación","Reason").'</option>
							<option value="Soy Decorador">Soy Decorador</option>
							<option value="Soy Arquitecto">Soy Arquitecto</option>
							<option value="Soy Especificador">Soy Especificador</option>
							<option value="Otro">Otro</option>
						</select>
				        <select title="¿Cómo se enteró de nosotros?" placeholder="'.$this->trans($lang, "¿Cómo se enteró de nosotros?","How did you find us?").'" name="comoseentero" id="ComoSeEntero">
				        	<option value="">'.$this->trans($lang, "¿Cómo se enteró de nosotros?","How did you find us?").'</option>
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
				            <input type="checkbox" value="true" name="registroftk" id="RegistroFtk">
				            '.$this->trans($lang, "Registrarme a", "Add me to the list").' <em>Be the First to know</em>
				        </label><br>
				        <label>
				            <input type="checkbox" value="true" name="registromailing" id="RegistroMailing">
				            '.$this->trans($lang, "Añadirme a la", "Add mi to the").' <em>'.$this->trans($lang, "Lista de correo","Email list").'</em>
				        </label>
				        <br>
				    </div>
				    <div class="separador">
				        <a href="http://www.alfonsomarinaebanista.com/es/terminos.aspx" target="_blank">'.$this->trans($lang, "Leer términos y condiciones", "Terms and conditions").'</a>
				    </div>
				    <div class="separador">
				        <input id="btn-registro" type="submit" value="'.$this->trans($lang , "Enviar" , "Send").'">
				    </div>
				</form>
			</div>
			<br class="clear">
		</div>';

		$this->addbread( array("url"=>"/register" , "label"=>"Registro ") );
		$this->header($lang);
		echo $html;
		$this->footer( $lang );
	}

 } 

 ?>