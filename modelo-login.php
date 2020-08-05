<?php 
    if(isset($_POST['logear'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        try {
            include_once 'funciones/conexion-bd.php'; //conexion
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? ");
            $stmt->bind_param("s", $usuario );
            $stmt->execute();
            $stmt->bind_result($idusuario, $cui, $nombre, $apellido, $direccion, $telefono, $email, $imagenusuario, $usuario, $password_usuario, $idrol, $editado);
 
            if($stmt->affected_rows){
                //verificamos el usuario
                $existe = $stmt->fetch();
                if($existe){
                    //si existe el usuario, ahora verificamos el password
                    if(password_verify($password, $password_usuario)){
                            //inicio la sesion
                            session_start();
                            //le asignamos los datos de la consulta a la sesion, sesion es una array                        
                            $_SESSION['id'] = $idusuario;
                            $_SESSION['cui'] = $cui;
                            $_SESSION['nombre'] = $nombre;
                            $_SESSION['apellido'] = $apellido;
                            $_SESSION['direccion'] = $direccion;
                            $_SESSION['telefono'] = $telefono;
                            $_SESSION['email'] = $email;
                            $_SESSION['imagenusuario'] = $imagenusuario;
                            $_SESSION['usuario'] = $usuario;
                            $_SESSION['idrol'] = $idrol; 
                            //creamos una respuesta que sera enviada por JSON
                            $respuesta = array(
                                "respuesta" => "correcto",
                                "usuario" => $usuario
                            );
                    }else{
                        $respuesta = array(
                            "respuesta" => "error"
                        );
                    }
                } else{
                    $respuesta = array(
                        "respuesta" => "error"
                    );
                }
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo "error : ".$e->getMessage();
        }
        die(json_encode($respuesta));
    }


?>