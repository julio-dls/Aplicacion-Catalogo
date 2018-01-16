<?php
class Acceso_user {

  private $con;

	function __construct($con){
		$this->con = $con;
	}

  //VERIFICAR EXISTENCIA DE USUARIO
  function login ($data = array()){

    if(!empty($data['nombre_usuario']) AND !empty($data['pass'])) {
      $resultado = $this->con->query("SELECT usuarios.nombre_usuario, usuarios.pass, permisos.id FROM usuarios inner join permisos on usuarios.permisos=permisos.id WHERE usuarios.nombre_usuario = '".$data['nombre_usuario']."' and usuarios.pass = '".md5($data['pass'])."' ")->fetch();

      if (!empty($resultado['nombre_usuario']) and !empty($resultado['pass'])) {
          $_SESSION['usuario'] = $resultado['nombre_usuario'];
          $_SESSION['password'] = $resultado['pass'];
          $_SESSION['privilegios'] = $resultado['id'];
          redirect('panel.php');
      } else {
          redirect('login.php');
      }
    }
  }
  // ELIMINAR USUARIO
  function logout($datos = array()){
    if(isset($datos['logout'])){
      unset($_SESSION['usuario']);
      unset($_SESSION['password']);
      unset($_SESSION['privilegios']);
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
