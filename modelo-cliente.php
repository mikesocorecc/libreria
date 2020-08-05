<?php 
include_once 'funciones/conexion-bd.php'; //conexion
include_once 'funciones/seguridad.php'; //conexion
error_reporting(0);
$nombre =  filtrado($_POST['nombre']);
$apellido =  filtrado($_POST['apellido']);
$nit = filtrado($_POST['nit']);
$direccion = filtrado($_POST['direccion']);
$telefono = filtrado($_POST['telefono']);
$email = filtrado($_POST['email']);


if($_POST['registro'] == 'nuevo'){   
    try {
       
        //realizo la inserciona a la bd
        $stmt = $conn->prepare("INSERT INTO clientes (nombre, apellido, nit, direccion, telefono, email) VALUES (?, ?, ?, ?, ?, ? ) " );
        $stmt->bind_param("ssssss", $nombre, $apellido, $nit, $direccion, $telefono, $email);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows){
            $respuesta = array(
                'respuesta' => 'correcto',  
                "error" => $stmt

            );
    } else{
        $respuesta = array(
            'respuesta' => 'error'
        ); 
    }
    $stmt->close();
    $conn->close();


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
 
        //realizamos la actualizacion a la BD
        $stmt = $conn->prepare(" UPDATE clientes SET nombre = ?, apellido = ?, nit = ?, direccion = ?, telefono = ?, email = ?,  editado = NOW() WHERE idcliente = ? ");
        $stmt->bind_param("ssssssi", $nombre, $apellido, $nit, $direccion, $telefono, $email, $id_registro);
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
        $stmt = $conn->prepare(" DELETE FROM clientes WHERE idcliente = ? ");
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