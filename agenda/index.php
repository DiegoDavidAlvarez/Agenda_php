<?php
require_once("../clases/agenda.php");
require_once ("../conexion.php");
require_once ("../auth.php");
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
           $stmt= mysqli_prepare($conexion , $sql);
           mysqli_stmt_execute($stmt);
           $resultado = mysqli_stmt_get_result($stmt);

           if (mysqli_num_rows($resultado)> 0) {
             echo "<tr>
                <th>ID</th>
                <th>TITULO</th>
                <th>FECHA CREACION</th>
                <th>DESCRIPCION</th>
                <th>PROPIETARIO</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
             </tr>";
             while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>".$fila['id']."</td>";
                echo "<td>".$fila['titulo']."</td>";
                echo "<td>".$fila['fecha_creacion']."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "<td>".$fila['propietario']."</td>";
                echo "<td>".$fila['estado']."</td>";
                echo "<td>";
                echo "<a href='editar.php?id=".$fila['id']."'>Editar</a>";
                echo "<a href='eliminar.php?id=".$fila['id']."'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
             }
           }else {
            echo "O resultados";
           }
           mysqli_stmt_close($stmt);
        ?>
        <a href="../logout.php">Cerrar Sesión</a>
    </div>
</body>
</html>