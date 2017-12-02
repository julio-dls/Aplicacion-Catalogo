<?php
session_start();
include_once('inc/config_conexion_db.php');
include_once('inc/imgIndex.php');

$imgindex = new imgIndex($con);
$imgindex->isLog();

  if (!empty($_POST) and !empty($_FILES)) {
    $imgindex->nuevaImgIndex($_POST,$_FILES);
  }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Tribu Cueros</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="/panel/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="/panel/css/style-responsive.css" rel="stylesheet">
        <link href="/panel/css/style.css" rel="stylesheet">
    </head>

<body>
  <section id="container">
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
      <!-- IMAGENES DE PORTADA -->
      <section id="main-content" class="wrapper">
        <div class="container">
          <div class="col-lg-12">
            <h1>Seleccionar una images a modificar</h1>
            <div class="respuesta"></div>
          <?php
          $imagenes = $con->query("SELECT imgIndex_id from imgindex ORDER BY imgIndex_id ASC");
          foreach ($imagenes as $key) { ?>
              <img class="img-thumbnail img-responsive imangesIndex" id="imagenesSeleccionar"
              src="/images/img/<?=$key[0]?>/img_0_thumb.jpg" data-posicion="<?=$key[0]?>">
          <?php } ?>
          </div>
          <div class="form-panel col-lg-6">
            <h3 class="mb"><span class="glyphicon glyphicon-list-alt" aria-hidden="true">
            </span> Busque la imagen que desea agregar </h3>

            <form class="form-horizontal tasi-form text-center" action="imgIndexPanel.php" method="POST" enctype="multipart/form-data">
              <div class="form-group has-success">
                  <div class="col-lg-10">
                      <input hidden="true" type="text" name="id-oculto" id="id-oculto" value="">
                  </div>
              </div>
              <div class="form-group has-success">
                <label class="col-sm-2 control-label col-lg-2" for="inputWarning">Imagen</label>
                <div class="col-lg-10">
                    <input type="file" class="form-control" id="imgPortada" name="imgPortada[]" accept="image/*">
                </div>
              </div>
              <div class="form-group has-success">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="submit" id="" class="btn btn-primary btn-lg btn-block">Aplicar</button>
                </div>
              </div>
              <div class="form-group has-success">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <button id="inputSuccess" type="reset" class="btn btn-warning btn-lg btn-block">Limpiar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!--FIN DE FORM-->
    </section>
    <!-- FIN CONTAINER-->
    
    <!-- FOOTER START -->
    <section style="position: absolute;bottom: 0; width: 100%;height: 60px;"id="footer" >
      <footer class="site-footer">
        <div class="panel-body text-center">
          2017 - TRIBU CUEROS
          <a href="#main-content" class="go-top"><i class="fa fa-angle-up"></i></a>
        </div>
      </footer>
    </section>
    <!-- FOOTER END -->
    <script src="/panel/js/jquery.js"></script>
    <script src="/panel/js/jquery.scrollTo.min.js"></script>
    <script src="/panel/js/jquery.dcjqaccordion.2.7.js" class="include" type="text/javascript"></script>
    <!---hacer el menu desplegable y decorarlo-->
    <script src="/panel/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--script para toda la pagina-->
    <script src="/panel/js/common-scripts.js"></script>
  </body>
  </html>
