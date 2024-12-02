<?php
require_once("../conexion.php");
require_once("../clases/agenda.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Crear instancia y eliminar estudiante
    $agenda = new Agenda($conexion);
    $agenda->eliminarAgenda($id);
    header("Location: index.php"); // Redirige al índice después de eliminar
}
?>