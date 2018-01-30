<?php
  session_start();
  include_once('inc/config_conexion_db.php');
  include_once('inc/imgIndex.php');

  $dPanel = new dataPanel($con);
  $dPanel->isLog();

  if (!empty($_POST)) {
    $dPanel->modificarImg($_POST);
  }

  if (!empty($_GET['id'])) {
    $dPanel->deleteimg($_GET);
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tribu Cueros</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="/panel/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/panel/css/style-responsive.css" rel="stylesheet">
    <link href="/panel/css/style.css" rel="stylesheet">
</head>

<body>
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
      <section class="wrapper">
       <div class="container">
           <div class="row">
                <div class="col-lg-8">
                <h1 style="margin-left:100px"> Galeria: Eliminar o Modificar Imagenes</h1>
                </div>
           </div>
       </div>
        <?php $resultadoSql = $con->query("SELECT * FROM productos order by 1 desc"); ?>
        <div class="scrollable">
        <table id="tabla-md" class="table table-striped table-hover text-center" border="1">
          <thead>
            <tr class="success">
                <td>#</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Nombre Ingles</td>
                <td>Descripcion Ingles</td>
                <td>Categoria</td>
                <td>Estacion</td>
                <td>Accesorios</td>
                <td>Accion</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $col = 1;
            foreach ($resultadoSql as $rows) {?>
              <tr>
                <td><?=$col++?></td>
                <td><?=$rows[1]?></td>
                <td class="maxMedida"><?=$rows[2]?></td>
                <td><?=$rows[3]?></td>
                <td class="maxMedida"><?=$rows[4]?></td>
                <?php $categoria = $con->query("SELECT nombre FROM categorias WHERE categoria_id=".$rows[5]." ")->fetch(); ?>
                <td><?=$categoria['nombre']?></td>
                <?php $estacion = $con->query("SELECT nombre FROM estacion WHERE estacion_id=".$rows[6]." ")->fetch(); ?>
                <td><?=$estacion['nombre']?></td>
                <?php $accesorios = $con->query("SELECT nombre FROM accesorios WHERE accesorios_id=".$rows[7]." ")->fetch(); ?>
                <td><?=$accesorios['nombre']?></td>
                <td class="accion">
                    <a href="#" data-id="<?=$rows[0]?>" class="btn btn-eliminar">Eliminar</a> |
                    <a href="#" data-id-modificar="<?=$rows[0]?>" class="btn btn-modificar" data-toggle="modal" data-target="#modificarImg">Modificar</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
      </section>
      <!-- FIN ELIMINAR IMAGENES -->

      <!--COMIENZO MODAL ESTAS SEGURO ELIMINAR-->
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">Eliminar</h4>
             </div>
             <div class="modal-body">
                 <p class="text-center">¿Seguro desea eliminar esta imagen?&hellip;</p>
             </div>
             <div class="modal-footer">
                 <button type="button" id="btn-cancelar"class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <button type="button" id="btn-aceptar" values="eliminar" class="btn btn-primary">Eliminar</button>
             </div>
         </div>
        </div>
       </div>
       <!--FIN MODAL ESTAS SEGURO ELIMINAR-->

    <!-- COMIENZON MODIFICAR IMAGENES -->
    <div class="modal fade" id="modificarImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modificar</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nombre" class="control-label" >
                <span class="glyphicon glyphicon glyphicon-asterisk" aria-hidden="true" style="color:red"></span>Nombre</label>
              <input type="text" class="form-control" id="nombre" required>
            </div>
            <div class="form-group">
              <label for="descripcion" class="control-label">Descripcion</label>
              <textarea class="form-control" id="descripcion"></textarea>
            </div>
            <div class="form-group">
              <label for="nombre-ingles" class="control-label">Nombre Ingles</label>
              <input type="text" class="form-control" id="nombre-ingles">
            </div>
            <div class="form-group">
              <label for="descripcion-ingles" class="control-label">Descripcion Ingles</label>
              <textarea class="form-control" id="descripcion-ingles"></textarea>
            </div>
            <div class="form-group">
              <label class="control-label" for="Categoria">Categoria</label>
              <select class="form-control" id="categoria" name="categoria" onfocus="detectionFocus(0)">
              <?php $categoria = $con->query("SELECT categoria_id,nombre FROM categorias");
              foreach ($categoria as $row) {?>
              <option value="<?=$row[0]?>"><?=$row[1]?></option>
              <?php } ?>
            </select>
            </div>
            <div class="form-group">
              <label class="control-label" for="Categoria">Accesorios</label>
              <select class="form-control" id="accesorio" name="accesorios" onfocus="detectionFocus(1)">
              <?php $accesorios = $con->query("SELECT accesorios_id,nombre FROM accesorios");
              foreach ($accesorios as $row) {?>
              <option value="<?=$row[0]?>"><?=$row[1]?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label" for="Categoria">Estacion</label>
              <select class="form-control" id="estacion" name="estacion" onfocus="detectionFocus(0)">
              <?php $estacion = $con->query("SELECT estacion_id,nombre FROM estacion");
              foreach ($estacion as $row) {?>
              <option value="<?=$row[0]?>"><?=$row[1]?></option>
              <?php } ?>
            </select>
            </div>
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="reset" onclick="desblock(true)">Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary modificar">Aceptar</button>
        </div>
      </div>
      </div>
    </div>
    <!-- FIN MODIFICAR IMAGENES -->

    

    <!-- comienzo bloqueo campos -->
    <script type="text/javascript">
      function detectionFocus(valor) {
        if (valor == 0) {
          document.getElementById('accesorio').disabled = true;
        } else if (valor == 1) {
          document.getElementById('estacion').disabled = true;
          document.getElementById('categoria').disabled = true;
        }
      }

      function desblock(values) {
        if (values) {
          document.getElementById('estacion').disabled = false;
          document.getElementById('categoria').disabled = false;
          document.getElementById('accesorio').disabled = false;
        }
      }
    </script>
    <!-- fin bloqueo campos -->
    <script src="/panel/js/jquery.js"></script>
    <script src="/panel/js/jquery.scrollTo.min.js"></script>
    <script src="/panel/js/jquery.dcjqaccordion.2.7.js" class="include" type="text/javascript" ></script>
    <!---hacer el menu desplegable y decorarlo-->
    <script src="/panel/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--script para toda la pagina-->
    <script src="/panel/js/bootstrap.min.js"></script>
    <script src="/panel/js/common-scripts.js"></script>
    <script src="/panel/js/ui/eliminarYmodificarImg.js"> type="text/javascript"</script>
  </body>
  </html>
