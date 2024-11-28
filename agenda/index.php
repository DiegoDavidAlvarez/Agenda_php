<?php
require_once("../clases/agenda.php");
require_once("../conexion.php");
require_once("../auth.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <a href="nuevo.php">Agregar Agenda</a>
        <?php
        $sql = "SELECT *FROM agenda";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        ?>
        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <table border=1>
                <tr>
                    <th>ID</th>
                    <th>TITULO</th>
                    <th>FECHA CREACION</th>
                    <th>DESCRIPCION</th>
                    <th>PROPIETARIO</th>
                    <th>ESTADO</th>
                    <th colspan="2">ACCIONES</th>
                </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td>
                        <?= $fila['id'] ?>
                    </td>
                    <td>
                        <?= $fila['titulo'] ?>
                    </td>
                    <td>
                        <?= $fila['fecha_creacion'] ?>
                    </td>
                    <td>
                        <?= $fila['descripcion'] ?>
                    </td>
                    <td>
                        <?= $fila['propietario'] ?>
                    </td>
                    <td>
                        <?= $fila['estado'] ?>
                    </td>
                    <td>
                        <a href="editar.php?id=<?= $fila['id'] ?>">Editar</a>
                    </td>
                    <td>
                        <a href="eliminar.php?id=<?= $fila['id'] ?>">Eliminar</a>
                    </td>
                </tr>
        <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">
                    0 resultados
                </td>
            </tr>
        <?php endif; ?>
            </table>
        <?php mysqli_stmt_close($stmt); ?>
        <a href="../logout.php">Cerrar Sesión</a>
    </div>
</body>

</html>