<?php 
    $conn = new mysqli('0.0.0.0', 'root', 'root', 'libreria');

    if($conn->connect_error){
        echo "Hubo un error al intentar conectar a la base de datos";
    }

?>