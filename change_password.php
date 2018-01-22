<?php
  session_start();
  include_once('inc/config_conexion_db.php');
  include_once('inc/updateuser.php');

  $userupdate = new updateuser($con);
  //$userupdate->isLog();

  if (!empty($_POST)) {
    if ($_POST['pass'] == $_POST['newpass']) {
      $userupdate->change_pass($_POST);
    } else {
      echo "<h1> LAS CONTRASEÑAS SON DIFERENTES. </h1>";
    }
  }
?>
<?php include_once('inc/header.php')?>
    <body>
		<div class="wrapper">
			<h1>Tribu Cueros</h1> <br>
			<h2>Panel <span>Administracion</span>: solo usuarios registrados</h2>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="forgot_password active" action="change_password.php" method="POST">
						<h3>Restablecer Contraseña</h3>
                        <div>
							<label>Codigo de Email</label>
							<input type="text" name="codigo" placeholder=""/>
							<span class="error">This is an error</span>
						</div>
                        <div>
							<label>Nueva Contraseña</label>
							<input type="Password" name="pass" placeholder=""/>
							<span class="error">This is an error</span>
						</div>
                        <div>
							<label>Repita Contaseña</label>
							<input type="Password" name="newpass" placeholder=""/>
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
