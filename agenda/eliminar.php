<?php
require_once("../clases/agenda.php");
require_once ("../conexion.php");
require_once ("../auth.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $agenda = new Agenda($conexion);
    $agenda->eliminarAgenda($id);
    header("Location: index.php");
}
?>