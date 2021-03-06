<?php
include_once ('inc/contact.php');
include_once ('inc/config_conexion_db.php');

if(!empty($_POST)) {
  $sendMail = new contact($con);
  $sendMail->exist($_POST);
}
?>
    <!DOCTYPE HTML>
    <html lang="es">
    <head>
        <title>Tribu Cueros</title>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Local de Carteras en Buenos Aires Argentina.Capital Federal(Avenidad Corrientes). Carteras, accesorios, zapatos,cinturones, camperas, productos de mujer. Nosotros trabajamos con la calidad del cuero">
        <meta name="keywords" content="tribu cueros,carteras de cuero,fabrica de cinturones de cuero en buenos aires,carteras y zapatos de cuero,fabrica de cinturones,fabrica de carteras de cuero,fabrica de cinturones de cuero,uru recoleta,une tribu,leather wallet,carteras de cuero de vaca con pelo,fabrica de camperas de cuero,fabrica de carteras de cuero por mayor,shop.php?id=,fabrica de cueros,carteras gamuza,apolo,carteras cuero,fabricas de carteras de cuero,carteras de cueros,imágenes de carteras de cuero,shopping.php?id=,carteras de gamuza con flecos,carteras cuero argentina,casual bag,alfombras de cuero,tribu,portacelulares de cuero,carteritas de cuero,la tribu,shop.php?iid=,botas de cuero,ropa tribu,tribu ropa,cartera de cuero de vaca,carteras con flecos de cuero,botas de piel de jirafa
        ,alfombras de cuero de vaca,tribus,imagenes de carteras de cuero,fabricas de carteras,imagenes de cuero de animales,cuero de abritilla,carteras de gamuza,carteras de cuero argentina,carteras de cuero de vaca,carteras de cuero artesanales,fabrica de carteras,imagenes de cinturones de cuero,cinturones de cuero,fotos de carteras de cuero,zapatos de cuero de vaca">
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="shortcut icon" href="favicon.png" type="image/png" />
    </head>
    <body class="homepage">
        <div id="page-wrapper">
            <!-- Header -->
            <div id="header" class="responsive-image">
                <!-- Inner -->

                <div class="inner2">
                    <header>
                        <h1><a href="index.php" id="logo">TRIBU CUEROS</a></h1>
                        <style type="text/css" media="screen, print">
                            @font-face {
                                font-family: "Lumpy";
                                src: url("assets/fonts/Lumpy.TTF");
                            }

                            #angie {
                                font-family: "Lumpy";
                            }

                        </style>
                        <p id="angie">by Angie Rodriguez</p>
                        <hr />
                    </header>
                    <footer>
                        <a href="#carousel" class="button circled scrolly">Start</a>
                    </footer>
                </div>

                <!-- Nav -->
                <?php include('inc/menu.php');?>
            </div>

            <!-- Carousel -->
            <section class="carousel" id="carousel">
                <div class="reel">
                    <?php $sql = 'SELECT * FROM productos WHERE 1=1 order by producto_id desc';
                      $producto = $con->query($sql);
                      foreach ($producto as $rows) {
                        $path = '/images/articulos/'.$rows['producto_id'];
                        $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
                        if(is_dir($carpeta)){
                          if($dir = opendir($carpeta)){
                            while(($archivo = readdir($dir)) !== false){
                              if($archivo != '.' && $archivo != '..' && stristr($archivo,'_small') !== false){ ?>
                    <article>
                        <a href="detalles?id=<?=$rows['producto_id']?>" class="image1 featured">
                          <img src="/images/articulos/<?=$rows['producto_id']?>/<?=$archivo?>" alt="" class="grow"/></a>
                    </article>
                    <?php  }
                              }
                            }
                          }
                        } ?>
                </div>
            </section>

              <!-- Main -->
            <div class="callout opacity">
                <div class="fondoTransparente">
                    <article id="main" class="container special">
                        <header>
                            <p>
                                <strong>Diseño Argentino de calidad Internacional, Tribu cueros By Angie Rodriguez, representa un
segmento de productos que logaron otorgarle protagonismo a las carteras y accesorios.
                                </strong>
                            </p>
                        </header>
                        <p>
                            <strong>La moda en accesorios de cuero es cambiante y caprichosa como la juventud, mestiza como un
