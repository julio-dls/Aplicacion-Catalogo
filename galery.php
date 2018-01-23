<?php include 'inc/config_conexion_db.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Tribu Cueros</title>
  <meta charset="utf-8" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Local de Carteras en Buenos Aires Argentina.Capital Federal(Avenidad Corrientes). Carteras, accesorios, zapatos,cinturones, camperas, productos de mujer. Nosotros trabajamos con la calidad del cuero">
        <meta name="keywords" content="tribu cueros,carteras de cuero,fabrica de cinturones de cuero en buenos aires,carteras y zapatos de cuero,fabrica de cinturones,fabrica de carteras de cuero,fabrica de cinturones de cuero,uru recoleta,une tribu,leather wallet,carteras de cuero de vaca con pelo,fabrica de camperas de cuero,fabrica de carteras de cuero por mayor,shop.php?id=,fabrica de cueros,carteras gamuza,apolo,carteras cuero,fabricas de carteras de cuero,carteras de cueros,imágenes de carteras de cuero,shopping.php?id=,carteras de gamuza con flecos,carteras cuero argentina,casual bag,alfombras de cuero,tribu,portacelulares de cuero,carteritas de cuero,la tribu,shop.php?iid=,botas de cuero,ropa tribu,tribu ropa,cartera de cuero de vaca,carteras con flecos de cuero,botas de piel de jirafa
        ,alfombras de cuero de vaca,tribus,imagenes de carteras de cuero,fabricas de carteras,imagenes de cuero de animales,cuero de abritilla,carteras de gamuza,carteras de cuero argentina,carteras de cuero de vaca,carteras de cuero artesanales,fabrica de carteras,imagenes de cinturones de cuero,cinturones de cuero,fotos de carteras de cuero,zapatos de cuero de vaca">

  <link rel="shortcut icon" href="favicon.png" type="image/png" />
  <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="right-sidebar">
  <div id="page-wrapper">
    <!-- Header -->
    <div id="header2">
      <!-- Inner -->
      <?php include('inc/lumpy.php');?>

      <!-- Nav -->
      <?php include('inc/menu.php');?>
  </div>
    <!-- Gallery -->
    <div class="wrapper style1">
      <section id="features" class="container special">
        <div>
          <?php
          if(isset($_GET['est'])){
            $sqlCat = ("SELECT nombre FROM estacion where estacion_id = '".$_GET['est']."' ");
            $nameGaleria = $con->query($sqlCat)->fetch();
            $catGalery[0] = $nameGaleria[0];
          }
          if(isset($_GET['cat'])){
            $sqlCat = ("SELECT nombre FROM categorias where categoria_id = '".$_GET['cat']."' ");
            $nameGaleria = $con->query($sqlCat)->fetch();
            $catGalery[1] = $nameGaleria[0];
          }
          if(isset($_GET['acces'])){
            $sqlCat = ("SELECT nombre FROM accesorios where accesorios_id = '".$_GET['acces']."' ");
            $nameGaleria = $con->query($sqlCat)->fetch();
            $catGalery[3] = $nameGaleria[0];
          }
          if (!empty($catGalery)) {
            $nameGaleria = implode(" - ",$catGalery);                           //Devuelve un string que contiene la representación de todos los elementos del array en el mismo orden, con el string 'glue' entre cada elemento.
            //$nameGaleria =   utf8_encode($nameGaleria);                       //Ésta función codifica el string data a UTF-8, y devuelve una versión codificada. UTF-8 es un mecanismo estándar
          ?>
          <h1 id="nameGaleria"><?=ucwords($nameGaleria)?></h1>
          <?php } else { ?>
                    <h1 id="nameGaleria">Productos</h1>
          <?php } ?>

        </div>
      <div class="row gallery-container">
        <?php
        $pagina = 0;
        $limite = 9;                                                            //CANTIDAD DE PRODUCTOS POR PAGINA

        if(isset($_GET['page'])){
          $pagina = $_GET['page'];
        }
        $sql = 'SELECT * FROM productos WHERE 1=1 ';
        $cantidadPaginas = 'SELECT count(1) as cant FROM productos WHERE 1=1';
        if(isset($_GET['cat'])){
          $sql .= ' AND categoria = '.$_GET['cat'];
          $cantidadPaginas .= ' AND categoria = '.$_GET['cat'];
        }
        if(isset($_GET['est'])){
          $sql .= ' AND estacion = '.$_GET['est'];
          $cantidadPaginas .= ' AND estacion = '.$_GET['est'];
        }
        if(isset($_GET['acces'])){
          if ($_GET['acces'] == 0) {
            $sql .= ' AND accesorios != '.$_GET['acces'];
            $cantidadPaginas .= ' AND accesorios != '.$_GET['acces'];
          } else {
            $sql .= ' AND accesorios = '.$_GET['acces'];
            $cantidadPaginas .= ' AND accesorios = '.$_GET['acces'];
          }
        }
        // echo $cantidadPaginas;
        $cantidadPaginas = $con->query($cantidadPaginas)->fetch();
        $cantidad =$cantidadPaginas['cant'];

        $sql .= ' ORDER BY 1 DESC LIMIT 9 OFFSET '.($pagina*9);                 //CADENA SQL PARA OBTENER LAS CATEGORIAS Y SUB CATEGORIAS
        /*MOSTRAR LAS IMAGENES EN EL CATALOGO*/
        $producto = $con->query($sql);
        if(!empty($producto)){
        foreach ($producto as $rows) {                                           //RECORRE EL QUERY SQL PARA OBTENER TODOS LOS ID DE LOS PRODUCTOS ARGADOS A LA BASE DE DATOS
          $path = '/images/articulos/'.$rows['producto_id'];
          $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
        //$total_imagenes = count(glob(''.$carpeta.'/{*_thumb.jpg}',GLOB_BRACE)); //OBTENER LA CANTIDDA DEIMAGENES POR CARPETA CON LA EXTENCIO _big.jpg
          if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                while(($archivo = readdir($dir)) !== false) {                     //RECORRE LAS CARPETAS QUE CONTIENE TODAS LAS IMAGENES
                  if($archivo != '.' && $archivo != '..' && stristr($archivo,'0_small') !== false)
                  {?>
                    <article class="4u 12u(mobile) special minimoAlto product-container">
                      <a class="image-container" href="detail.php?id=<?=$rows['producto_id']?>" class="image1 featured">
                        <img src="/images/articulos/<?=$rows['producto_id']?>/<?=$archivo?>" alt="" class="grow"/></a>
                     <div class="rows title-container">
                        <header>
                          <h3><a href="#"><?=strtoupper($rows['nombre'])?></a></h3>
                        </header>
                      </div>
                      </article>

          <?php   }
                }
                closedir($dir);
              }
            }
          }
        }?>
        </div>
        <!--FIN DE ROW -->
        <?php
        $cat = '';
        if(isset($_GET['cat'])){
          $cat .= '&cat='.$_GET['cat'];
        }
        if(isset($_GET['est'])){
          $cat .= '&est='.$_GET['est'];
        }
        if(isset($_GET['acces'])){
          $cat .= '&acces='.$_GET['acces'];
        }?>
        <div class="rows text-center">
            <div class="">
                <ul class="pagination">
                <?php if($pagina != 0){?>
                <li>
                  <a href="?page=0<?=$cat?>">Primero</a>
                  <a href="?page=<?=($pagina-1).$cat?>">&laquo;</a>
                </li>
                <?php }
                for($i=$pagina-5;$i<$pagina+5;$i++){
                  if($i>0 AND $i<=floor($cantidad / $limite)){
                    if($i == $pagina){ ?>
                      <li class="active">
                        <a href="#"><b><?=$i?></b></a>
                      </li>
                <?php } else { /*<?=$i?>*/ ?>
                  <a href="?page=<?=$i.$cat?>"></a> 
                <?php }
                  }
                }
                if($pagina < floor($cantidad / $limite)){ ?>
                  <li>
                    <a href="?page=<?=($pagina+1).$cat?>">&raquo;</a>
                    <a href="?page=<?=(floor($cantidad / $limite)).$cat?>">Ultimo </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
        </div>
      </section>
    </div>
   <!-- Footer -->
        <div id="footer">
            <div class="container">

                <div class="row">
                  <div class="12u">
                      <!-- Contact -->
                      <?php include('inc/sectionContact.php');?>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.onvisible.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>

</body>
</html>

