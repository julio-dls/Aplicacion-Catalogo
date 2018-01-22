<?php
require_once ('../Ange-Web/phpmailermaster/vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
include_once 'password_reset.php';
/*
* SMTP
* Host:	smtp.mailtrap.io
* Port:	25 or 465 or 2525
* Username:	095854ad93c9d4
* Password:	8b7d99ed39a6ea
* Auth:	PLAIN, LOGIN and CRAM-MD5
* TLS:	Optional
*/
class updateuser {
  private $con;
  const SECRET_PASS = '8b7d99ed39a6ea';
  const SECRET_USER = '095854ad93c9d4';

  function __construct($con) {
    $this->con=$con;
  }

  function exist($data = array()) {
    $result=$this->con->query("select email,nombre from usuarios where email = '".$data['email']."' or nombre_usuario = '".$data['email']."' ")->fetch();

    if (!empty($result['nombre']) && !empty($result['email']))
    {
      $message = new password_reset_mensaje();

      $ejecut=$this->con->exec("INSERT INTO actualizacion_pass (id,nombre,codigo,fecha,actualizado,email)
                                VALUES ('','".$result['nombre']."','".$codigo."','".date('d/m/y h:i:s')."','false','".$result['email']."'); ");
      $mail = new PHPMailer;
      $mail->isSMTP();                                                          //ESTABLECER EL USO DE CORREO
      $mail->Host =  'smtp.gmail.com';//'smtp.mailtrap.io';
      $mail->SMTPAuth = true;
      $mail->Username = self::SECRET_USER;
      $mail->Password = self::SECRET_PASS;                                      //CONTRASEÑA EN CONSTANTES
      // $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
      $mail->SMTPSecure = "ssl";
      $mail->Port = 465;
      $mail->setFrom('<noreply...@gmail.com>');                                  //REMITENTE
      $mail->addAddress($result['email']);                                      //DESTINATARIO
      $mail->isHTML(true);                                                      // EL CORREO SE ENVIA COMO HTML
      $mail->CharSet = 'UTF-8';                                                 //ACTIVOS CODIFICACION utf-8
      $mail->Subject  = "Restablecer Passwords";                                //ASUNTO
      $mail->Body .= $message->getMensaje();

      $_SESSION['emailValidacion'] = $result['email'];

      if($mail->send())
      {
        redirect('change_password.php');
      } else {
        //echo 'Mailer error: ' .$mail->ErrorInfo;
        redirect('forgot_password.php');
      }
    }
  }

  //CAMBIAR EL PASSWORD
  function change_pass($data = array()){

    if ($_SESSION['codigoValidacion'] == $data['codigo']) {
      $sql = "select id,email,nombre,actualizado from actualizacion_pass where email = '".trim($_SESSION['emailValidacion'])."' and fecha = (select max(fecha) from actualizacion_pass) ";
      echo "hasta aqui llego" .$sql;
      $resultado = $this->con->query($sql)->fetch();
      if ($resultado['actualizado'] == "false") {

        if (!empty($resultado['nombre']) && !empty($resultado['email'])) {
          $this->con->exec("update usuarios set pass = '".md5($data['pass'])."' where nombre = '".$resultado['nombre']."' and email = '".$resultado['email']."' ");

          $this->con->exec("update actualizacion_pass set actualizado = 'true', fecha = '".date('d/m/y h:i:s')."' where nombre = '".$resultado['nombre']."' and email = '".$resultado['email']."' and id = '".$resultado['id']."'");
          //if ($resultado2) {
            //if ($resultado3) {
              redirect('login.php');
            //}
          //}
        }
      }
    } else {
      echo "<h1> LOS CODIGOS DE VALIDACION NO COHINCIDEN ... </h1>";
    }
  }
  //VERICICAR QUE EL USUARIO EXISTA
  function isLog(){
    if(!isset($_SESSION['usuario']) and !isset($_SESSION['password']) and !isset($_SESSION['privilegios'])){
      redirect('login.php');
    }
  }

} //CIERRE DE CLASE

  //funcion para cambiar de pagina
  function redirect($pURL) {
    if (strlen($pURL) > 0)	{
      if (headers_sent())	{
        echo "<script>document.location.href='".$pURL."';</script>\n";
      } else {
        header("Location: " . $pURL);
      }
      exit();
    }
  }
?>
