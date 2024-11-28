<?php
try {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "bd_agenda";
    $conexion = mysqli_connect($host, $user, $pass, $db);
} catch (Exception $e) {
    throw("Error al conectar a la base de datos: ".$e->getMessage());
}
?>