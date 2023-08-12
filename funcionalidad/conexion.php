<?php

function conectar() {
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = "";
    $db = "db_movimientos";
    $enlace = mysqli_connect($servidor, $usuario, $contraseña, $db);
    if (!$enlace) {
        echo "" . mysqli_error();
        exit();
    }
    return $enlace;
}

function desconectar($enlace) {
    mysqli_close($enlace);
}

?>