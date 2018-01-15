<?php
class crear_usuario {

  private $con;

    function __construct($con) {
      $this->con=$con;
    }

    function insertUser($data = array()) {

    $sql = ("SELECT usuarios.nombre_usuario, usuarios.pass FROM usuarios WHERE usuarios.nombre_usuario = '".$data['nameusuario']."' and  email= '".$data['email']."' ");
    $verifyUser = $this->con->query($sql)->fetch();

    if (empty($verifyUser)) {

      $insertUserPermisos = $this->con->query("SELECT permisos.id FROM permisos WHERE permisos.nombre = '".$data['privilegiosR']."' ")->fetch();

      $sqlInsert = "INSERT INTO `usuarios`(`email`, `pass`, `nombre`, `nombre_usuario`, `permisos`)
      VALUES  ('".$data['email']."','".md5($data['pass'])."','".$data['nombre']."','".$data['nameusuario']."','".$insertUserPermisos['id']."' )";

      $insertUser = $this->con->exec($sqlInsert);
      //print_r($this->con->errorInfo());
      if ($insertUser) {
        redirect('login.php');
      } else {
          redirect('register.php?Aviso=visible');
        }
    } else {
        redirect('register.php?Aviso=visible');
      }
  }
  // CORROBORAR QUE ESTA LOGUEADO
  function isLog(){
    if(!isset($_SESSION['usuario']) and !isset($_SESSION['password']) and !isset($_SESSION['privilegios'])){
      redirect('login.php');
    }
  }
}
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
