<?php
class crear_usuario {

  private $con;

    function __construct($con) {
      $this->con=$con;
    }

    function insertUser($data = array()) {
    $verifyUser = $this->con->query("SELECT * FROM usuarios WHERE usuarios.nombre_usuario = '".$data['nameusuario']."' and email= '".$data['email']."' ")->fetch();

    if (empty($verifyUser)) {                                                   //VERIFICAR QUE EL USUARIO NO SE ENCUENTRE YA CARGADO
      $insertUser = $this->con->query("SELECT id FROM permisos WHERE permisos.nombre = '".$data['privilegiosR']."' ")->fetch();
      $sql="INSERT INTO usuarios (id,email,pass,nombre,nombre_usuario,permisos)
      VALUES ('','".$data['email']."','".md5($data['pass'])."','".$data['nombre']."','".$data['nameusuario']."','".$insertUser['id']."' )";
      $insertUser = $this->con->exec($sql);

      if ($insertUser) {
        redirect('login.php');
      }
    } else
      {
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
