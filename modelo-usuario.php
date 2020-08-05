<?php 
include_once 'funciones/conexion-bd.php'; //conexion
include_once 'funciones/seguridad.php'; //conexion
error_reporting(0);
$cui = filtrado($_POST['cui']);
$nombre =  filtrado($_POST['nombre']);
$apellido = filtrado($_POST['apellido']);
$direccion = $_POST['direccion'];
$telefono = filtrado($_POST['telefono']);
$email = filtrado($_POST['email']);
$usuario = filtrado($_POST['usuario']);
$password = filtrado($_POST['password']);
$rol = filtrado($_POST['rol']);

if($_POST['registro'] == 'nuevo'){   
    $opciones = array( "cost" => 12 );

    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
    /* Le tengo que otorgar permisos a la carpeta para que pueda crear una carpeta, para eso habro un terminal
    en el padre de carpeta donde la quiero crear y le le otorgo esos permisos:  chmod -R 777 img 
    Solo es para ubuntuu, y para ver los permisos de la carpeta ejecuto en el terminal ls -al
     */
    
    //creo el directorio si no existe
    $directorio = "img/usuarios/";
    if(!file_exists($directorio)){
        mkdir($directorio, 0777, true);   
    }

    if(move_uploaded_file($_FILES['imagen_usuario']['tmp_name'], $directorio.$_FILES['imagen_usuario']['name'])){
        $imagen_url = $_FILES['imagen_usuario']['name'];
        $imagen_resultado = "Se subio correctamente";
       
    } else{
        $respuesta = array(
            "respuesta" => error_get_last()
        );
    }  

    try {
        if($_FILES['size'] > 0){
            $stmt  = $conn->prepare("INSERT INTO usuarios (cui, nombre, apellido, direccion, telefono, email, imagenusuario, usuario, password, idrol  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ) ");
            $stmt->bind_param("ssssissssi", $cui, $nombre, $apellido, $direccion, $telefono, $email, $imagen_url, $usuario, $password_hashed, $rol );
        } else{
            $stmt  = $conn->prepare("INSERT INTO usuarios (cui, nombre, apellido, direccion, telefono, email, usuario, password, idrol  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ) ");
            $stmt->bind_param("ssssisssi", $cui, $nombre, $apellido, $direccion, $telefono, $email, $usuario, $password_hashed, $rol );
        }      
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
  $directorio = "img/usuarios/";
//guardo el id de registro
  $id_registro = $_POST['id_registro'];
    //compruebo si la direccion existe
  if(!is_dir($directorio)){
    mkdir($directorio, 0777, true);
  }

  //muevo el archivo de la ruta temporal al directorio creado
  if(move_uploaded_file($_FILES['imagen_usuario']['tmp_name'], $directorio . $_FILES['imagen_usuario']['name'])){
    $imagen_url = $_FILES['imagen_usuario']['name'];
    $imagen_resultado = "Se subio correctamente";
  } else{
      $respuesta = array(
          "respuesta" => error_get_last()
      );
  }
 
  try {
      //comprobamos si envia imagen
      if($_FILES['imagen_usuario']['size'] > 0 ){
          if(!empty($_POST['password'])){
            $opciones = array(
                "cost" => 12
            );            
            $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare(" UPDATE usuarios SET cui = ?, nombre = ?, apellido = ?, direccion = ?, telefono = ?, email = ?, imagenusuario = ?, usuario = ?, password = ?, idrol = ?, editado = NOW() WHERE idusuario = ? ");
            $stmt->bind_param("ssssissssii", $cui, $nombre, $apellido, $direccion, $telefono, $email, $imagen_url, $usuario, $password_hashed, $rol, $id_registro );            
          } else{
            $stmt = $conn->prepare(" UPDATE usuarios SET cui = ?, nombre = ?, apellido = ?, direccion = ?, telefono = ?, email = ?, imagenusuario = ?, usuario = ?, idrol = ?, editado = NOW() WHERE idusuario = ? ");
            $stmt->bind_param("ssssisssii", $cui, $nombre, $apellido, $direccion, $telefono, $email, $imagen_url, $usuario, $rol, $id_registro );          
          }

      } else{
          if(!empty($_POST['password'])){
            $opciones = array(
                "cost" => 12
            );            
            $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare(" UPDATE usuarios SET cui = ?, nombre = ?, apellido = ?, direccion = ?, telefono = ?, email = ?,  usuario = ?, password = ?, idrol = ?, editado = NOW() WHERE idusuario = ? ");
            $stmt->bind_param("ssssisssii", $cui, $nombre, $apellido, $direccion, $telefono, $email, $usuario, $password_hashed, $rol, $id_registro );  
          } else{
            $stmt = $conn->prepare(" UPDATE usuarios SET cui = ?, nombre = ?, apellido = ?, direccion = ?, telefono = ?, email = ?,  usuario = ?, idrol = ?, editado = NOW() WHERE idusuario = ? ");
            $stmt->bind_param("ssssissii", $cui, $nombre, $apellido, $direccion, $telefono, $email, $usuario, $rol, $id_registro );  
          }
      
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
        $stmt = $conn->prepare(" DELETE FROM usuarios WHERE idusuario = ? ");
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