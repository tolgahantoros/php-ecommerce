<?php 

require_once 'mailer/class.phpmailer.php';
require_once 'class.crud.php';
class mail{


	private $gonderen;
	private $gonderen_adsoyad;
	private $host;
	private $pass;
	private $smtp;


	function __construct(){
		$mail = new PHPMailer();
		
		$db   = new crud();

		$mail_ayarlari = $db->read("mail_ayar");
		$mail_ayarlari = $mail_ayarlari->fetch(PDO::FETCH_ASSOC); 

		$this->gonderen = $mail_ayarlari['mail_adres'];
		$this->gonderen_adsoyad = $mail_ayarlari['mail_adsoyad'];
		$this->host = $mail_ayarlari['mail_host'];
		$this->pass = $mail_ayarlari['mail_pass'];
		$this->smtp = $mail_ayarlari['mail_smtp'];

	}


	public function mail_gonder($alici,$konu,$icerik){

		try {

			$mail = new PHPMailer();
			$mail->IsSMTP(true);
			$mail->From     = $this->gonderen;
			$mail->Sender   = $this->gonderen;
			$mail->AddReplyTo=($this->gonderen); 
			$mail->AddAddress($alici);  
			$mail->FromName = $this->gonderen_adsoyad;
			$mail->Host     = $this->host;
			$mail->SMTPAuth = true;
			$mail->Port     = 587;    
			$mail->CharSet = 'UTF-8'; 
			$mail->IsHTML(true);
			$mail->Username = $this->gonderen;
			$mail->Password = $this->pass;
			$mail->Subject  = $konu;
			$mail->Body = $icerik;
			if ($mail->Send()) {
				
				return ['status' => TRUE];

			} 
			else {

				return ['status' => FALSE,'error' => $mail->ErrorInfo];  

			}
			
		} catch (Exception $e) {
			echo $e;
		}

	}

}


// $test = new mail();

// $test->mail_gonder("sallagitmesin@gmail.com","Php İle Gönderim","Merhabalar onur bu test.");




?>