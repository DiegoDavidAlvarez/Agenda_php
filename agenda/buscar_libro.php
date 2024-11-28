<?php
require_once('../conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Resultados de la Búsqueda</title>
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Resultados de la Búsqueda:</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titulo'])) {
        $titulo = $_POST['titulo'];

        // Consulta para buscar coincidencias en la tabla agenda
        $sql = "SELECT * FROM agenda WHERE titulo LIKE ?";
        $stmt = mysqli_prepare($conexion, $sql);
        $likeTitulo = "%" . $titulo . "%";
        mysqli_stmt_bind_param($stmt, "s", $likeTitulo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
    ?>
    
    <!-- Tabla de Resultados -->
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>TÍTULO</th>
                <th>DESCRIPCIÓN</th>
                <th>FECHA DE CREACIÓN</th>
                <th>PROPIETARIO</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['titulo']; ?></td>
                    <td><?php echo $fila['descripcion']; ?></td>
                    <td><?php echo $fila['fecha_creacion']; ?></td>
                    <td><?php echo $fila['propietario']; ?></td>
                    <td>
                        <span class="badge <?php echo $fila['estado'] === 'Activo' ? 'bg-success' : 'bg-secondary'; ?>">
                            <?php echo $fila['estado']; ?>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <?php } // Cierre del if ?>
    
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Regresar a la agenda</a>
    </div>
</div>

<!-- Enlace a Bootstrap JS (opcional para mejorar la interactividad) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
