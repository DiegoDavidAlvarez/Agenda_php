<?php
require_once("../conexion.php");
require_once("../auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="d-flex" style="justify-content: space-between;">
        <button class="btn btn-primary p-1 px-2 m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <!-- Barra desplegable -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="sidebarLabel">Opciones</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div><hr>
        <div class="offcanvas-body">
            <h6 class="text-success"><?= $_SESSION['email'] ?></h6><hr>
            <div>
                <a class="link-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="../logout.php">Cerrar Sesión</a>
            </div><hr>
            <div>
                <a class="link-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="../eliminar_cuenta.php">Eliminar mi cuenta</a>
            </div>
        </div>
    </div>
    <!-- Fin barra desplegable -->
<div class="container my-5">
    <h1 class="text-center mb-4">Agenda de Notas</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="nuevo.php" class="btn btn-primary">Nueva Nota</a>
        <form class="d-flex" method="post" action="buscar_libro.php">
            <input class="form-control me-2" type="text" id="titulo" name="titulo" placeholder="Buscar por título" required>
            <button class="btn btn-success" type="submit">Buscar</button>
        </form>
    </div>
    <div>
        <h6>Bienvenido: <?= isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "" ?></h6>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            // Consulta con marcador de posición
            $sql = "SELECT * FROM agenda WHERE propietario = ?";
            $stmt = mysqli_prepare($conexion, $sql);

            // Vincular el parámetro (el propietario)
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);

            // Ejecutar la consulta
            mysqli_stmt_execute($stmt);

            // Obtener los resultados
            $resultado = mysqli_stmt_get_result($stmt);

            // Mostrar resultados en la tabla
            if (mysqli_num_rows($resultado)):
                while ($fila = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['titulo']; ?></td>
                        <td><?php echo $fila['descripcion']; ?></td>
                        <td><?php echo $fila['fecha_creacion']; ?></td>
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
