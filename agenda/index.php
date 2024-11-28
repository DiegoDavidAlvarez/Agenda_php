<?php
require_once("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center mb-4">Agenda de Notas</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="nuevo.php" class="btn btn-primary">Nueva Agenda</a>
        <form class="d-flex" method="post" action="buscar_agenda.php">
            <input class="form-control me-2" type="text" id="titulo" name="titulo" placeholder="Buscar por título" required>
            <button class="btn btn-success" type="submit">Buscar</button>
        </form>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
                <th>Propietario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM agenda";
            $stmt = mysqli_prepare($conexion, $sql);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado)): 
                while ($fila = mysqli_fetch_assoc($resultado)): ?>
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
                        <td>
                            <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta agenda?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; 
            else: ?>
                <tr>
                    <td colspan="7" class="text-center">No hay datos disponibles</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
