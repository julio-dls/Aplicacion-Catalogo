<?php

class dataPanel {
    private $con;

    public function __construct($con) {
      $this->con = $con;
    }

    function InsertarProcuto($data = array(),$fImg = array()) {
      if (!empty($data['categoria'])) {
        $categ = $this->con->query("SELECT categoria_id FROM CATEGORIAS WHERE NOMBRE = '".$data['categoria']."' ")->fetch();
        echo $categ;
      } else {
        $categ['categoria_id'] = 0;
      }
      if (!empty($data['estacion'])) {
        $est = $this->con->query('SELECT estacion_id FROM ESTACION WHERE NOMBRE = "'.$data['estacion'].'" ')->fetch();
      } else {
        $est['estacion_id'] = 0;
      }
      if (!empty($data['accesorios'])) {
        $acces = $this->con->query('SELECT accesorios_id FROM ACCESORIOS WHERE NOMBRE = "'.$data['accesorios'].'" ')->fetch();
      } else {
        $acces['accesorios_id'] = 0;
      }

      if (!empty($data['articulos']) && !empty($data['descripcion']) ) {        //LOS DEMAS DATOS PUEDEN SER NULOS

        $mensajeIng = htmlentities($data['description'], ENT_NOQUOTES | ENT_HTML5, 'UTF-8');
        $mensajeEs = htmlentities($data['descripcion'], ENT_NOQUOTES | ENT_HTML5, 'UTF-8');

        $sql = "INSERT INTO `productos`(`nombre`, `descripcion`, `nombre-ingles`, `descripcion-ingles`, `categoria`, `estacion`, `accesorios`)
        VALUES ('".strtolower($data['articulos'])."','".strtolower($mensajeEs)."','".strtolower($data['namearticle'])."',
        '".strtolower($mensajeIng)."','".$categ['categoria_id']."','".$est['estacion_id']."','".$acces['accesorios_id']."')";
        $transCorrect=$this->con->exec($sql);
        print_r($this->con->errorInfo());
      } else {
        $transCorrect = false;
      }

      if ($transCorrect) {
        $id_prod = $this->con->query('SELECT producto_id FROM PRODUCTOS WHERE NOMBRE= "'.strtolower($data['articulos']).'" ')->fetch();

        if (is_array($fImg['archivosImg'])) {
          if(isset($fImg['archivosImg']['name'])){
            $id_producto = $id_prod['producto_id'];

            foreach($fImg['archivosImg']['name'] as $posicion => $nombre){
              $ruta = '../Ange-Web/images/articulos/'.$id_producto;
              @mkdir($ruta);
              $tamanhos = array('0'=>array('ancho'=>'100','alto'=>'100','nombre'=>'thumb'),
                                '1'=>array('ancho'=>'300','alto'=>'360','nombre'=>'small'),
                                '2'=>array('ancho'=>'1100','alto'=>'1100','nombre'=>'big')
                              );

              redimensionar('../Ange-Web/images/articulos/'.$id_producto.'/',
                            $fImg['archivosImg']['name'][$posicion],
                            $fImg['archivosImg']['tmp_name'][$posicion],
                            $posicion,
                            $tamanhos
                          );
            }
          }
        }
      }
    }
    // CORROBORAR QUE ESTA LOGUEADO
  	function isLog() {
  		if(!isset($_SESSION['usuario']) and !isset($_SESSION['password']) and !isset($_SESSION['privilegios'])) {
  			redirect('login.php');
  		}
  	}

    function deleteimg($data = array()) {
      $del = "DELETE FROM `productos` WHERE producto_id = '".$data['id']."' ";
      $delImg=$this->con->exec($del);
    }

    function modificarImg($data = array()){
      if (!empty($data['id']) and !empty($data['nombre'])) {
        $sql = "UPDATE productos SET" ;
        if (!empty($data['nombre'])) {
          $sql .= " nombre= '".$data['nombre']."' ";
        }
        if (!empty($data['descripcion'])) {
          $sql .= ", descripcion='".$data['descripcion']."' ";
        }
        if (!empty($data['nombreIngles'])) {
          $sql .= ", `nombre-ingles`='".$data['nombreIngles']."' ";
        }
        if (!empty($data['descripcionIngles'])) {
          $sql .= ", `descripcion-ingles`='".$data['descripcionIngles']."' ";
        }
        if (!empty($data['categoria']) or !empty($data['estacion']) or !empty($data['accesorio'])) {
          if (!empty($data['categoria']) and !empty($data['estacion'])) {
            $sql .= ", categoria='".$data['categoria']."' ";
            $sql .= ", estacion='".$data['estacion']."' ";
            $sql .= ", accesorios=0 ";
          }
          if (!empty($data['accesorio'])) {
            $sql .= ", accesorios='".$data['accesorio']."' ";
            $sql .= ", categoria=0 ";
            $sql .= ", estacion=0 ";
          }
        }
        $sql .= " WHERE producto_id=" .$data['id'];
        // echo "sql: " .$sql;
        $this->con->exec($sql);
      }
    }

    function exterminarusers($data = array()) {
      $del = "DELETE FROM `usuarios` WHERE id = '".$data['deleteusers']."' ";
      $delImg=$this->con->exec($del);
      if ($delImg) {
        redirect('deleteusers.php?flag=visible');
      }
    }
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

//redimencionar imagen
function redimensionar($ruta,$file_name,$file_temp,$id,$tamanhos){
  $filename = stripslashes($file_name);
 	$extension = getExtension($filename);
 	$extension = strtolower($extension);

  if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
 		$errors=1;
 	}else{
		$size=filesize($file_temp);
		if ($size > 2*1024){
			$change='<div class="msgdiv">You have exceeded the size limit!</div> ';
			$errors=1;
		}
		if($extension=="jpg" || $extension=="jpeg" ){
			$uploadedfile = $file_temp;
			$src = imagecreatefromjpeg($uploadedfile);
		}else if($extension=="png"){
			$uploadedfile = $file_temp;
			$src = imagecreatefrompng($uploadedfile);
			imagealphablending($src, true);
			imagesavealpha($src, true);
		}else{
			$src = imagecreatefromgif($uploadedfile);
		}
    //echo "".$src;
		list($width,$height)=getimagesize($uploadedfile);
		foreach($tamanhos as $tam){
			$newwidth = $tam['ancho'];
      $newheight=($height/$width)*$newwidth;
			if($newheight > $tam['alto']){
				$newheight = $tam['alto'];
				$newwidth=($width/$height)*$newheight;
				if($newwidth > $tam['ancho']){
					$height = $newheight;
					$width = $newwidth;
					$newheight=($height/$width)*$newwidth;
				}
			}
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			if($extension == "png"){
				$rojo = imagecolorallocate($tmp, 234, 234, 234);
				imagefill($tmp, 0, 0, $rojo);
			}
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			$filename = $ruta.'img_'.$id.'_'.$tam['nombre'].'.'.$extension;
			if($extension == "png"){
				$negro = imagecolorallocate($tmp, 234, 234, 234);
				imagecolortransparent($tmp,$negro);
				imagepng($tmp,$filename,9);
			}elseif($extension == 'gif'){
				imagegif($tmp,$filename,100);
			}else{
				imagejpeg($tmp,$filename,100);
			}
			imagedestroy($tmp);
		}
		imagedestroy($src);
	}
}
//funcion para obtener la extension
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
?>
