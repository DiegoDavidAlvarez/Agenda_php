<?php
require_once("../conexion.php");
require_once("../clases/agenda.php");
require_once("../auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $propietario = $_SESSION['usuario'];
    $estado = $_POST['estado'];

    $agenda = new Agenda($conexion);
    $agenda->insertarAgenda($titulo, $descripcion, $fecha_creacion, $propietario, $estado);

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
        <form action="" method="post" class="border p-4 rounded shadow-sm">
            <div class="row mb-3">
                <!-- Campo Título -->
                <div class="col-md-6">
                    <label for="titulo" class="form-label">Título :</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese el título" required>
                </div>
                <!-- Campo Fecha de Creación -->
                <div class="col-md-6">
                    <label for="fecha_creacion" class="form-label">Fecha de creación :</label>
                    <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" required>
                </div>
            </div>
            <div class="row mb-3">
                <!-- Campo Estado -->
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado :</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="Activo">Activo</option>
                        <option value="No activo">No activo</option>
                    </select>
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
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
