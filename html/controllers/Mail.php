<?php 

require_once(__DIR__ . '/../admin/lib/php-mailer/PHPMailerAutoload.php');

Class Mail 
{

	private $mail;
	
	public function __construct(){

		$properties = parse_ini_file(__DIR__ . '/../config.ini');

		$serverMail = $properties['WebMailType'];
			
		$this->mail = new PHPMailer();
		$this->mail->isHTML(true);
                $this->mail->CharSet = 'UTF-8';
		
		if ($serverMail == 'smtp') {
			$this->mail->IsSMTP();
			$this->mail->SMTPAuth = true;
			$this->mail->SMTPSecure = $properties['SMTPSecure'];
			$this->mail->Host = $properties['hostEmail'];
			$this->mail->Port = $properties['port'];
			$this->mail->Username = $properties['email'];
			$this->mail->Password = $properties['passwordEmail'];
		}		
		$this->mail->SetFrom($properties['emailSender'], 'Noticias OPEMEDIOS');
		$this->mail->Subject = 'Mensaje de prueba';
		$this->mail->Body =
							'<h1>Este es un mensaje de prueba</h1>
								<p>Desde la Clase Mail</p>
								<p>By Isaac Daniel </p><strong><a href="https://twitter.com/codeisaac">@codeisaac</a></strong>';
	}

	public function setSubject( $subject ){

		$this->mail->Subject = $subject;
	}

	public function setBody( $body ){

		$this->mail->Body = $body;
	}

	public function sendMail( $email, $name ){

	 	$this->mail->AddAddress( $email, $name );		

		$exito = ( $this->mail->Send() ) ? true : false;

		$this->mail->ClearAddresses();

		return $exito;
	}

}