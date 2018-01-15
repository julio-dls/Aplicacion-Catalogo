<?php
  session_start();
  include_once ('inc/config_conexion_db.php');
  include_once ('inc/dataPanel.php');

  $dPanel = new dataPanel($con);
  $dPanel->isLog();

  if (!empty($_POST) and !empty($_FILES)) {
    $dPanel->InsertarProcuto($_POST,$_FILES);
  }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Tribu Cueros</title>

        <meta charset="utf-8">
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

    <!-- COMIENZON DE FORM-->
    <section id="main-content" class="wrapper">
     <div class="container">
        <div class="row">
          <div class="form-panel col-lg-10">
          <h3 class="mb"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Insertar Nuevos Articulos en Galeria</h3>
          <h6 class="mb"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:blue"></span>
            <strong>Las descripciones no deben superar los 400 caracters.</strong></h6>
          <h6 class="mb"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:blue"></span>
            <strong>Todos los campos son obligatorios, de lo contrario no cargara las imagenes</strong></h6>
          <h6 class="mb"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:blue"></span>
            <strong>Puede insertar de a una imagen o un grupo de ellas de las cuales en galeria se vera solo una
            y en detalle todas las ingresadas pertenecientes al mismo grupo</strong></h6>
          <form class="form-horizontal tasi-form text-center" action="panel.php" method="post" enctype="multipart/form-data">
              <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Nombre</label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <input type="text" class="form-control" id="inputSuccess" name="articulos" placeholder="Nombre Articulo">
                  </div>
              </div>
              <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Nombre en Ingles</label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <input type="text" class="form-control" id="inputSuccess" name="namearticle" placeholder="Name Article">
                  </div>
              </div>
              <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2 " for="Categoria">Categoria</label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <select class="form-control cat_id" id="categoria" name="categoria" onfocus="detectionFocus(0)">
                      <?php
                      $consul = "SELECT nombre FROM categorias";
                      $res = $con->query($consul);
                      foreach ($res as $row) {?>
                      <option value="<?=$row[0]?>"><?=$row[0]?></option>
                      <?php } ?>
                    </select>
                  </div>
              </div>
              <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2 " for="Categoria">Accesorios</label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <select class="form-control" id="accesorios" name="accesorios" onfocus="detectionFocus(1)">
                      <?php
                      $consul = "SELECT nombre FROM accesorios";
                      $res = $con->query($consul);
                      foreach ($res as $row) {?>
                      <option value="<?=$row[0]?>"><?=$row[0]?></option>
                      <?php } ?>
                    </select>
                  </div>
              </div>
              <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2 " for="Categoria">Estacion</label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <select class="form-control" id="estacion" name="estacion" onfocus="detectionFocus(0)">
                      <?php
                      $consul = "SELECT nombre FROM estacion";
                      $res = $con->query($consul);
                        foreach ($res as $row) {?>
                          <option value="<?=$row[0]?>"><?=$row[0]?></option>
                      <?php } ?>
                    </select>
                  </div>
              </div>
              <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">Imagenes</label>
                  <div class="col-lg-6 col-md-6 col-sm-6">
                      <input type="file" class="form-control" id="inputSuccess" name="archivosImg[]" multiple accept="image/*">
                  </div>
              </div>
              <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2" for="inputError">Descripcion</label>
                  <div class="col-lg-10">
                      <textarea class="form-control" id="inputSuccess" name="descripcion" rows="10" style="resize: none"></textarea>
                  </div>
              </div>
              <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2" for="inputError">Descripcion en Ingles</label>
                  <div class="col-lg-10">
                      <textarea class="form-control" id="inputSuccess" name="description" rows="10" style="resize: none"></textarea>
                  </div>
              </div>
              <div class="form-group has-success">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-md-offset-4">
                      <button id="inputSuccess" type="submit" class="btn btn-primary btn-lg btn-block">Aplicar</button>
                  </div>
              </div>
              <div class="form-group has-success">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-md-offset-4">
                    <button id="inputSuccess" type="reset" class="btn btn-warning btn-lg btn-block" onclick="desblock(true)">Limpiar</button>
                  </div>
              </div>
          </form>
        </div>
        </div>
      </div>
    </section>
    <!-- FIN DE FORM -->
    <!-- IMAGENES DE PORTADA -->
  </section>
  <!-- FIN CONTAINER-->

  <!-- FOOTER START -->
  <section id="footer">
    <footer class="site-footer">
      <div class="panel-body text-center">
        2017 - TRIBU CUEROS
        <a href="#main-content" class="go-top"><i class="fa fa-angle-up"></i></a>
      </div>
    </footer>
  </section>
  <!-- FOOTER END -->

    <!-- comienzo bloqueo campos -->
    <script type="text/javascript">
      function detectionFocus(valor) {
        if (valor == 0) {
          document.getElementById('accesorios').disabled = true;
        } else if (valor == 1) {
          document.getElementById('estacion').disabled = true;
          document.getElementById('categoria').disabled = true;
        }
      }

      function desblock(values) {
        if (values) {
          document.getElementById('estacion').disabled = false;
          document.getElementById('categoria').disabled = false;
          document.getElementById('accesorios').disabled = false;
        }
      }
    </script>
    <!-- fin bloqueo campos -->
    <script src="/panel/js/jquery.js"></script>
    <script src="/panel/js/jquery.dcjqaccordion.2.7.js" class="include" type="text/javascript"></script>
    <!---hacer el menu desplegable y decorarlo-->
    <script src="/panel/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--script para toda la pagina-->
    <script src="/panel/js/bootstrap.min.js"></script>
    <script src="/panel/js/common-scripts.js"></script>
    <script src="/panel/js/ui/eliminarYmodificarImg.js" type="text/javascript"></script>
</body>

</html>