mundo sin fronteras, efectista como un juego de luces. Por eso, que la mejor manera de captar su
esencia que a través de esos detalles que nos seducen en la calle y cualquier lugar donde se
quieran lucir y que dicen más por si solo que una imagen general distorsionada.</strong>
                        </p>
                        <p>
                            <strong>Cada colección posee su propio poder conceptual, el cual pondera la sofisticación, definiendo un
estilo moderno, vanguardista y elegante. Cada cartera en su interior cuenta con bolsillo con
cremallera y un practico porta celular. El alto estándar de calidad de las materias primas y diseños
han hecho que la marca actualmente se encuentre posicionada dentro de un segmento exclusivo y
de alcance internacional.</strong>
                        </p>
                    </article>
                </div>
            </div>
            <!-- SLIDER 2 -->
            <div class="wrapper style1">
                <div class="gallery style2 medium lightbox onscroll-fade-in image2">
                    <?php
                $imgSlider = $con->query("SELECT imgIndex_id from imgindex ORDER BY imgIndex_id ASC");
                foreach ($imgSlider as $rows) { ?>
                        <a href="/images/img/<?=$rows[0]?>/img_0_big.jpg">
                      <img src="/images/img/<?=$rows[0]?>/img_0_small.jpg" alt="" />
                    </a>
                        <?php } ?>
                </div>
            </div>
            <!-- FIN DE SLIDER 2 -->
            <!-- Footer -->
            <div id="footer">
                <div class="container">

                    <div class="row 150%" id="formContact">
                        <div class="6u 12u(mobile)">
                            <!-- Contact Form -->
                            <section>
                                <form method="post" action="#">
                                    <div class="row 50%">
                                        <div class="6u 12u(mobile)">
                                            <input type="text" name="name" id="contact-name" placeholder="Nombre" />
                                        </div>
                                        <div class="6u 12u(mobile)">
                                            <input type="text" name="email" id="contact-email" placeholder="E-mail" />
                                        </div>
                                    </div>
                                    <div class="row 50%">
                                        <div class="6u 12u(mobile)">
                                            <input type="text" name="phone" id="contact-phone" placeholder="Teléfono" required/>
                                        </div>
                                        <div class="6u 12u(mobile)">
                                            <input type="text" name="country" id="contact-country" placeholder="País-Provincia" />
                                        </div>
                                    </div>
                                    <div class="row 50%">
                                        <div class="6u 12u(mobile)">
                                            <select name="options" id="options">
                                                <option value="0"> Como nos conoció ?</option>
                                                <option value="Other">Otros</option>
                                                <option value="Google">Google</option>
                                                <option value="Google">Yahoo</option>
                                                <option value="Google">Un amigo </option>
                                                <option value="Google">Hoja Informativa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row 50%">
                                        <div class="12u">
                                            <textarea name="message" id="contact-message" placeholder="Mensaje" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="12u">
                                            <ul class="actions">
                                                <li><input type="submit" class="style1" value="Enviar" /></li>
                                                <li><input type="reset" class="style1" value="Borrar" /></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                        <div class="6u 12u(mobile)">

                            <!-- Contact -->
                            <section class="feature-list small">
                                <div class="row">
                                    <div class="6u 12u(mobile)">
                                        <section>
                                            <h3 class="icon fa-envelope">Correo</h3>
                                            <p>info@tribucueros.com.ar</p>
                                        </section>
                                    </div>
                                    <div class="6u 12u(mobile)">
                                        <section>
                                            <h3 class="icon fa-phone">Teléfono</h3>
                                            <p><span id="colorPhone">WhatSapp</span></p>
                                            <p>(+54) 011-15-60452938</p>
                                            <p><span id="colorPhone">ShowRoom</span></p>
                                            <p>(+54) 011-4953-8621</p>
                                        </section>
                                    </div>
                                    <div class="6u 12u(mobile)">
                                        <section>
                                            <h3 class="icon fa-comment">Información</h3>
                                            <p>Concertar cita previa</p>
                                            <p><span id="colorPhone">Dirección</span></p>
                                            <p>Av. Corrientes 1965 Piso 4L. CABA</p>
                                        </section>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <hr>

                    <!-- Contact -->
                    <?php include('inc/sectionContact.php');?>

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
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/main.js"></script>

        <!-- Script de la galery nueva -->
        <script src="assets/js/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/js/main.js"></script>
        <script src="assets/js/js/skel.min.js"></script>
        <script src="assets/js/js/util.js"></script>

    </body>
    </html>
