<?php
  session_start();
  include_once('inc/config_conexion_db.php');
  include_once ('inc/imgIndex.php');

  $dPanel = new dataPanel($con);
  $dPanel->isLog();

  if (!empty($_POST)) {
    $dPanel->exterminarusers($_POST);
  }
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">

    <title>Tribu Cueros</title>
    <!-- Bootstrap core CSS -->
    <link href="panel/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../../panel/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../../panel/css/style.css" rel="stylesheet">
    <link href="../..b/panel/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>
  <section id="container" class="non-scroll">
      <!-- HEADER START -->
      <header class="header black-bg">
          <div class="sidebar-toggle-box">
              <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
          </div>
          <!--logo end-->
          <div class="top-menu">
              <ul class="nav pull-right top-menu">
                  <li><a class="logout" href="login.php?logout">Logout</a></li>
              </ul>
          </div>
      </header>
      <!-- HEADER END -->
      <!--sidebar start-->
      <aside>
          <?php include_once('inc/sidebar.php'); ?>
      </aside>
      <!--sidebar end-->

      <!-- COMIENZO ELIMINAR IMAGENES -->
      <section id="main-content" class="wrapper">
       <div class="container">
          <div class="row">
            <div class="form-panel col-lg-10">
            <h1 class="mb"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Galeria: Eliminar Usuarios</h1>
            <h3><span style="visibility:<?=empty($_GET['flag'])?$_GET['flag']='hidden':$_GET['flag'];?>">Exito! El usuario ha sido eliminada correctamente</span></h3>
            <form class="form-horizontal tasi-form text-center" action="deleteusers.php" method="post">
                <div class="form-group has-success">
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label col-lg-2 " for="Categoria">Usuario</label>
                        <div class="col-lg-6">
                            <select class="form-control" id="inputSuccess" name="deleteusers">
                            <?php
                            $resultadoSql = $con->query("SELECT id,nombre,nombre_usuario,email FROM usuarios order by 1 asc");
                            foreach ($resultadoSql as $rows) {?>
                            <option value="<?=$rows[0]?>"><?=$rows[1]." -- ".$rows[2]." -- ".$rows[3]?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                </div>
                <div class="form-group has-success">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <button id="inputSuccess" type="submit" class="btn btn-primary btn-lg btn-block">Delete</button>
                    </div>
                </div>
              </form>
            </div>
           </div>
        </div>
      </section>
      <!-- FIN ELIMINAR IMAGENES -->
      <!-- RELLENO -->
      <section id="main-content" class="wrapper">
      <div class="container">
         <div class="row">
           <div class="col-lg-10">
             <h3>Delete Users: <small>Pasos a seguir.</small></h3>
             <p>Buscarla en el campo de seleccion.</p>
             <p>Debe saber el nombre del usuario que desea elimiar. </p>
             <p>Una vez encontrada oprima delete</p>
           </div>
         </div>
      </div>
      </section>
      <!-- RELLENO -->
    </section>
    <!-- FIN CONTAINER-->

    <!-- RELLENO -->
    <section id="main-content" class="wrapper">
    <div class="container">
       <div class="row">
         <div class="col-lg-10">

         </div>
       </div>
    </div>
    </section>
    <!-- RELLENO -->

    <!-- FOOTER START -->
    <section style="position: absolute;bottom: 0; width: 100%;height: 60px;"id="footer">
      <footer class="site-footer">
        <div class="panel-body text-center">
          2017 - TRIBU CUEROS
          <a href="#main-content" class="go-top"><i class="fa fa-angle-up"></i></a>
        </div>
      </footer>
    </section>
    <!-- FOOTER END -->
    <script src="../../panel/js/jquery.js"></script>
    <script src="../../panel/js/jquery.scrollTo.min.js"></script>
    <script class="include" type="text/javascript" src="../../panel/js/jquery.dcjqaccordion.2.7.js"></script>
    <!---hacer el menu desplegable y decorarlo-->
    <script src="../../panel/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--script para toda la pagina-->
    <script src="../../panel/js/common-scripts.js"></script>
  </body>
  </html>
