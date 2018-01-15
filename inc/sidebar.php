<div id="sidebar" class="nav-collapse">
  <!-- sidebar menu start-->
  <ul class="sidebar-menu" id="nav-accordion">
      <h5 class="centered">ADMINISTRADOR: <?php echo $_SESSION['usuario'];?>
      </h5>
      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-cogs"></i>
          <span>Pagina Principal</span>
        </a>
        <ul class="sub">
            <li><a href="imgIndexPanel.php">Actualizar Imagenes</a></li>
        </ul>
      </li>
      <li class="sub-menu">
        <a href="javascript:;"><span class="glyphicon glyphicon-user" aria-hidden="true" > Administrar Usuarios</span></a>
        <ul class="sub">
            <li><a href="login.php">Login</a></li>
            <li>
              <?php if ($_SESSION['privilegios'] = '777'): ?>
                <a href="register.php">Crear Nuevo Usaurio</a>
              <?php endif; ?>
            </li>
            <li><a href="deleteusers.php">Eliminar o Modificar</a></li>
        </ul>
      </li>
      <li class="sub-menu">
        <a class="active" href="javascript:;">
            <i class="fa fa-tasks"></i>
            <span>Galeria</span>
        </a>
        <ul class="sub">
            <li class="active"><a href="panel.php?#form-panel">Agregar Imagen Nueva</a></li>
        </ul>
        <ul class="sub">
            <li class="active"><a href="delete.php">Eliminar Imagenes</a></li>
        </ul>
      </li>
  </ul>
</div>
