<?php 
include_once 'funciones/conexion-bd.php'; //conexion
include_once 'funciones/seguridad.php'; //conexion
error_reporting(0);
$nombre =  filtrado($_POST['nombre']);
$descripcion = filtrado($_POST['descripcion']);


if($_POST['registro'] == 'nuevo'){   

    try {
        if(!empty($nombre) && !empty($descripcion) ){
            //realizo la inserciona a la bd
            $stmt = $conn->prepare("INSERT INTO  categorias (nombre, descripcionCat, editado) VALUES (?, ?, NOW() ) ");
            $stmt->bind_param("ss", $nombre, $descripcion  );
            $stmt->execute();
            $id_insertado = $stmt->insert_id;
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'correcto'
                );
        } else{
            $respuesta = array(
                'respuesta' => 'error'
            ); 
        }
        $stmt->close();
        $conn->close();
        } else{
            $respuesta = array(
                'respuesta' => 'vacio'
            );  
        }
} catch (Exception $e) {
    $respuesta = array(
        'respuesta' => 'error'
    ); 
}
    die(json_encode($respuesta));    
}

if($_POST['registro'] == 'actualizar') {
    $id_registro = $_POST['id_registro'];
    try {
        if(!empty($nombre) && !empty($descripcion)){
        //realizamos la actualizacion a la BD
        $stmt = $conn->prepare(" UPDATE categorias SET nombre = ?, descripcionCat = ?, editado = NOW() WHERE idcategoria = ? ");
        $stmt->bind_param("ssi", $nombre, $descripcion, $id_registro);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                "respuesta" => "correcto"
            );
        } else{
            $respuesta = array(
                "respuesta" => "error"
            );
        }
    } else{
        $respuesta = array(
            "respuesta" => "vacio"
        );
    }
    $stmt->close();
    $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => 'error'
        );
    }
    die(json_encode($respuesta));

}

if($_POST['registro'] == 'eliminar'){

   $id_borrar = $_POST['id']; //este id se lo pasa ajax en data : 'id'

    try{
        //SQL PARA ELIMINAR
        $stmt = $conn->prepare(" DELETE FROM categorias WHERE idcategoria = ? ");
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