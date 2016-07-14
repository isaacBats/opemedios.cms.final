<?php 

require_once(__DIR__ . '/../admin/lib/php-mailer/PHPMailerAutoload.php');

Class Mail{

	private $mail;
	
	public function __construct( $contacts ){

		$properties = parse_ini_file(__DIR__ . '/../config.ini');
			
		$this->mail = new PHPMailer();
		$this->mail->IsSMTP();
		$this->mail->isHTML(true);
		$this->mail->SMTPAuth = true;

		$this->mail->SMTPSecure = $properties['SMTPSecure'];
		$this->mail->Host = $properties['hostEmail'];
		$this->mail->Port = $properties['port'];
		$this->mail->Username = $properties['email'];
		$this->mail->Password = $properties['passwordEmail'];
		if( count( $contacts ) != 0 ){
			foreach ($contacts as $key => $contact) {
				if( $key != 'noticiaid' ){
					$this->mail->AddAddress( $key, $contact );
					echo $contact . ' - ' . $key;
				}
			}
			exit();			
		}else{
			$this->mail->AddAddress( $properties['emailReceptor'], 'Usuario Opemedios' );			
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

	public function sendMail(){

		return $this->mail->Send();
	}

}