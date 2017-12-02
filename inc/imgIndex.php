<?php
include_once ('dataPanel.php');

class imgIndex extends dataPanel {
  private $con;

  function __construct($con) {
    $this->con=$con;

  }

  function nuevaImgIndex($data = array(),$imgIn = array()){
      $count = $this->con->query("SELECT imgindex_id FROM imgindex  WHERE imgindex_id = '".$data['id-oculto']."' ")->fetch();
      $i = $count['imgindex_id'];

      foreach ($imgIn['imgPortada']['name'] as $posicion => $value) {

        $ruta = '../Ange-Web/images/img/'.$i;
        @mkdir($ruta);

        $tamanhos = array('1'=>array('ancho'=>'380','alto'=>'480','nombre'=>'small'),
                          '2'=>array('ancho'=>'2000','alto'=>'800','nombre'=>'big'),
                          '3'=>array('ancho'=>'100','alto'=>'100','nombre'=>'thumb')
                        );

        redimensionar('../Ange-Web/images/img/'.$i.'/',
                      $imgIn['imgPortada']['name'][$posicion],
                      $imgIn['imgPortada']['tmp_name'][$posicion],
                      $posicion,
                      $tamanhos
                    );
      }
    }
 }

?>
