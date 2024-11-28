<?php
require_once("../conexion.php");
require_once("../clases/agenda.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Crear instancia y eliminar estudiante
    $estudiante = new Agenda($conexion);
    $estudiante->eliminarAgenda($id);
    header("Location: index.php"); // Redirige al índice después de eliminar
}
?>