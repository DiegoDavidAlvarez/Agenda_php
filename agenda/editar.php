<?php 
require_once("../clases/agenda.php");
require_once("../conexion.php");
require_once("../auth.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar el registro actual
    $sql = "SELECT * FROM agenda WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id); // Vincular solo el ID
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $agendaData = mysqli_fetch_assoc($resultado);
}

// Verificar si los datos han sido enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // ID del registro a editar
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    
    // Crear una instancia de la clase Agenda
    $agenda = new Agenda($conexion);
    
    // Llamar al método editarAgenda
    $agenda->editarAgenda($id, $titulo, $descripcion, $estado);
    
    // Redireccionar o mostrar un mensaje de éxito
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Nota</h1>
        <form method="post" class="border p-4 rounded shadow-sm">
            <input type="hidden" name="id" value="<?php echo $agendaData['id']; ?>">
            
            <div class="row mb-3">
                <!-- Campo Título -->
                <div class="col-md-6">
                    <label for="titulo" class="form-label">Título :</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $agendaData['titulo']; ?>" required>
                </div>
                <!-- Campo Estado -->
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado :</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="Activo" <?php echo $agendaData['estado'] == 'Activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="No Activo" <?php echo $agendaData["estado"] == 'No activo' ? 'selected' : ''; ?>>No Activo</option>
                    </select>
                </div>
            </div>
            
            <!-- Campo Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción :</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo $agendaData['descripcion']; ?></textarea>
            </div>
            
            <!-- Botón Actualizar -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">Actualizar</button>
            </div>
            <div class="text-end">
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
