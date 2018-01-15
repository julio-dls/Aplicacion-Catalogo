<?php
require_once ('phpmailermaster/vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
/*
* SMTP
* Host:	smtp.mailtrap.io
* Port:	25 or 465 or 2525
* Username:	095854ad93c9d4
* Password:	8b7d99ed39a6ea
* Auth:	PLAIN, LOGIN and CRAM-MD5
* TLS:	Optional
*/
class contact
{
  private $con;
  const SECRET_PASS = '8b7d99ed39a6ea';
  const SECRET_USER = '095854ad93c9d4';

  function __construct($con)
  {
    $this->con=$con;
  }

  function exist($data = array())
  {
    if (!empty($data['name']) && !empty($data['email']) && !empty($data['message']))
    {
      $mail = new PHPMailer;
      $mail->isSMTP();                                                          //ESTABLECER EL USO DE CORREO
      $mail->Host =  'smtp.gmail.com';//'smtp.mailtrap.io';
      $mail->SMTPAuth = true;
      $mail->Username = self::SECRET_USER;
      $mail->Password = self::SECRET_PASS;                                      //CONTRASEÑA EN CONSTANTES
      // $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
      $mail->SMTPSecure = "ssl";
      $mail->Port = 465;
      // $mail->Port = 25 or 465 or 587;
      $mail->setFrom($data['email']);                                           //REMITENTE
      $mail->addAddress(self::SECRET_USER);                                     //DESTINATARIO
      $mail->isHTML(true);                                                      //EL CORREO SE ENVIA COMO HTML
      $mail->Subject  = "Consutla de: " .$data['name'];                         //ASUNTO
      $mail->Body =
      '<!DOCTYPE html>'.
      '<html>'.
        '<head>'.
          '<meta charset="utf-8">'.
          '<title>Tribu Cuero</title>'.
          '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />'.
        '</head>'.
        '<body>'.
          '<h2>Consulta Realizada desdes pagina web.</h2><br />'.
          '<h4>'.$data['message'].'</h4>'.
          '<hr>'.
          '<h5>Datos de contacto:</h5>'.
          '<h6>Nombre: '.$data['name'].'</h6>'.
          '<h6>Email: '.$data['email'].'</h6>'.
          '<h6>Ciudad: '.$data['country'].'</h6>'.
          '<h6>Telefono: '.$data['phone'].'</h6>'.
          '<h6>Donde nos Conocio: '.$data['options'].'</h6>'.
        '</body>'.
      '</html>';
      $mail->send();
      // if(!$mail->send()) {
      //   echo 'Mailer error: ' .$mail->ErrorInfo;
      // } else {
      //   echo 'Message has been sent.';
      // }
    }
  }
}
