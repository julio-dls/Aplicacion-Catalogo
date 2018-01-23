<?php
include 'inc/config_conexion_db.php';

if (!isset($_GET['id']) && empty($_GET['id'])) {
  redirect('galery.php');
}
//funcion para cambiar de pagina
function redirect($pURL) {
  if (strlen($pURL) > 0)	{
    if (headers_sent())	{
      echo "<script>document.location.href='".$pURL."';</script>\n";
    } else {
      header("Location: " . $pURL);
    }
    exit();
  }
}
?>
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
    <style>
        #gal1 img {
            border: 2px solid white;
            padding: 20px 0 0 20px;
        }
        .active img {
            border: 2px solid #333 !important;
        }
    </style>
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
        <!--COMIENZO DETALLE-->
        <div class="wrapper style1">
            <div class="row">
                <div class="2u">
                    <!-- ESPACIO PARA MANTENER EL DETALLE SIEMPRE CENTRADO -->
                </div>
                <div class=" 4u 12u(mobile) centrar-detalle">
                    <!-- DIV CONTENEDOR IMG DETALLE-->
                    <?php
                    if (!empty($_GET['id'])) {
                      $sql = 'SELECT * FROM productos WHERE producto_id="'.$_GET['id'].'" LIMIT 1';
                      $producto = $con->query($sql);
                        if (!empty($producto)) {
                          foreach ($producto as $rows) { ?>
                            <figure>
                              <img class="6u 6u(mobile)" id="zoom_01" src="/images/articulos/<?=$rows['producto_id']?>/img_0_small.jpg"
                                    data-zoom-image="/images/articulos/<?=$rows['producto_id']?>/img_0_big.jpg" />
                            </figure>
                    <?php  }
                        }
                    } ?>
                    <!-- COMIENZO IMAGENES thumb PARA DETALLE -->
                    <div id="gal1">
                        <div class="img-thumb-detaills">
                            <?php
                            $sql = 'SELECT * FROM productos WHERE producto_id="'.$_GET['id'].'" LIMIT 1';
                            $producto = $con->query($sql);
                              if(!empty($producto)) {
                                foreach ($producto as $rows) {
                                    $path = 'images/articulos/'.$rows['producto_id'];
                                    $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
                                    if($dir = opendir($carpeta)) {
                                      while ($archivo = readdir($dir)) { 
                                        if($archivo != '.' and $archivo != '..' and stristr($archivo,'big') !== false) { ?>
                                          <a href="#" data-image="/images/articulos/<?=$rows['producto_id']?>/<?=$archivo?>" 
                                          data-zoom-image="/images/articulos/<?=$rows['producto_id']?>/<?=$archivo?>">
                                          <?php 
                                        /*} else if( $archivo != '.' and $archivo != '..' and stristr($archivo,'thumb') !== false) { */?>
                                            <img id="zoom_01" src="/images/articulos/<?=$rows['producto_id']?>/<?=str_replace('big','thumb',$archivo)?>" />
                                          </a>
                                          <header></header>
                                          <p></p>
                                  <?php }
                                       }
                                    }
                                      closedir($dir);
                                }
                              } ?>
                        </div>
                    </div>
                </div>

                <div class="4u 12u(mobile) centrar-detalle">
                    <header id="descripcion-detalle">
                        <h3>
                            <a id="estilo-detalle" href="#">
                                <?=strtoupper($rows['nombre'])?>
                            </a>
                        </h3>
                    </header>
                    <p id="parrafo-detalle">
                        <?=ucfirst($rows['descripcion'])?>
                    </p>
                </div>
            </div>
        </div>
        <!--FIN DE DETALLE-->
        <!--COMIENZO TAMBIEN PODRIA GUSTAR-->
        <div class="container">
            <article class="12u(mobile) special">
                <header>
                    <h3 id="colorPhone">También le prodía gustar</h3>
                </header>
            </article>
            <div class="row" id="centrar">
            <?php
            $idProducto = $rows['producto_id'];
            $sql = "SELECT producto_id FROM productos";
            $result = $con->query($sql);
            $count = 0;
            $max = 3;
            $contador= 0;
            $valores = array();

            foreach ($result as $rows){
                $valores[$contador] = $rows['producto_id'];
                $contador++;
            }

            shuffle($valores);

            for($i=0; $i < count($valores); $i++){
                if($valores[$i] != $idProducto){
                    $count++;
                    $path = 'images/articulos/'.$valores[$i];
                    $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
                   if(is_dir($carpeta)){
                    if($dir = opendir($carpeta)){
                      while(($archivo = readdir($dir)) !== false){
                        if($archivo != '.' && $archivo != '..' && stristr($archivo,'0_small') !== false){ ?>
                            <article class="4u 12u(mobile) special">
                                <a href="detalles?id=<?=$valores[$i]?>" class="image1 featured">
                                <img src="/images/articulos/<?=$valores[$i]?>/<?=$archivo?>" alt="" /></a>
                            </article>
                     <?php }
                      }
                    }
                   }
                }
                if($count == 3) {
                  break;
                }
            } ?>
            </div>
        </div>
        <!--FIN TAMBIEN PODRIA GUSTAR-->
    </div>
    <!--FIN MAIN-->
    <!-- FOOTER -->
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
    <!-- FIN DE FOOTER -->
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.onvisible.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>
    <!-- Script ELEvate -->
    <script src='assets/js/jquery.elevateZoom-3.0.8.min.js'></script>

    <script>
        //initiate the plugin and pass the id of the div containing gallery images
        $('#zoom_01').elevateZoom({
            gallery: 'gal1'
        });
        //pass the images to Fancybox
        $("#zoom_01").bind("click", function(e) {
            var ez = $('#zoom_01').data('elevateZoom');
            $.fancybox(ez.getGalleryList());
            return false;
        });
    </script>
</body>

</html>
