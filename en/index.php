<?php
include_once ('contact.php');
include_once ('../inc/config_conexion_db.php');

if(!empty($_POST)) {
  $sendMail = new contact($con);
  $sendMail->exist($_POST);
}
$var="portada";
?>
    <!DOCTYPE HTML>
    <html lang="en">

    <head>
       <title>Tribu Cueros</title>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Local leather portfolios of Buenos Aires Argentina.Capital Federal(Avenity Corrientes). Leather wallets, belts, accessories, shoes, camperas, women's products, among others. We work with experience leather">
         <meta name="keywords" content="tribe leathers, leather wallets, leather belts factory in buenos aires, leather wallets and shoes, belts factory, leather wallet factory, leather belts factory, uru recoleta, un tribe, leather wallet, leather wallets of cow with hair, factory of leather jackets, factory of wholesale leather purses, shop.php? id =, factory of leathers, suede wallets, apolo, leather wallets, factories of leather purses, portfolios of leathers, images of leather wallets, shopping.php? id =, suede wallets with fringes, leather wallets argentina, casual bag, leather carpets, tribe, leather cell holders, leather wallets, the tribe, shop.php? iid =, boots leather, tribe clothing, clothing tribe, cowhide wallet, leather fringed wallets, giraffe fur boots, cowhide rugs, tribes, images of leather purses, factories of purses, images of leather of animals, leather of abritilla, suede wallets, wallets of Argentine leather, portfolios of leather of cow, handmade leather wallets, factory of purses, images of leather belts, leather belts, photos of leather purses, cow leather shoes">
        <link rel="stylesheet" href="/assets/css/main.css" />
        <link rel="shortcut icon" href="favicon.png" type="image/png" />
    </head>

    <body class="homepage">
        <div id="page-wrapper">
            <!-- Header -->
            <div id="header">
                <!-- Inner -->
                <div class="inner2">
                    <header>
                        <h1><a href="index.php" id="logo">TRIBU CUEROS</a></h1>
                         <style type="text/css" media="screen, print">
                            @font-face {
                                font-family: "Lumpy";
                                src: url("/assets/fonts/Lumpy.TTF");
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
                <?php include('menu.php');?>
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
                        <a href="details?id=<?=$rows['producto_id']?>" class="image1 featured">
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
                            <p id="colorearparrafo">
                                <strong>
International quality Argentine design Tribu cueros By Angie Rodriguez represent a market
segment, which has reached the handbags and accessories protagonist.</strong>
                            </p>
                        </header>
                        <p id="colorearparrafo">
                            <strong>The leather fashion accessories of this century are changed and capricious like the youth, mestizo
like a World without boundaries, full of effects like a strobe light, that s why the greatest manner
to change its essence is through the details that tempt us on the street and everywhere we want
to wear them, and they express more than words by themselves, more than general distorted
image.</strong>
                        </p>
                        <p id="colorearparrafo">
                            <strong>
Each collection has its conceptual concept, which always praises the sophistication than defines a
modern, avant-garde and elegant stile. Each handbag has an internal zipper pocket and a key ring.
Its commodities high quality just as its designs, stand on an exclusive and international segment.</strong>
                        </p>
                </article>
                </div>
            </div>

            <!-- SLIDER 2 -->
            <div class="wrapper style1">
              <div class="gallery style2 medium lightbox onscroll-fade-in image2">
                <?php
                $imgSlider = $con->query("SELECT imgIndex_id from imgindex");
                foreach ($imgSlider as $rows) { ?>
                  <!-- <article> -->
                    <a href="/images/img/<?=$rows[0]?>/img_0_big.jpg">
                      <img src="/images/img/<?=$rows[0]?>/img_0_small.jpg" alt="" />
                    </a>
                  <!-- </article> -->
                  <?php
                } ?>
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
                                            <input type="text" name="name" id="contact-name" placeholder="Name" />
                                        </div>
                                        <div class="6u 12u(mobile)">
                                            <input type="text" name="email" id="contact-email" placeholder="E-mail" />
                                        </div>
                                    </div>
                                    <div class="row 50%">
                                        <div class="6u 12u(mobile)">
                                            <input type="text" name="phone" id="contact-phone" placeholder="Phone" required/>
                                        </div>
                                        <div class="6u 12u(mobile)">
                                            <input type="text" name="country" id="contact-country" placeholder="Country" />
                                        </div>
                                    </div>
                                    <div class="row 50%">
                                        <div class="6u 12u(mobile)">
                                            <select name="options" id="options">
                                                <option value="0"> ¿How did you know us?</option>
                                                <option value="Other">Other</option>
                                                <option value="Google">Google</option>
                                                <option value="Google">Yahoo</option>
                                                <option value="Google">A friend</option>
                                                <option value="Google">By NewsLetter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row 50%">
                                        <div class="12u">
                                            <textarea name="message" id="contact-message" placeholder="Message" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="12u">
                                            <ul class="actions">
                                                <li><input type="submit" class="style1" value="Submit" /></li>
                                                <li><input type="reset" class="style1" value="Delete" /></li>
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
                                            <h3 class="icon fa-envelope">Mail</h3>
                                            <p>
                                                info@tribucueros.com.ar
                                            </p>
                                        </section>
                                    </div>
                                    <div class="6u 12u(mobile)">
                                        <section>
                                            <h3 class="icon fa-phone">Phone</h3>
                                            <p><span id="colorPhone">
                                                WhatSapp
											                          </span></p>
                                            <p>
                                                (+54) 011-15-60452938
                                            </p>
                                            <p><span id="colorPhone">
                        												ShowRoom
                        										    </span></p>
                                            <p>
                                                (+54) 011-4953-8621
                                            </p>
                                        </section>
                                    </div>
                                     <div class="6u 12u(mobile)">
                                        <section>
                                            <h3 class="icon fa-comment">Information</h3>
                                            <p>
                                                Make an appointment
                                            </p>
											<p><span id="colorPhone">
                        												Address
                        										    </span></p>
                                            <p>
                                                 Av. Corrientes 1965 Floor 4L. CABA
                                            </p>
                                        </section>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <hr>

                    <!-- Contact -->
                    <?php include('sectionContact.php');?>

                </div>
            </div>
        </div>
         <!-- Scripts -->
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/jquery.dropotron.min.js"></script>
        <script src="/assets/js/jquery.scrolly.min.js"></script>
        <script src="/assets/js/jquery.onvisible.min.js"></script>
        <script src="/assets/js/skel.min.js"></script>
        <script src="/assets/js/util.js"></script>
        <script src="/assets/js/jquery.scrollex.min.js"></script>
        <script src="/assets/js/main.js"></script>

        <!-- Script de la galery nueva -->
         <script src="/assets/js/js/jquery.scrollex.min.js"></script>
         <script src="/assets/js/js/jquery.scrolly.min.js"></script>
         <script src="/assets/js/js/main.js"></script>
         <script src="/assets/js/js/skel.min.js"></script>
        <script src="/assets/js/js/util.js"></script>

        <!--  -->
    </body>

    </html>
