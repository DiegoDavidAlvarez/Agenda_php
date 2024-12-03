<?php
require_once("../conexion.php");
require_once("../clases/agenda.php");

if (isset($_GET['id'])) {
    //verifica si la url se ha enviado el parametro id mediante el metodo get

    //asiganmos el valor recibido a la variable $id
    $id = $_GET['id'];

    // Crear instancia y eliminar estudiante
    $agenda = new Agenda($conexion);
    //llamamos a nuestra funcion 
    $agenda->eliminarAgenda($id);
    
    header("Location: index.php"); // Redirige al índice después de eliminar
}
?>