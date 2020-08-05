<?php 
include_once 'funciones/conexion-bd.php'; //conexion
include_once 'funciones/seguridad.php'; //conexion
error_reporting(0);
$nombre =  filtrado($_POST['nombre']);
$descripcion = filtrado($_POST['descripcion']);
$categoria = $_POST['cat_producto'];
$precio = filtrado($_POST['precio']);



if($_POST['registro'] == 'nuevo'){   
    /* Le tengo que otorgar permisos a la carpeta para que pueda crear una carpeta, para eso habro un terminal
    en el padre de carpeta donde la quiero crear y le le otorgo esos permisos:  chmod -R 777 img 
    Solo es para ubuntuu, y para ver los permisos de la carpeta ejecuto en el terminal ls -al
     */
    //creo el directorio si no existe
    $directorio = "img/productos/";
    if(!file_exists($directorio)){
        mkdir($directorio, 0777, true);   
    }
    if(move_uploaded_file($_FILES['imagen_producto']['tmp_name'], $directorio.$_FILES['imagen_producto']['name'])){
        $imagen_url = $_FILES['imagen_producto']['name'];
        $imagen_resultado = "Se subio correctamente";
       
    } else{
        $respuesta = array(
            "respuesta" => error_get_last()
        );
    }  
    try {
        $stmt  = $conn->prepare("INSERT INTO productos (nombreProducto, descripcion, idCategoria, precioActual, imagenProd ) VALUES (?, ?, ?, ?, ? ) ");
        $stmt->bind_param("ssiis", $nombre, $descripcion, $categoria, $precio, $imagen_url);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows){
            $respuesta = array(
                "respuesta" => "correcto",
                'resultado_imagen' => $imagen_resultado
            );
        } else{
            $respuesta = array(
                "respuesta" => "error",
                
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array (
            "respuesta" => "error"
        );
    }
    die(json_encode($respuesta));
}

if($_POST['registro'] == 'actualizar') {

    //creo el directorio
  $directorio = "img/productos/";
//guardo el id de registro
  $id_registro = $_POST['id_registro'];
    //compruebo si la direccion existe
  if(!is_dir($directorio)){
    mkdir($directorio, 0777, true);
  }

  //muevo el archivo de la ruta temporal al directorio creado
  if(move_uploaded_file($_FILES['imagen_producto']['tmp_name'], $directorio . $_FILES['imagen_producto']['name'])){
    $imagen_url = $_FILES['imagen_producto']['name'];
    $imagen_resultado = "Se subio correctamente";

  } else{
      $respuesta = array(
          "respuesta" => error_get_last()
      );
  }

  try {

      //comprobamos si envia imagen
      if($_FILES['imagen_producto']['size'] > 0){
          $stmt = $conn->prepare(" UPDATE productos SET nombreProducto = ?, descripcion = ?, idCategoria = ?, precioActual = ?, imagenProd = ?, editado = NOW() WHERE idproducto = ? ");
          $stmt->bind_param("ssiisi", $nombre, $descripcion, $categoria, $precio, $imagen_url, $id_registro );          
   
      } else{
        $stmt = $conn->prepare("UPDATE productos SET nombreProducto = ?, descripcion = ?, idCategoria = ?, precioActual = ?, editado = NOW() WHERE idproducto = ? ");
        $stmt->bind_param("ssiii", $nombre, $descripcion, $categoria, $precio, $id_registro );          
      }
        $stmt->execute();
      /* Validamos si se arealizo algun cambio */
      if($stmt->affected_rows){
          $respuesta = array(
              "respuesta" => "correcto",
              "id_actualizado" => $id_registro
          );
      } else{
        $respuesta = array(
            "respuesta" => "error"
        );
      }
      $stmt->close();
      $conn->close();
  } catch (Exception $e) {
      $respuesta = array(
          "respuesta" => "error",
          "causa" => $e->getMessage()
      );
  }
die(json_encode($respuesta));
}

if($_POST['registro'] == 'eliminar'){
   $id_borrar = $_POST['id']; //este id se lo pasa ajax en data : 'id'

    try{
        //SQL PARA ELIMINAR
        $stmt = $conn->prepare(" DELETE FROM productos WHERE idproducto = ? ");
        $stmt->bind_param("i", $id_borrar );
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_eliminado' => $id_borrar
            );   
        } else{
            $respuesta = array(
                'respuesta' => 'error',
            );
        }
        $stmt->close();
        $conn->close();
    } catch(Exception $e){
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }


 die(json_encode($respuesta));

}  