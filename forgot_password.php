<?php
SESSION_START();
include_once('inc/header.php');
include_once('inc/config_conexion_db.php');
include_once('inc/updateuser.php');

if (!empty($_POST)) {
  $userupdate = new updateuser($con);
  $userupdate->exist($_POST);
}
?>
    <body>
		<div class="wrapper">
			<h1>Tribu Cueros</h1> <br>
			<h2>Panel <span>Administracion</span>: solo usuarios registrados</h2>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="forgot_password active" action="forgot_password.php" method="POST">
						<h3>Se te olvidó tu contraseña</h3>
						<div>
							<label>Usuario o correo electrónico:</label>
							<input type="text" name="email" placeholder="correo@ejemplo.com"/>
							<span class="error">This is an error</span>
						</div>
						<div class="bottom">
							<input type="submit" value="Send reminder">
							<a href="login.php" rel="login" class="linkform">De repente se acordó? Entre aquí</a>
							<div class="clear"></div>
						</div>
					</form>
				</div>
				<div class="clear"></div>
			</div>
			<a class="back" href=""></a>
		</div>

<!-- FIN DEL FORM LOGIN-->
<?php include_once('inc/footer.php');?>
