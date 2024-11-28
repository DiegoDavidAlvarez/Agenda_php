<?php
require_once "../clases/agenda.php";
require_once "../conexion.php";
require_once ("../auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $descripcion = $_POST['descripcion'];
    $propietario = $_POST['propietario'];
    $estado = $_POST['estado'] == "Activo" ? true : false;

    $agenda = new Agenda($conexion);
    $agenda->insertarAgenda($titulo,$fecha_creacion,$descripcion,$propietario,$estado);
    header("Location: index.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Agenda</title>
</head>
<body>
    <div>
        <form  method="post">
          <label >Titulo :</label><br>
          <input type="text" name="titulo" required><br>
          <label >Fecha de creacion :</label><br>
          <input type="date" name="fecha_creacion" required><br>
          <label >Descripcion :</label><br>
          <textarea name="descripcion"></textarea><br>
          <label >Propietario :</label><br>
          <input type="text" name="propietario" required><br>
          <label >Estado :</label><br>
          <select name="estado">
            <option value="Activo">Activo</option>
            <option value="No activo">No activo</option>
            <option value="Otros..">Otros..</option>
          </select><br>
          <button type="submit">Agregar</button>
        </form>
    </div>
</body>
</html>