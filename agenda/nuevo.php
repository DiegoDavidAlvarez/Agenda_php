<?php
require_once("../conexion.php");
require_once("../clases/agenda.php");
require_once("../clases/usuario.php");
require_once("../auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    //Genera la fecha actual y la hoar
    $fecha_creacion = date("Y-m-d H:i:s");
    $propietario = $_SESSION['email'];
    $nombre_propietario = $_SESSION['usuario'];
    $estado = "Activo";

    $agenda = new Agenda($conexion);
    $agenda->insertarAgenda($titulo, $descripcion, $fecha_creacion, $propietario, $nombre_propietario, $estado);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nueva Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Registrar Nueva Agenda</h1>
        <form  method="post" class="border p-4 rounded shadow-sm">
            <div class="row mb-3">
                <!-- Campo Título -->
                <div class="col-md-12">
                    <label for="titulo" class="form-label">Título :</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese el título" required>
                </div>
            </div>
            <!-- Campo Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción :</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Ingrese la descripción"></textarea>
            </div>
            <!-- Botón Registrar -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">Registrar</button>
            </div>
            <div class="text-end">
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>