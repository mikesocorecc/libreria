<?php 
include_once "funciones/conexion-bd.php";
include_once "funciones/seguridad.php";
error_reporting(0);
//obtengo las datos en variables
$nombreProveedor = filtrado($_POST['nombre']);
$direccion = filtrado($_POST['direccion']);
$telefono = filtrado($_POST['telefono']);
$email = filtrado($_POST['email']);

//nuevo registro
if($_POST['registro'] == 'nuevo'){
    try {
        //realizo la insercion a la bd
        $stmt = $conn->prepare("INSERT INTO proveedores (nombreProv, direccion, telefono, emailProv) VALUES (?, ?, ?, ? ) ");
        $stmt->bind_param("ssis", $nombreProveedor, $direccion, $telefono, $email);
        $stmt->execute();
        if($stmt->affected_rows){
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
            "respuesta" => "error",
            "error" => $e->getMessage()
        );
    }

die(json_encode($respuesta));
}

//editar registro 
if($_POST['registro'] == 'actualizar'){

    $id_registro = $_POST['id_registro'];
    try {
        //consulta preparada
        $stmt = $conn->prepare(" UPDATE proveedores SET nombreProv = ?,  direccion = ?, telefono = ?, emailProv = ?, editado = NOW() WHERE idproveedor = ? ");
        $stmt->bind_param("ssisi", $nombreProveedor, $direccion, $telefono, $email, $id_registro );
        $stmt->execute();
        if($stmt->affected_rows){
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
            "respuesta" => "error",
            "causa" => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}

if($_POST['registro'] == 'eliminar'){
    //capturo el id que se eliminara
    $id = $_POST['id'];

    try {
        //Query para eliminar
        $stmt = $conn->prepare("DELETE FROM proveedores WHERE idproveedor = ? ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                "respuesta" => "correcto",
                'id_eliminado' => $id
            );
        } else{
            $respuesta = array(
                "respuesta" => "error"
            );
        }
    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => "error"
        );
    }
    die(json_encode($respuesta));
}

?>