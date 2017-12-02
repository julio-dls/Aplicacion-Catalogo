<?php
session_start();
include_once('inc/header.php');
include_once('inc/config_conexion_db.php');
require_once('inc/Acceso_user.php');

$access = new Acceso_user($con);
$access->login($_POST);
$access->logout($_GET);

?>
  <!-- COMIENZO DEL LOGIN -->
  <div class="wrapper">
      <h1>Tribu Cueros</h1><br />
      <h2>Panel <span>Administracion</span>: solo usuarios registrados</h2>
      <div class="content">
          <div id="form_wrapper" class="form_wrapper">
              <form class="login active" action="login.php" method="post">
                  <h3>Login</h3>
                  <div>
                      <label>Nombre de Usuario:</label>
                      <input type="text" name="nombre_usuario" placeholder="Usuario" />
                      <span class="error">This is an error</span>
                  </div>
                  <div>
                      <label>Contraseña: <a href="forgot_password.php" rel="forgot_password" class="forgot linkform">Olvidaste tu Contraseña?</a></label>
                      <input type="password" name="pass" placeholder="Contraseña" />
                      <span class="error">This is an error</span>
                  </div>
                  <div class="bottom">
                      <div class="remember"></div>
                      <input type="submit" value="Login" />
                      <a href="#" rel="register" class="linkform"></a>
                      <div class="clear"></div>
                  </div>
              </form>
          </div>
      </div>
  </div>
  <!-- FIN DEL FORM LOGIN-->
<?php include_once('inc/footer.php');?>
