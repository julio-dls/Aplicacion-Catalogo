<?php
SESSION_START();
include_once('inc/header.php');
include_once('inc/config_conexion_db.php');
include_once ('inc/crear_usuario.php');

$newuser = new crear_usuario($con);
$newuser->isLog();

if (!empty($_POST)) {
  $newuser->insertUser($_POST);
}
?>
    <div class="wrapper">
        <h1>Tribu Cueros</h1> <br>
        <h2>Panel <span>Administracion</span>: solo usurios registrados</h2>
        <div class="content">
            <div id="form_wrapper" class="form_wrapper">
                <form class="register active" action="register.php" method="post">
                    <h3>Registrar<span style="visibility:<?=empty($_GET['Aviso'])?$_GET['Aviso']='hidden':$_GET['vible'];?>">: No se Creo Usuario</span></h3>
                    <div class="column">
                        <div>
                            <label>Nombre:</label>
                            <input type="text" name="nombre" placeholder="Nombre" />
                            <span class="error">This is an error</span>
                        </div>
                        <div>
                            <label>Nombre Usuario:</label>
                            <input type="text" name="nameusuario" placeholder="Nombre Usuario" />
                            <span class="error">This is an error</span>
                        </div>
                        <div>
                          <label>Privilegios:</label>
                          <select name="privilegiosR">
                            <?php $res = $con->query("SELECT nombre FROM permisos");
                              foreach ($res as $row)
                              { ?>
                                <option value="<?=$row[0]?>"><?=strtoupper($row[0])?></option>
                        <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="column">
                        <div>
                            <label>Email:</label>
                            <input type="text" name="email" placeholder="Correo electronico" />
                            <span class="error">This is an error</span>
                        </div>
                        <div>
                            <label>Password:</label>
                            <input type="password" name="pass" placeholder="Password" />
                            <span class="error">This is an error</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="remember">
                        </div>
                        <input type="submit" value="Register" />
                        <a href="login.php" rel="login" class="linkform">Ya tengo una cuenta!</a>
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once('inc/footer.php');?>
